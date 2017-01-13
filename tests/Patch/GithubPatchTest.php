<?php

namespace Phase2\ComposerAnalytics\Tests\Patch;

use Phase2\ComposerAnalytics\Patch\Exception\NoIssueFoundException;
use Phase2\ComposerAnalytics\Patch\GithubPatch;

/**
 * @coversDefaultClass \Phase2\ComposerAnalytics\Patch\GithubPatch
 */
class GithubPatchTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers ::getIssueUri
     *
     * @dataProvider providerTestGetIssueUri
     */
    public function testGetIssueUri($patch_uri, $expected, $exception = FALSE)
    {
        if ($exception)
        {
            $this->setExpectedException(NoIssueFoundException::class);
        }
        $patch = new GithubPatch('test_project', $patch_uri, 'test description');
        $this->assertEquals($expected, $patch->getIssueUri());
    }

    /**
     * Data provider for ::testGetIssueUri.
     */
    public function providerTestGetIssueUri()
    {
        return [
            ['https://github.com/Gizra/message_subscribe/pull/64.diff', 'https://github.com/Gizra/message_subscribe/pull/64'],
            ['https://github.com/Gizra/message_subscribe/pull/64.patch', 'https://github.com/Gizra/message_subscribe/pull/64'],
            ['https://patch-diff.githubusercontent.com/raw/Gizra/message_subscribe/pull/64.diff', 'https://github.com/Gizra/message_subscribe/pull/64'],
            ['https://patch-diff.githubusercontent.com/raw/Gizra/message_subscribe/pull/64.patch', 'https://github.com/Gizra/message_subscribe/pull/64'],
            ['https://github.com/pull/file.diff', '', TRUE],
        ];
    }

}
