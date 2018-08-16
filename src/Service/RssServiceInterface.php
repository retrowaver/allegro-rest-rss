<?php

namespace App\Service;

interface RssServiceInterface
{
    /**
     * Builds RSS feed based on provided offers
     *
     * @param array $offers an array of offers, taken as-is from API response 
     * @return string RSS feed, ready to display
     */
    public function buildRssFromOffers(array $offers): string;
}