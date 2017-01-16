<?php

namespace spec\Phase2\ComposerAnalytics\Patch;

use Phase2\ComposerAnalytics\Patch\LocalPatch;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class LocalPatchSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('project', 'src/patches/hackzor.patch', 'description');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(LocalPatch::class);
    }

    function it_gets_the_project()
    {
        $this->getProject()->shouldReturn('project');
    }

    function it_gets_the_description()
    {
        $this->getDescription()->shouldReturn('description');
    }

    function it_gets_the_raw_uri()
    {
        $this->getPatchUri()->shouldReturn('src/patches/hackzor.patch');
    }
}
