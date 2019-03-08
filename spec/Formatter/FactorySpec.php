<?php

namespace spec\Phase2\ComposerAnalytics\Formatter;

use Phase2\ComposerAnalytics\Formatter\Csv;
use Phase2\ComposerAnalytics\Formatter\Factory;
use Phase2\ComposerAnalytics\Formatter\FormatterInterface;
use Phase2\ComposerAnalytics\Formatter\Json;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FactorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Factory::class);
    }

    function it_gets_formatters()
    {
        $this->get('csv')->shouldImplement(FormatterInterface::class);
        $this->get('csv')->shouldHaveType(Csv::class);
        $this->get('json')->shouldImplement(FormatterInterface::class);
        $this->get('json')->shouldHaveType(Json::class);
    }

    function it_throws_invalid_types()
    {
        $this->shouldThrow(\LogicException::class)->during('get', ['bad_format']);
    }
}
