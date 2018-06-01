<?php
declare(strict_types=1);

/**
 * Created by lei
 */

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
        $writer->setDelimiter($this->delimiter);
        $writer->insertAll($data);
    }
}
