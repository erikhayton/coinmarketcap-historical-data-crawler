<?php

require 'vendor/autoload.php';

use GuzzleHttp\Client;
use League\Csv\Writer;
use League\Csv\CannotInsertRecord;
use Symfony\Component\DomCrawler\Crawler;

$client = new Client();
$res = $client->request('GET', 'https://coinmarketcap.com/currencies/bitcoin/historical-data/');
$html = $res->getbody()->getContents();

$crawler = new Crawler();
$crawler->addHTMLContent($html);

$history = [];

$tHeadElements = $crawler->filter("#historical-data table > thead > tr")->children();
$historyHead = [];
foreach ($tHeadElements as $thElement) {
    $historyHead[] = $thElement->nodeValue;
}
$history[] = $historyHead;

$trElements = $crawler->filter("#historical-data table > tbody")->children();
foreach ($trElements as $trElement) {
    $rowArr = [];
    $rowCrawler = new Crawler($trElement);
    foreach ($rowCrawler->filter('td') as $tdElement) {
        $rowArr[] = $tdElement->nodeValue;
    }
    $history[] = $rowArr;
    unset($rowArr);
    unset($rowCrawler);
}

var_dump($history);

try {
    $writer = Writer::createFromPath('./files/bitcoin.csv', 'w+');
    $writer->setDelimiter(';');
    $writer->insertAll($history);
} catch (CannotInsertRecord $e) {
    var_dump($e->getRecords());
}



