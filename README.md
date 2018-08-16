# Allegro REST RSS

Simple app that creates RSS feed using Allegro REST API.

## Getting Started

### Installing
Enter your API credentials into `/src/Service/ApiService.php.dist` and rename the file to `/src/Service/ApiService.php`.

### Usage

1. Go to `rss.php`, get redirected to Allegro, allow app to use your account.
2. You'll get redirected to `rss.php?code=...`, your tokens will get stored and you'll get assigned a permanent user token (`Your user token is ...`).
3. Now you can use your user token to create RSS feeds, passing it as `user_token` (examples below).

Offers for "ford mustang" phrase:
`rss.php?user_token=...&phrase=ford+mustang`

Offers for "sukienka" phrase, "Sukienki" category (124264), with `parameter.11323=2` (stan używany):
`rss.php?user_token=...&phrase=sukienka&category.id=124264&parameter.11323=2`

GET parameters are directly passed to API, so it's possible to use every possible parameter (read more about them [here](https://developer.allegro.pl/documentation/#/offers-listing/getListing) and [here](https://developer.allegro.pl/en/news/2018-07-03-Listing_ofert/)). Currently there are two default parameters set (which can be overriden anyway) - `limit` (`60`) and `sort` (`-startTime`).

## Notes / downsides
* You will most likely want to write your own `StorageServiceInterface` implementation (current one is super simple, uses text file and doesn't even support multiple users; I don't feel like writing anything fancier at the moment).
* Allegro REST RSS uses [php-allegro-rest-api](https://github.com/Wiatrogon/php-allegro-rest-api), which has certain flaws, mainly:
	* Doesn't let you set multiple values for a single filter ([issue](https://github.com/Wiatrogon/php-allegro-rest-api/issues/6))
* REST API allows you to get a maximum of 100 latest offers, but unfortunately it prioritizes *promoted* offers. Therefore, if there's more than 100 promoted offers, no *regular* offers will be shown, making RSS feed useless for most purposes.