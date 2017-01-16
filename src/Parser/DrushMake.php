<?php

namespace Phase2\ComposerAnalytics\Parser;

use Phase2\ComposerAnalytics\Parser\Drush\DrushIniParser;
use Phase2\ComposerAnalytics\Patch\Factory as PatchFactory;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;

class DrushMake implements ParserInterface
{
    /**
     * {@inheritdoc}
     */
    public function getPattern()
    {
        return '/.+.make(\.(yaml|yml))?$/';
    }

    /**
     * {@inheritdoc}
     */
    public function findPatches($file)
    {
        $found_patches = [];

        $contents = $this->parse($file);
        foreach ($contents['projects'] as $project_name => $project_data) {
            if (isset($project_data['patch'])) {
                foreach ($project_data['patch'] as $description => $patch) {
                    $found_patches[] = PatchFactory::getPatch($project_name, $patch, $description);
                }
            }
        }

        return $found_patches;
    }

    /**
     * Determine YAML or INI format, and parse.
     *
     * @param string $data
     * @return array
     *
     * @throws ParseException
     *   This will be thrown if the data cannot be parsed as INI or YAML.
     */
    protected function parse($data)
    {
        // Try YAML first.
        try {
            $parsed = Yaml::parse($data);
            return $parsed;
        } catch (ParseException $e) {
            // Either an INI file, or invalid YAML.
        }

        // Try INI.
        // @todo Consider using Drush's INI parser which is more robust, but might not be needed for patch analysis.
        if ($parsed = DrushIniParser::parse($data)) {
            return $parsed;
        }

        // Throw YAML exception.
        throw $e;
    }
}
