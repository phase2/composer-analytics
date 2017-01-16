<?php

namespace spec\Phase2\ComposerAnalytics\Analyze;

use Phase2\ComposerAnalytics\Analyze\Patches;
use Phase2\ComposerAnalytics\Patch\DrupalOrgPatch;
use Phase2\ComposerAnalytics\Patch\GithubPatch;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PatchesSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Patches::class);
    }

    function it_can_set_and_get_patches(DrupalOrgPatch $patch)
    {
        $patches = [
            $patch,
        ];
        $this->setPatches($patches);
        $this->getPatches()->shouldReturn($patches);
    }

    function it_can_analyze_patches()
    {
        $drupal = new DrupalOrgPatch(
            'project',
            'http://www.drupal.org/files/foo-12345-02.patch',
            'description'
        );
        $bad = new DrupalOrgPatch(
            'project',
            'http://www.drupal.org/files/foo-no-issue.patch',
            'description'
        );

        $patches = [$drupal, $bad];
        $this->setPatches($patches);
        $return = [
            ['Project', 'Issue', 'Raw patch', 'Description'],
            [$drupal->getProject(), $drupal->getIssueUri(), $drupal->getPatchUri(), $drupal->getDescription()],
            [$bad->getProject(), Patches::NO_ISSUE_URI, $bad->getPatchUri(), $bad->getDescription()],
        ];

        $this->analyze()->shouldReturn($return);
    }
}
