<?php
namespace Mastering\SampleModule\Plugin;

use Mastering\SampleModule\Console\Command\AddItem;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Logger
{
    /**
     * @var OutputInterface
     */
    private $output;

    public function beforeRun(
        AddItem $command,
        InputInterface $input,
        OutputInterface $output
    ) {
        $output->writeln('beforeExecute');
    }

    /**
     * @codeCoverageIgnore
     */
    public function aroundRun(
        AddItem $command,
        \Closure $proceed,
        InputInterface $input,
        OutputInterface $output
    ) {
        $output->writeln('aroundExecute before call');
        $proceed->call($command, $input, $output);
        $output->writeln('aroundExecute after call');
        $this->output = $output;
    }

    public function afterRun(
        AddItem $command,
        $result,
        InputInterface $input,
        OutputInterface $output
    ) {
        $output->writeln('afterExecute');
    }
}
