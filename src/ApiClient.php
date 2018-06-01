<?php
declare(strict_types=1);

/**
 * Created by lei
 */

namespace sdleiw\CoinMarketCap;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class ApiClient
{
    /**
     * @var Client $client
     */
    private $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function getList(): string
    {
        $url = "https://api.coinmarketcap.com/v2/listings/";

        try {
            $res = $this->client->request('GET', $url);

            return $res->getbody()->getContents();
        } catch (GuzzleException $e) {
            echo $e->getMessage();
        }

        return "";
    }
}
