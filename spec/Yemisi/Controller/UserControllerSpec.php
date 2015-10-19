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

    function it_should_be_an_user_controller_structure()
    {
        $this->shouldHaveType('Yemisi\Structure\UserControllerStructure');
        $this->shouldReturnAnInstanceOf('Yemisi\Structure\UserControllerStructure');
        $this->shouldBeAnInstanceOf('Yemisi\Structure\UserControllerStructure');
        $this->shouldImplement('Yemisi\Structure\UserControllerStructure');
    }
}
