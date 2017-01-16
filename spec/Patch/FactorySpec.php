<?php

namespace spec\Phase2\ComposerAnalytics\Patch;

use Phase2\ComposerAnalytics\Patch\DrupalOrgPatch;
use Phase2\ComposerAnalytics\Patch\Factory;
use Phase2\ComposerAnalytics\Patch\GithubPatch;
use Phase2\ComposerAnalytics\Patch\LocalPatch;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FactorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Factory::class);
    }

    function it_gets_local_patches()
    {
        $this->getPatch('project', 'src/patches/foo.patch', 'description')->shouldHaveType(LocalPatch::class);
    }

    function it_gets_drupalorg_patches()
    {
        $this->getPatch('drupal/core', 'https://www.drupal.org/foo.patch', 'description')->shouldHaveType(DrupalOrgPatch::class);
    }

    function it_gets_github_patches()
    {
        $this->getPatch('drupal/message', 'https://github.com/foo/message/pulls/123.diff', 'description')->shouldHaveType(GithubPatch::class);
    }
}
