<?php
declare(strict_types=1);

/**
 * Created by lei
 */

namespace sdleiw\CoinMarketCap;

class CryptoHistoryData
{

    private $webClient;

    private $crawler;

    private $csvWriter;

    public function __construct(
        WebClient $webClient,
        DomCrawler $crawler,
        CsvWriter $csvWriter
    ) {
        $this->webClient = $webClient;
        $this->crawler = $crawler;
        $this->csvWriter = $csvWriter;
    }

    public function saveDataToCsv(string $coinName, $from, $to): void
    {
        $html = $this->webClient->getHistoryDataHtml($coinName, $from, $to);
        $historyData = $this->crawler->fetchHistoryData($html);
        $this->csvWriter->writeToCsv($historyData);
    }
}
