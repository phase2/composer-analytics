<?php

namespace Phase2\ComposerAnalytics\Formatter;

class Json implements FormatterInterface
{
    /**
     * {@inheritdoc}
     */
    public function format(array $analyzed): string
    {
        return json_encode($analyzed);
    }
}
