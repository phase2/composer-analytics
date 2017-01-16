<?php

namespace Phase2\ComposerAnalytics\Parser;

class Factory
{
    /**
     * @param string $type
     *   The parser type.
     *
     * @return ParserInterface
     */
    public static function get($type)
    {
        switch ($type) {
            case 'composer':
                return new ComposerJson();

            case 'make':
                return new DrushMake();

            default:
                throw new \LogicException(sprintf('Invalid parser type: %s', $type));
        }
    }
}
