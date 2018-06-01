<?php
declare(strict_types=1);

/**
 * Created by lei
 */

namespace sdleiw\CoinMarketCap\Commands;

use sdleiw\CoinMarketCap\ApiClient;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\NullOutput;
use Symfony\Component\Console\Output\OutputInterface;

class SaveHistoryDateForAllCoinsCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('coinmarketcap:history:csv:all')
            ->setDescription('save history data for all coins.')
            ->addArgument('from', InputArgument::OPTIONAL, 'from when, default one month ago')
            ->addArgument('to', InputArgument::OPTIONAL, 'to which day, default today')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $from = $input->getArgument('from');
        $to = $input->getArgument('to');
        $command = $this->getApplication()->find('coinmarketcap:history:csv');
        $nullOutput = new NullOutput();
        $arguments = compact('from', 'to');
        $errorCount = 0;

        $apiClient = new ApiClient();
        $coinList = json_decode($apiClient->getList());
        foreach ($coinList->data as $coin) {
            $name = $coin->website_slug;
            $arguments['coin'] = $name;
            $commandInput = new ArrayInput($arguments);
            try {
                $command->run($commandInput, $nullOutput);
            } catch (\Exception $e) {
                $output->writeln("<error>{$e->getMessage()}</error>");
                $errorCount++;
            }

            $output->writeln("<info>{$name}</info>");
        }

        $output->writeln("failure count: " . $errorCount);
        $output->writeln("success count: " . $coinList->metadata->num_cryptocurrencies - $errorCount);
    }
}
