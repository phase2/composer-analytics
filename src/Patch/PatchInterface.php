<?php

namespace Phase2\ComposerAnalytics\Patch;

/**
 * A patch interface.
 */
interface PatchInterface
{
    /**
     * Retrieve the appropriate issue link.
     *
     * This is expected to be the actual link to the issue, not the patch's raw uri.
     *
     * @return string
     */
    public function getIssueUri();

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
