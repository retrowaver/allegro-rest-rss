<?php

namespace App\Service;

interface AppServiceInterface
{
    /**
     * Takes some parameters, sends them to API and uses the response to create a RSS feed
     *
     * @param array $data parameters that will be passed to /offers/listing
     * @return string RSS feed containing offers, ready to display
     */
    public function getRss(array $data): string;

    /**
     * Authorizes new user and persists token data
     *
     * Takes temporary code and uses it to get both access token and refresh token from API. Then generates a permanent user token (associated with them) and persists everything. Finally returns that user token, so it can be shown to the user.
     *
     * @param string $code
     * @return string user token
     */
    public function authorizeNewUser(string $code): string;

    /**
     * Gets URI where user has to be redirected in order to connect his Allegro account to the app
     *
     * @return string
     */
    public function getAuthorizationPageUrl(): string;
}