<?php

namespace Phase2\ComposerAnalytics;

use League\Csv\Writer;
use Phase2\ComposerAnalytics\Analyze\Patches;
use Phase2\ComposerAnalytics\Formatter\Factory as FormatterFactory;
use Phase2\ComposerAnalytics\Parser\Factory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;

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
                'File type to process (either `composer` or `make`). Defaults to composer.json',
                'composer'
            )
            ->addOption(
                'format',
                'f',
                InputOption::VALUE_OPTIONAL,
                'The output format (either `json` or `csv`). Defaults to csv',
                'csv'
            )
            ->addOption(
                'output',
                'o',
                InputOption::VALUE_OPTIONAL,
                'The output location file path. Defaults to stdout'
            );
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $type = $input->getOption('type');
        $parser = Factory::get($type);

        $finder = new Finder();
        $finder->files();
        $finder->name($parser->getPattern());

        $directory = $input->getArgument('directory');
        $output->writeln(
            sprintf('<info>Scanning for %s files in %s.</info>', $type, $directory),
            OutputInterface::VERBOSITY_VERBOSE
        );
        $patches = [];
        foreach ($finder->in($directory) as $file) {
            $output->writeln(
                sprintf('<info>Found %s file.</info>', $file->getRealPath()),
                OutputInterface::VERBOSITY_VERBOSE
            );
            $patches += $parser->findPatches($file->getContents());
        }
        if (empty($patches)) {
            $output->writeln(sprintf('<comment>No patches found in %s.</comment>', $directory));
            return 0;
        }

        $analyzer = new Patches($output);
        $analyzer->setPatches($patches);
        $analyzed = $analyzer->analyze();

        $formatted = FormatterFactory::get($input->getOption('format'))->format($analyzed);

        if ($input->getOption('output')) {
            file_put_contents($input->getOption('output'), $formatted);
            $output->writeln(sprintf('<info>Report written to %s.</info>', $input->getOption('output')));
        } else {
            $output->writeln($formatted);
        }

        return 0;
    }
}
