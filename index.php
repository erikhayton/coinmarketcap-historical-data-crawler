<?php

require 'vendor/autoload.php';

use sdleiw\CoinMarketCap\CsvWriter;
use sdleiw\CoinMarketCap\WebClient;
use sdleiw\CoinMarketCap\DomCrawler;

$coinName = 'bitcoin';

$client = new WebClient();
$html = $client->getHistoryDataHtml($coinName);

$crawler = new DomCrawler($html);
$history = $crawler->fetchHistoryData();

$csvWrite = new CsvWriter($coinName);
$csvWrite->writeToCsv($history);



