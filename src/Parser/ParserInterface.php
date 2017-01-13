<?php

namespace Phase2\ComposerAnalytics\Parser;

interface ParserInterface
{
    /**
     * Find all patches.
     *
     * @param string $file
     *
     * @return array
     */
    public function findPatches($file);
}
