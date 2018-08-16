<?php

namespace App\Service;

use Suin\RSSWriter;

class RssService implements RssServiceInterface
{
	private $feed;

	public function __construct(RSSWriter\Feed $feed)
	{
		$this->feed = $feed;
	}

	public function buildRssFromOffers(array $offers): string
	{
		$channel = new RSSWriter\Channel();
		$channel
		    ->title('Allegro REST RSS')
		    ->appendTo($this->feed);

		foreach ($offers as $offer) {
			$item = new RssWriter\Item();
			$item
			    ->title($offer->name)
			    ->url('https://allegro.pl/i' . $offer->id . '.html')
			    ->guid($offer->id)
			    ->appendTo($channel);
		}

		return $this->feed->render();
	}
}