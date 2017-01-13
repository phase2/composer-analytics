<?php

namespace Phase2\ComposerAnalytics\Patch;

use Phase2\ComposerAnalytics\Patch\Exception\NoIssueFoundException;

/**
 * Drupal.org patch handling.
 */
class DrupalOrgPatch implements PatchInterface, HasIssueUriInterface
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
     * The patch description.
     *
     * @var string
     */
    protected $description;

    /**
     * The project.
     *
     * @var string
     */
    protected $project;

    /**
     * The raw uri to the patch.
     *
     * @var string
     */
    protected $rawUri;

    /**
     * Constructs a patch object.
     *
     * @param string $project
     * @param string $uri
     * @param string $description
     */
    public function __construct($project, $uri, $description)
    {
        $this->description = $description;
        $this->project = $project;
        $this->rawUri = $uri;
    }

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

    /**
     * {@inheritdoc}
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * {@inheritdoc}
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Helper method to extract an issue uri.
     */
    protected function findIssueUri()
    {
    }

    /**
     * {@inheritdoc}
     */
    public function getPatchUri()
    {
        return $this->rawUri;
    }
}
