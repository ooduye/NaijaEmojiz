<?php

namespace spec\Yemisi\Controller;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UserControllerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Yemisi\Controller\UserController');
    }
}
