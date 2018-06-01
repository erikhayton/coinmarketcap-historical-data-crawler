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
        $dir = "./files/coinmarketcap"; // @todo: make this dir an argument
        if (!file_exists($dir)) {
            mkdir($dir, 0755, true);
        }
        $writer = Writer::createFromPath("{$dir}/{$this->filename}.csv", 'w+');
        $writer->setDelimiter($this->delimiter);
        $writer->insertAll($data);
    }
}
