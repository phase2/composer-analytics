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
    public function get($type)
    {
        switch ($type) {
            case 'composer.json':
                return new ComposerJson();

            default:
                throw new \LogicException(sprintf('Invalid parser type: %s', $type));
        }
    }
}
