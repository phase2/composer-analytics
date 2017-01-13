<?php

namespace spec\Phase2\ComposerAnalytics\Parser;

use Phase2\ComposerAnalytics\Parser\Json;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class JsonSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Json::class);
    }
}
