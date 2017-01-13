<?php

namespace spec\Phase2\ComposerAnalytics;

use Phase2\ComposerAnalytics\AnalyzeCommand;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AnalyzeCommandSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(AnalyzeCommand::class);
    }
}
