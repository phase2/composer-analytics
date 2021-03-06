<?php

namespace Phase2\ComposerAnalytics\Patch;

use Phase2\ComposerAnalytics\Patch\Exception\NoIssueFoundException;

/**
 * Drupal.org patch handling.
 */
class DrupalOrgPatch extends PatchBase implements HasIssueUriInterface
{
    /**
     * Regex for drupal.org patch URIs.
     */
    const DRUPAL_ORG_ISSUE_FROM_PATCH = '@(\d+)([_-]\d+)?@';

    /**
     * URL template for drupal.org issues.
     */
    const URL_TEMPLATE = 'https://www.drupal.org/node/%s';

    /**
     * {@inheritdoc}
     */
    public function getIssueUri()
    {
        if (preg_match(static::DRUPAL_ORG_ISSUE_FROM_PATCH, $this->rawUri, $matches)) {
            $issue_number = $matches[1];
            return sprintf(static::URL_TEMPLATE, $issue_number);
        }

        throw new NoIssueFoundException(sprintf('No issue URI could be extracted from the patch: %s.', $this->rawUri));
    }
}
