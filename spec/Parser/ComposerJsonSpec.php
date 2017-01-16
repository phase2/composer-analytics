<?php

namespace spec\Phase2\ComposerAnalytics\Parser;

use Phase2\ComposerAnalytics\Parser\ComposerJson;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ComposerJsonSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ComposerJson::class);
    }

    function it_has_a_pattern()
    {
        $this->getPattern()->shouldReturn('composer.json');
    }
}
