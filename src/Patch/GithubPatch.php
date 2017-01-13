<?php

namespace Phase2\ComposerAnalytics\Patch;

use Phase2\ComposerAnalytics\Patch\Exception\NoIssueFoundException;

/**
 * GitHub patch handling.
     */
class GithubPatch extends PatchBase implements HasIssueUriInterface
{
    /**
     * Regex for drupal.org patch URIs.
     */
    const GITHUB_ISSUE_FROM_PATCH = '@(github(usercontent)?\.com)\/(raw\/)?(.*pull\/(\d+))\.(diff|patch)$@';

    /**
     * URL template for drupal.org issues.
     */
    const URL_TEMPLATE = 'https://github.com/%s';

    /**
     * {@inheritdoc}
     */
    public function getIssueUri()
    {
        if (preg_match(static::GITHUB_ISSUE_FROM_PATCH, $this->rawUri, $matches)) {
            return sprintf(static::URL_TEMPLATE, $matches[4]);
        }

        throw new NoIssueFoundException(sprintf('No issue URI could be extracted from the patch: %s.', $this->rawUri));
    }
}
