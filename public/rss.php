<?php

use App\Exceptions\AllegroRestRssException;

require __DIR__ . '/../vendor/autoload.php';

// PHP DI container
$builder = new \DI\ContainerBuilder();
$builder->useAnnotations(true);
$builder->addDefinitions(require(__DIR__ . '/../config/php_di.php'));
$container = $builder->build();

// Get controller and call its only method
$controller = $container->get('App\\Controller\\RssController');

try {
	$controller->rss();
} catch (App\Exception\AllegroRestRssException $e) {
	echo $e->getMessage();
}
