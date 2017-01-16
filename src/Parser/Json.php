<?php

namespace Phase2\ComposerAnalytics\Parser;

use Phase2\ComposerAnalytics\Patch\DrupalOrgPatch;

class Json implements ParserInterface
{
    /**
     * {@inheritdoc}
     */
    public function findPatches($file)
    {
        $found_patches = [];
        $contents = json_decode($file);

        if (isset($contents->extra->patches)) {
            foreach ($contents->extra->patches as $project => $patches) {
                foreach ($patches as $description => $uri) {
                    // @todo Use a factory to determine patch type.
                    $found_patches[] = new DrupalOrgPatch($project, $uri, $description);
                }
            }
        }

        return $found_patches;
    }

    /**
     * {@inheritdoc}
     */
    public function getPattern()
    {
        return 'composer.json';
    }
}
