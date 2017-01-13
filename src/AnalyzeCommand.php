<?php

namespace Phase2\ComposerAnalytics;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class AnalyzeCommand extends Command
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName('composer-analyze')
            ->setDescription('Analyze composer files for patch data')
            ->setHelp('This command will find all composer.json files within a given root directory.')
            ->addArgument(
                'directory',
                InputArgument::OPTIONAL,
                'Root directory to scan for composer.json files',
                getcwd()
            )
            ->addOption(
                'type',
                't',
                InputOption::VALUE_OPTIONAL,
                'File type to process. Defaults to composer.json'
            );
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $directory = realpath($input->getArgument('directory'));
        $output->writeln(sprintf('Scanning for files in %s.', $directory), OutputInterface::VERBOSITY_VERBOSE);
    }
}
