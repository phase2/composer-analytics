<?php

namespace spec\Phase2\ComposerAnalytics\Patch;

use Phase2\ComposerAnalytics\Patch\GithubPatch;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GithubPatchSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('project', 'https://patch-diff.githubusercontent.com/raw/Gizra/message_subscribe/pull/64.diff', 'description');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(GithubPatch::class);
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
        $this->getPatchUri()->shouldReturn('https://patch-diff.githubusercontent.com/raw/Gizra/message_subscribe/pull/64.diff');
    }

    function it_calculates_a_uri()
    {
        $this->getIssueUri()->shouldReturn('https://github.com/Gizra/message_subscribe/pull/64');
    }
}
