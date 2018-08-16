<?php

namespace App\Entity;

class Token
{
	/** Access token max age (seconds) */
	const ACCESS_TOKEN_MAX_AGE = 43000; // could be 43200 (12 hours), but left some margin

	private $userToken;
	private $accessToken;
	private $refreshToken;
	private $refreshedAt;

	public function __construct(string $userToken, string $accessToken, $refreshToken, $refreshedAt)
	{
		$this
			->setUserToken($userToken)
			->setAccessToken($accessToken)
			->setRefreshToken($refreshToken)
			->setRefreshedAt($refreshedAt)
		;
	}

	public function isExpired(): bool
	{
		return (time() - $this->getRefreshedAt() > self::ACCESS_TOKEN_MAX_AGE);
	}

	public function getUserToken(): string
	{
		return $this->userToken;
	}

	public function getAccessToken(): string
	{
		return $this->accessToken;
	}

	public function getRefreshToken(): string
	{
		return $this->refreshToken;
	}

	public function getRefreshedAt(): int
	{
		return $this->refreshedAt;
	}

	public function setUserToken(string $userToken): self
	{
		$this->userToken = $userToken;

		return $this;
	}

	public function setAccessToken(string $accessToken): self
	{
		$this->accessToken = $accessToken;

		return $this;
	}

	public function setRefreshToken(string $refreshToken): self
	{
		$this->refreshToken = $refreshToken;

		return $this;
	}

	public function setRefreshedAt(int $refreshedAt): self
	{
		$this->refreshedAt = $refreshedAt;

		return $this;
	}
}
