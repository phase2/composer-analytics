<?php

namespace Phase2\ComposerAnalytics;

use Symfony\Component\Console\Application as Console;
use Symfony\Component\Console\Input\InputInterface;

class Application extends Console
{
    /**
     * {@inheritdoc}
     */
    protected function getCommandName(InputInterface $input)
    {
        return 'composer-analyze';
    }

    /**
     * {@inheritdoc}
     */
    protected function getDefaultCommands()
    {
        $default_commands = parent::getDefaultCommands();
        $default_commands[] = new AnalyzeCommand();
        return $default_commands;
    }

    /**
     * {@inheritdoc}
     *
     * Overridden so that the application doesn't expect the command name to be the first argument.
     */
    public function getDefinition()
    {
        $input = parent::getDefinition();
        $input->setArguments();
        return $input;
    }
}
