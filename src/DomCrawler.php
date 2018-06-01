<?php

namespace sdleiw\CoinMarketCap;

use Symfony\Component\DomCrawler\Crawler;

class DomCrawler
{
    const TABLE_HEAD_CSS_SELECTOR = "#historical-data table > thead > tr";
    const TABLE_BODY_CSS_SELECTOR = "#historical-data table > tbody";

    /**
     * @var Crawler $crawler
     */
    private $crawler;

    public function __construct($html) {
        $this->crawler = new Crawler();
        $this->crawler->addHTMLContent($html);
    }

    public function fetchHistoryData() : array
    {   
        $history = [];
        $history[] = $this->getTableHeadRow();
        $tBodyTrElements = $this->crawler->filter(self::TABLE_BODY_CSS_SELECTOR)->children();
        foreach ($tBodyTrElements as $trElement) {
            $history[] = $this->getTableBodyRow($trElement);
        }

        return $history;
    }

    private function getTableHeadRow(): array
    {
        $tHeadElements = $this->crawler->filter(self::TABLE_HEAD_CSS_SELECTOR)->children();
        $tableHead = [];
        foreach ($tHeadElements as $thElement) {
            $tableHead[] = $thElement->nodeValue;
        }

        return $tableHead;
    }

    private function getTableBodyRow($trElement) : array
    {
        $rowArr = [];
        $rowCrawler = new Crawler($trElement);
        foreach ($rowCrawler->filter('td') as $tdElement) {
            $rowArr[] = $tdElement->nodeValue;
        }
        unset($rowCrawler);

        return $rowArr;
    }
}
