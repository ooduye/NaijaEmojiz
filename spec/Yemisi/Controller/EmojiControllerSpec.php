<?php

namespace spec\Yemisi\Controller;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EmojiControllerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Yemisi\Controller\EmojiController');
    }

    function it_should_be_an_emoji_controller_structure()
    {
        $this->shouldHaveType('Yemisi\Structure\EmojiControllerStructure');
        $this->shouldReturnAnInstanceOf('Yemisi\Structure\EmojiControllerStructure');
        $this->shouldBeAnInstanceOf('Yemisi\Structure\EmojiControllerStructure');
        $this->shouldImplement('Yemisi\Structure\EmojiControllerStructure');
    }
}
