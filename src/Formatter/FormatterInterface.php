<?php

namespace Phase2\ComposerAnalytics\Formatter;

/**
 * Defines a formatter for composer analytics reporting.
 */
interface FormatterInterface
{

    /**
     * Formats given analyzed composer data.
     *
     * @param array $analyzed
     *
     * @return string
     */
    public function format(array $analyzed): string;
}
