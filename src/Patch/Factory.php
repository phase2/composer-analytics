<?php

namespace Phase2\ComposerAnalytics\Patch;

/**
 * Patch factory to get the correct patch type.
 */
class Factory
{
    /**
     * Get the patch type corresponding to the patch URI.
     *
     * Defaults to a local patch if no others can be found.
     *
     * @param string $project
     * @param string $patch_uri
     *   The path to the patch. Patch type will be determined by this.
     * @param string $description
     *
     * @return PatchInterface
     */
    public static function getPatch($project, $patch_uri, $description)
    {
        if (strpos($patch_uri, 'drupal.org') !== false) {
            return new DrupalOrgPatch($project, $patch_uri, $description);
        }

        if (strpos($patch_uri, 'github.com') !== false) {
            return new GithubPatch($project, $patch_uri, $description);
        }

        return new LocalPatch($project, $patch_uri, $description);
    }
}
