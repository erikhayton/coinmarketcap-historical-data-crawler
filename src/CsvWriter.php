<?php

namespace sdleiw\CoinMarketCap;

use League\Csv\Writer;

class CsvWriter
{
    /**
     * @var string $filename
     */
    private $filename;

    /**
     * @var string $delimiter
     */
    private $delimiter;

    public function __construct(string $filename, string $delimiter = ";")
    {
        $this->filename = $filename;
        $this->delimiter = $delimiter;
    }

    public function writeToCsv(array $data): void
    {
        $writer = Writer::createFromPath("./files/{$this->filename}.csv", 'w+');

        try {
            $writer->setDelimiter($this->delimiter);
        } catch (\Exception $e) {
            var_dump($e->getMessage());
        }

        $writer->insertAll($data);
    }
}
