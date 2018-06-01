<?php

namespace sdleiw\CoinMarketCap;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class WebClient
{
    /**
     * @var Client $client
     */
    private $client;

    public function __construct() {
        $this->client = new Client();
    }

    public function getHistoryDataHtml(string $coin, string $start = '', string $end = ''): string
    {
        $url = "https://coinmarketcap.com/currencies/{$coin}/historical-data/";

        try {
            $res = $this->client->request('GET', $url);

            return $res->getbody()->getContents();
        } catch (GuzzleException $e) {
            echo $e->getMessage();
        }

        return "";
    }
}
