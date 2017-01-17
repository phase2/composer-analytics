<?php

namespace Phase2\ComposerAnalytics\Tests\Analyze;
use Phase2\ComposerAnalytics\Analyze\Patches;
use Phase2\ComposerAnalytics\Tests\GeneratePatchesTrait;

/**
 * Test the patch analyzer.
 *
 * @coversDefaultClass \Phase2\ComposerAnalytics\Analyze\Patches
 */
class PatchesTest extends \PHPUnit_Framework_TestCase
{
    use GeneratePatchesTrait;

    /**
     * Patch analyzer.
     *
     * @var \Phase2\ComposerAnalytics\Analyze\Patches
     */
    protected $patchAnalyzer;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();
        $this->patchAnalyzer = new Patches();
        $this->patchAnalyzer->setPatches($this->generatePatches());
    }

    /**
     * @covers ::analyze
     */
    public function testAnalyze()
    {
        $expected = [
            ['Project', 'Issue', 'Raw patch', 'Description'],
            ['drupal/core', 'No known issue', 'src/patches/foo.patch', 'A local patch'],
            ['drupal/core', 'https://www.drupal.org/node/12345', 'https://www.drupal.org/files/12345-04.patch', 'Terse'],
            ['drupal/core', 'https://www.drupal.org/node/12345', 'https://www.drupal.org/files/12345-277.patch', 'A different desc'],
            ['drupal/message_subscribe', 'https://github.com/foo/bar/pull/123', 'https://github.com/foo/bar/pull/123.diff', 'A description'],
            ['drupal/token', 'Could not determine issue', 'https://www.drupal.org/files/no-context-at-all-patch.patch', 'Fix it'],
        ];
        $this->assertEquals($expected, $this->patchAnalyzer->analyze());
    }
}
