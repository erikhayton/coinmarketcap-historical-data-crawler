<?php

require 'vendor/autoload.php';

use League\Csv\Writer;
use League\Csv\CannotInsertRecord;
use sdleiw\CoinMarketCap\WebClient;
use sdleiw\CoinMarketCap\DomCrawler;

$coinName = 'bitcoin';

$client = new WebClient();
$html = $client->getHistoryDataHtml($coinName);

$crawler = new DomCrawler($html);
$history = $crawler->fetchHistoryData();

try {
    $writer = Writer::createFromPath("./files/{$coinName}.csv", 'w+');
    try {
        $writer->setDelimiter(';');
    } catch (\Exception $e) {
        // @todo
    }
    $writer->insertAll($history);
} catch (CannotInsertRecord $e) {
    var_dump($e->getRecords());
}



