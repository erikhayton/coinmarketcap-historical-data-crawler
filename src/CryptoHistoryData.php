<?php
declare(strict_types=1);

/**
 * Created by lei
 */

namespace sdleiw\CoinMarketCap;

class CryptoHistoryData
{

    private $client;

    private $crawler;

    private $csvWriter;

    public function __construct(WebClient $client, DomCrawler $crawler, CsvWriter $csvWriter)
    {
        $this->client = $client;
        $this->crawler = $crawler;
        $this->csvWriter = $csvWriter;
    }

    public function saveDataToCsv(string $coinName, $from, $to): void
    {
        $html = $this->client->getHistoryDataHtml($coinName, $from, $to);
        $historyData = $this->crawler->fetchHistoryData($html);
        $this->csvWriter->writeToCsv($historyData);
    }
}
