<?php

namespace Phase2\ComposerAnalytics\Tests;

use org\bovigo\vfs\vfsStream;
use Phase2\ComposerAnalytics\Application;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Tester\CommandTester;

/**
 * @coversDefaultClass \Phase2\ComposerAnalytics\AnalyzeCommand
 */
class AnalyzeCommandTest extends TestCase
{
    /**
     * The command fixture.
     *
     * @var \Symfony\Component\Console\Tester\CommandTester
     */
    protected $commandTester;

    /**
     * {@inheritdoc}
     */
    protected function setUp() : void
    {
        parent::setUp();

        $application = new Application();
        $command = $application->find('composer-analyze');
        $this->commandTester = new CommandTester($command);
    }

    /**
     * @covers ::execute
     */
    public function testEmpty()
    {
        vfsStream::setup('foo', null, ['bar' => ['composer.json' => '']]);
        $this->commandTester->execute(['directory' => vfsStream::url('foo'), '-f' => 'bad']);
        $this->assertEquals('No patches found in ' . vfsStream::url('foo') . ".\n", $this->commandTester->getDisplay());
    }
}
