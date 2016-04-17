<?php

namespace Acme\Parsers;

use PhpSpec\ObjectBehavior;

class FieldSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Acme\Parsers\Field');
    }

    public function it_parses_fields_into_an_array()
    {
        $this->parse('title:string')
            ->shouldReturn([
                'title' => 'string',
            ]);

        $this->parse('title:string, body:text')
            ->shouldReturn([
                'title' => 'string',
                'body' => 'text',
            ]);

        $this->parse('title:string,body:text')
            ->shouldReturn([
                'title' => 'string',
                'body' => 'text',
            ]);
    }

    public function it_squawks_if_the_provided_field_type_is_not_recognized()
    {
        $this->shouldThrow('Acme\Parsers\Exceptions\UnrecognizedType')
            ->duringParse('title:foobar');
    }
}
