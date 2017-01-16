<?php

namespace spec\Phase2\ComposerAnalytics\Parser;

use Phase2\ComposerAnalytics\Parser\DrushMake;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DrushMakeSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(DrushMake::class);
    }

    function it_has_a_pattern()
    {
        $this->getPattern()->shouldReturn('/.+.make(\.(yaml|yml))?$/');
    }
}
