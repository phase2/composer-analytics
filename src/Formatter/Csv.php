<?php

namespace Phase2\ComposerAnalytics\Formatter;

use League\Csv\Writer;

/**
 * CSV formatter.
 */
class Csv implements FormatterInterface
{
    /**
     * {@inheritdoc}
     */
    public function format(array $analyzed): string
    {
        $csv = Writer::createFromFileObject(new \SplTempFileObject());
        $csv->insertAll($analyzed);
        return (string) $csv;
    }
}
