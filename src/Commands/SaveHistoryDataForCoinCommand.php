<?php
declare(strict_types=1);

/**
 * Created by lei
 */

namespace sdleiw\CoinMarketCap\Commands;

use sdleiw\CoinMarketCap\CryptoHistoryData;
use sdleiw\CoinMarketCap\CsvWriter;
use sdleiw\CoinMarketCap\DomCrawler;
use sdleiw\CoinMarketCap\WebClient;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SaveHistoryDataForCoinCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('coinmarketcap:history:csv')
            ->setDescription('save history data for one coin.')
            ->addArgument('coin', InputArgument::REQUIRED, 'coin name')
            ->addArgument('from', InputArgument::OPTIONAL, 'from when, default one month ago')
            ->addArgument('to', InputArgument::OPTIONAL, 'to which day, default today')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $coinName = $input->getArgument('coin');
        $from = $input->getArgument('from');
        $to = $input->getArgument('to');
        $cryptoHistoryDataService = new CryptoHistoryData(
            new WebClient(),
            new DomCrawler(),
            new CsvWriter($coinName)
        );
        $cryptoHistoryDataService->saveDataToCsv($coinName, $from, $to);

        $output->writeln("done");
    }
}
