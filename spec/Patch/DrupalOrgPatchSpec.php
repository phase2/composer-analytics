<?php

namespace spec\Phase2\ComposerAnalytics\Patch;

use Phase2\ComposerAnalytics\Patch\DrupalOrgPatch;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DrupalOrgPatchSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('project', 'http://www.drupal.org/files/foo-12345-02.patch', 'description');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(DrupalOrgPatch::class);
    }

    function it_gets_the_project()
    {
        $this->getProject()->shouldReturn('project');
    }

    function it_gets_the_description()
    {
        $this->getDescription()->shouldReturn('description');
    }

    function it_calculates_a_uri()
    {
        $this->getIssueUri()->shouldReturn('https://www.drupal.org/node/12345');
    }
}
