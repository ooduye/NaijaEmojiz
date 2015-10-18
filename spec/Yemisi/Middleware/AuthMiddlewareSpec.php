<?php

namespace spec\Yemisi\Middleware;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AuthMiddlewareSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Yemisi\Middleware\AuthMiddleware');
    }
}
