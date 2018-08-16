<?php

namespace App\Controller;

use App\Service\AppServiceInterface;

class RssController
{
    /**
     * @Inject
     * @var AppServiceInterface $appService
     */
    private $appService;

    /**
     * @var array $get
     */
    private $get;

    /**
     * Controller constructor
     */
    public function __construct($get)
    {
        $this->get = $get;
    }

    /**
     * Main controller function
     *
     * Decides what AppService method should be called, based on $_GET.
     */
    public function rss()
    {
        if (isset($this->get['user_token'])) {
            // User token was provided, so get offers data from API and display them as RSS
            echo $this->appService->getRss($this->get);
        } elseif(isset($this->get['code'])) {
            // Code was provided, so let's authorize the user (get tokens and persist them)
            $userToken = $this->appService->authorizeNewUser($this->get['code']);
            echo 'Your user token is ' . $userToken;
        } else {
            // Redirect user to Allegro & ask him to connect his account to the app.
            // User is then redirected back here, this time with code passed as GET parameter.
            header('Location: ' . $this->appService->getAuthorizationPageUrl());
        }
    }
}
