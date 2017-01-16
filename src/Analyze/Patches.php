<?php

namespace Phase2\ComposerAnalytics\Analyze;

use Phase2\ComposerAnalytics\Patch\Exception\NoIssueFoundException;
use Phase2\ComposerAnalytics\Patch\HasIssueUriInterface;
use Phase2\ComposerAnalytics\Patch\PatchInterface;

/**
 * Patch analyzer.
 */
class Patches
{
    /**
     * Report header.
     */
    protected static $header = [
      'Project', 'Issue', 'Raw patch', 'Description',
    ];

    /**
     * Used in the report for the issue uri when no uri can be calculated.
     */
    const NO_ISSUE_URI = 'Could not determine issue';

    /**
     * Patches to analyze.
     *
     * @var PatchInterface[]
     */
    protected $patches = [];

    /**
     * Set patches to analyze.
     *
     * @param PatchInterface[] $patches
     */
    public function setPatches(array $patches)
    {
        $this->patches = $patches;
    }

    /**
     * Get raw patches.
     *
     * @return \Phase2\ComposerAnalytics\Patch\PatchInterface[]
     */
    public function getPatches()
    {
        return $this->patches;
    }

    /**
     * Analyze patches.
     *
     * @return array
     */
    public function analyze()
    {
        $analysis = [static::$header];

        foreach ($this->patches as $patch) {
            if ($patch instanceof HasIssueUriInterface) {
                try {
                    $issue_uri = $patch->getIssueUri();
                } catch (NoIssueFoundException $e) {
                    $issue_uri = static::NO_ISSUE_URI;
                }
            } else {
                $issue_uri = 'No known issue';
            }

            $analysis[] = [
                $patch->getProject(),
                $issue_uri,
                $patch->getPatchUri(),
                $patch->getDescription(),
            ];
        }

        // @todo Some sort of sorting, and potentially aggregation.
        return $analysis;
    }
}
