<?php

namespace spec\Phase2\ComposerAnalytics\Parser;

use Phase2\ComposerAnalytics\Parser\Factory;
use Phase2\ComposerAnalytics\Parser\Json;
use Phase2\ComposerAnalytics\Parser\ParserInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FactorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Factory::class);
    }

    function it_returns_a_parser()
    {
        $this->get('json')->shouldImplement(ParserInterface::class);
        $this->get('json')->shouldHaveType(Json::class);
    }

    function it_throws_invalid_types()
    {
        $this->shouldThrow(\LogicException::class)->during('get', ['bad']);
    }
}
