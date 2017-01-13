<?php

namespace Phase2\ComposerAnalytics\Patch;

/**
 * A patch interface.
 */
interface PatchInterface
{
    /**
     * Get the patch URI.
     *
     * @return string
     */
    public function getPatchUri();

    /**
     * Get the patch project.
     *
     * @return string
     */
    public function getProject();

    /**
     * Get the patch description.
     *
     * @return string
     */
    public function getDescription();
}
