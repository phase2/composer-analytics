<?php

namespace Phase2\ComposerAnalytics\Formatter;

/**
 * A formatter factory.
 */
class Factory
{
    public static function get(string $type): FormatterInterface
    {
        $class = '\\Phase2\\ComposerAnalytics\\Formatter\\' . ucfirst($type);
        if (!class_exists($class)) {
            throw new \LogicException('No formatter exists for ' . $type);
        }
        return new $class;
    }
}
