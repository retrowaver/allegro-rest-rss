<?php

namespace App\Service;

use App\Entity\Token;

/**
 * Super simple text file implementation for development purposes. Doesn't even support multiple sets of tokens.
 */
class StorageService implements StorageServiceInterface
{
    public function getToken(string $userToken): ?Token
    {
        $x = explode("\n", file_get_contents(__DIR__ . '/../../storage/storage.txt'));
        return new Token(...$x);
    }

    public function persistToken(Token $token): void
    {
        $f = fopen(__DIR__ . '/../../storage/storage.txt', 'w');
        fwrite(
            $f,
            sprintf(
                "%s\n%s\n%s\n%d",
                $token->getUserToken(),
                $token->getAccessToken(),
                $token->getRefreshToken(),
                $token->getRefreshedAt()
            )
        );
        fclose($f);
    }
}
