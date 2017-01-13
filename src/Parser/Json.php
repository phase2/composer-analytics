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
                var_dump($patches);
                foreach ($patches as $description => $uri) {
                    $found_patches[] = new DrupalOrgPatch($project, $uri, $description);
                }
            }
        }

        return $found_patches;
    }
}
