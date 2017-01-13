<?php

namespace Phase2\ComposerAnalytics\Parser;

use Phase2\ComposerAnalytics\Patch\PatchInterface;

interface ParserInterface
{
    /**
     * Find all patches.
     *
     * @param string $file
     *
     * @return PatchInterface[]
     */
    public function findPatches($file);
}
