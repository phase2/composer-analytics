<?php

namespace spec\Phase2\ComposerAnalytics;

use Phase2\ComposerAnalytics\Application;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ApplicationSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Application::class);
    }
}
