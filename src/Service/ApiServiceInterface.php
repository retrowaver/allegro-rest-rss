<?php

namespace App\Service;

use App\Entity\Token;

interface ApiServiceInterface
{
	/**
	 * Gets URI where user has to be redirected in order to connect his Allegro account to the app
	 *
	 * @return string
	 */
	public function getAuthorizationUri(): string;

	/**
	 * Gets JSON-decoded response with access and refresh tokens
	 *
	 * @param string $code
	 * @return mixed JSON-decoded response from API call
	 */
	public function getNewAccessToken(string $code);

	/**
	 * Gets JSON-decoded offers listing
	 *
	 * @param array $data array of parameters that will be passed to API
	 * @return mixed JSON-decoded response from API call
	 */
	public function getOffersListing(array $data);

	/**
	 * Passes token info to API
	 *
	 * @param Token $token
	 * @return self
	 */
	public function setToken(Token $token);

	/**
	 * Refreshes access token, updating Token entity
	 *
	 * @param Token $token
	 * @return self
	 */
	public function refreshToken(Token $token);
}