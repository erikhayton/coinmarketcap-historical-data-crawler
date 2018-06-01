<?php
declare(strict_types=1);

/**
 * Created by lei
 */

namespace sdleiw\CoinMarketCap;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class WebClient
{
    /**
     * @var Client $client
     */
    private $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function getHistoryDataHtml(string $coin, ?string $start = '', ?string $end = ''): string
    {
        $url = "https://coinmarketcap.com/currencies/{$coin}/historical-data/";
        $query = $this->getTimeConfig($start, $end);

        try {
            $res = $this->client->request('GET', $url, ['query' => $query]);

            return $res->getbody()->getContents();
        } catch (GuzzleException $e) {
            echo $e->getMessage();
        }

        return "";
    }

    private function getTimeConfig(?string $start, ?string $end): array
    {
        $query = [];
        if ($start) {
            $end = $end ?: date('Ymd');
            $query = [
                'start' => $this->formatDate($start),
                'end' => $this->formatDate($end),
            ];
        }

        return $query;
    }

    private function formatDate(?string $date)
    {
        return date('Ymd', strtotime($date));
    }
}
