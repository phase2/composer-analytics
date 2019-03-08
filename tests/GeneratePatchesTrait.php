<?php

namespace Phase2\ComposerAnalytics\Tests;

use Phase2\ComposerAnalytics\Patch\Factory;

/**
 * Test trait to generate patches.
 */
trait GeneratePatchesTrait
{
    /**
     * Test data.
     */
    protected static $patches = [
        // A local patch.
        ['drupal/core', 'src/patches/foo.patch', 'A local patch'],
        // d.o. patch.
        ['drupal/core', 'https://www.drupal.org/files/12345-04.patch', 'Terse'],
        // Same d.o. patch, different comment.
        ['drupal/core', 'https://www.drupal.org/files/12345-277.patch', 'A different desc'],
        // Github.
        ['drupal/message_subscribe', 'https://github.com/foo/bar/pull/123.diff', 'A description'],
        // Bad actor.
        ['drupal/token', 'https://www.drupal.org/files/no-context-at-all-patch.patch', 'Fix it'],
    ];


    /**
     * Generate patches for testing.
     *
     * @return \Phase2\ComposerAnalytics\Patch\PatchInterface[]
     */
    protected function generatePatches()
    {
        $patches = [];
        foreach (static::$patches as $data) {
            $patches[] = Factory::getPatch($data[0], $data[1], $data[2]);
        }
        return $patches;
    }
}
