<?php

require 'vendor/autoload.php';

use sdleiw\CoinMarketCap\CsvWriter;
use sdleiw\CoinMarketCap\WebClient;
use sdleiw\CoinMarketCap\DomCrawler;
use sdleiw\CoinMarketCap\CryptoHistoryData;

$coinName = 'bitcoin';

$cryptoHistoryDataService = new CryptoHistoryData(
    new WebClient(),
    new DomCrawler(),
    new CsvWriter($coinName)
);

$cryptoHistoryDataService->saveDataToCsv($coinName);



