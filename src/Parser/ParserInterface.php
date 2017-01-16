<?php

namespace Phase2\ComposerAnalytics\Parser;

use Phase2\ComposerAnalytics\Patch\PatchInterface;

interface ParserInterface
{
    /**
     * Pattern to search for.
     *
     * @return string
     */
    public function getPattern();

    /**
     * Find all patches.
     *
     * @param string $file
     *
     * @return PatchInterface[]
     */
    public function findPatches($file);
}
