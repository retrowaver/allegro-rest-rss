<?php

namespace App\Service;

use App\Entity\Token;

interface StorageServiceInterface
{
	/**
	 * Gets token entity by user token
	 *
	 * @param string $userToken
	 * @return Token|null Token or null if it wasn't found
	 */
	public function getToken(string $userToken): ?Token;

	/**
	 * Persists token entity
	 *
	 * @param Token $token
	 */
	public function persistToken(Token $token): void;
}