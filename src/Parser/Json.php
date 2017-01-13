<?php

namespace Phase2\ComposerAnalytics\Parser;

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
            return (array) $contents->extra->patches;
        }

        return $found_patches;
    }
}
