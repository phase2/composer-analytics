<?php

namespace Phase2\ComposerAnalytics\Patch;

/**
 * Base class implementation for patches.
 */
abstract class PatchBase implements PatchInterface
{
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
     * {@inheritdoc}
     */
    public function getPatchUri()
    {
        return $this->rawUri;
    }
}
