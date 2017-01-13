<?php

namespace Phase2\ComposerAnalytics\Patch;

class Patch implements PatchInterface
{
    /**
     * Regex for drupal.org patch URIs.
     */
    const DRUPAL_ORG_ISSUE_FROM_PATCH = '@(\d+)([_-]\d+)?@';

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
        return $this->findIssueUri();
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
        if (preg_match(static::DRUPAL_ORG_ISSUE_FROM_PATCH, $this->rawUri, $matches)) {
            $issue_number = $matches[1];
            return 'https://www.drupal.org/node/' . $issue_number;
        }
    }
}
