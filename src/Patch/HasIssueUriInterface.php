<?php

namespace Phase2\ComposerAnalytics\Patch;

use Phase2\ComposerAnalytics\Patch\Exception\NoIssueFoundException;

/**
 * Interface for patch types that have a corresponding issue URI.
 */
interface HasIssueUriInterface
{
    /**
     * Retrieve the appropriate issue link.
     *
     * This is expected to be the actual link to the issue, not the patch's raw uri.
     *
     * @return string
     *
     * @throws NoIssueFoundException
     *   This is thrown if an issue cannot be extracted from the patch URI.
     */
    public function getIssueUri();
}
