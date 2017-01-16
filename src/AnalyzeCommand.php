<?php

namespace Phase2\ComposerAnalytics;

use League\Csv\Writer;
use Phase2\ComposerAnalytics\Analyze\Patches;
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
                'File type to process. Defaults to composer.json'
            );
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $type = $input->getOption('type') ?: 'composer.json';
        $parser_factory = new Factory();
        $parser = $parser_factory->get($type);

        $finder = new Finder();
        $finder->files();
        $finder->name($parser->getPattern());

        $directory = realpath($input->getArgument('directory'));
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
            $output->writeln(sprintf('<warning>No patches found in %s.', $directory));
            return 0;
        }

        $analyzer = new Patches();
        $analyzer->setPatches($patches);
        $analyzed = $analyzer->analyze();

        // @todo Make output format configurable.
        // @todo Make output destination configurable.
        if (!file_exists($directory . '/reports')) {
            mkdir($directory . '/reports');
        }
        $report = $directory . '/reports/patch-analysis.csv';
        $csv = Writer::createFromFileObject(new \SplTempFileObject());
        $csv->insertAll($analyzed);
        file_put_contents($report, (string) $csv);
        $output->writeln(sprintf('<info>Report written to %s.</info>', $report));
    }
}
