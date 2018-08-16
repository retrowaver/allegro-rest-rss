<?php

return [
    'App\\Service\\AppServiceInterface' => \DI\get('App\\Service\\AppService'),
    'App\\Service\\ApiServiceInterface' => \DI\get('App\\Service\\ApiService'),
    'App\\Service\\RssServiceInterface' => \DI\get('App\\Service\\RssService'),
    'App\\Service\\StorageServiceInterface' => \DI\get('App\\Service\\StorageService'),
    'App\\Controller\\RssController' => \DI\autowire()
		->constructorParameter('get', $_GET),
    'Allegro\\REST\\Api' => \DI\autowire()
		->constructorParameter('clientId', App\Service\ApiService::API_CLIENT_ID)
		->constructorParameter('clientSecret', App\Service\ApiService::API_CLIENT_SECRET)
		->constructorParameter('apiKey', null)
		->constructorParameter('redirectUri', App\Service\ApiService::API_REDIRECT_URL)
];
