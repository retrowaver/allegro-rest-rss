<?php

namespace App\Service;

use App\Entity\Token;
use App\Exception\AllegroRestRssException;
use App\Service\ApiServiceInterface;
use App\Service\RssServiceInterface;
use App\Service\StorageServiceInterface;

class AppService implements AppServiceInterface
{
	const DEFAULT_SORT = '-startTime';
	const DEFAULT_LIMIT = 60;

	/**
     * @Inject
     * @var ApiServiceInterface $apiService
     */
    private $apiService;

	/**
     * @Inject
     * @var RssServiceInterface $rssService
     */
    private $rssService;

	/**
     * @Inject
     * @var StorageServiceInterface $storageService
     */
    private $storageService;

	public function getRss(array $data): string
	{
		// Get user token and remove it from $get (everything else will be passed to API)
		$userToken = $data['user_token'];
		unset($data['user_token']);

		// Set defaults if not provided
		$data['sort'] = $data['sort'] ?? self::DEFAULT_SORT;
		$data['limit'] = $data['limit'] ?? self::DEFAULT_LIMIT;
		
		// Get token info from storage & pass it to API service
		$token = $this->storageService->getToken($userToken);
		if (!$token) {
			throw new AllegroRestRssException('Wrong user token.');
		}
		$this->apiService->setToken($token);

		// Refresh access token if it already expired
		if ($token->isExpired()) {
			$this->apiService->refreshToken($token);
			$this->apiService->setToken($token);
			$this->storageService->persistToken($token);
		}

		// Get offers data from API and create an RSS feed with it
		$response = $this->apiService->getOffersListing($data);

		$offers = array_merge($response->items->promoted, $response->items->regular);
		$feed = $this->rssService->buildRssFromOffers($offers);

		return $feed;
	}

	public function authorizeNewUser(string $code): string
	{
		// Get access token and refresh token from API
		$response = $this->apiService->getNewAccessToken($code);

		$userToken = bin2hex(random_bytes(16));
		$refreshedAt = time();

		$this->storageService->persistToken(
			new Token(
				$userToken,
				$response->access_token,
				$response->refresh_token,
				$refreshedAt
			)
		);

		return $userToken;
	}

	public function getAuthorizationPageUrl(): string
	{
		return $this->apiService->getAuthorizationUri();
	}
}
