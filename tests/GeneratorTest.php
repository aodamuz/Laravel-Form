<?php

namespace Aodamuz\Form\Tests;

use Aodamuz\Form\Generator;
use Illuminate\Support\Str;

class GeneratorTest extends TestCase
{
    /** @test */
    public function the_id_attribute_can_be_generated_based_on_the_field_identifier()
    {
        $this->assertSame('element-test', Generator::id('test'));
        $this->assertSame('element-test-array', Generator::id('test[array]'));
        $this->assertSame('element-test-array-multiple', Generator::id('test[array][multiple]'));
        $this->assertSame('element-test-dotted', Generator::id('test.dotted'));
    }

    /** @test */
    public function the_id_attribute_can_be_generated_with_text_and_random_numbers()
    {
        $this->assertTrue(Str::contains($id = Generator::id(null), 'element-'));

        $this->assertSame(14, strlen($id));
    }

    /** @test */
    public function a_label_may_be_generated_based_on_the_field_identifier()
    {
        $this->assertSame('Test', Generator::label('test', null, $withTranslator = false));
        $this->assertSame('Test Array', Generator::label('test[array]', null, $withTranslator));
        $this->assertSame('Test Array Multiple', Generator::label('test[array][multiple]', null, $withTranslator));
        $this->assertSame('Test Dotted', Generator::label('test.dotted', null, $withTranslator));
        $this->assertSame('Confirm Name', Generator::label('name_confirmation', null, $withTranslator));
        $this->assertSame('Confirm First Name', Generator::label('first_name_confirmation', null, $withTranslator));
    }

    /** @test */
    public function the_autocomplete_attribute_can_be_generated()
    {
        $this->assertSame(
            'undefined',
            Generator::autocomplete('foo')
        );

        $this->assertSame(
            'current-password',
            Generator::autocomplete('password')
        );

        $this->assertSame(
            'current-password',
            Generator::autocomplete('current_password')
        );

        $this->assertSame(
            'new-password',
            Generator::autocomplete('password_confirmation')
        );

        $this->assertSame(
            'family-name',
            Generator::autocomplete('last_name')
        );

        $this->assertSame(
            'email',
            Generator::autocomplete('email')
        );
    }

    /** @test */
    public function the_inputmode_attribute_can_be_generated_based_on_the_field_identifier()
    {
        $this->assertSame(
            'email',
            Generator::inputmode('email')
        );

        $this->assertSame(
            'tel',
            Generator::inputmode('contact')
        );

        $this->assertSame(
            'tel',
            Generator::inputmode('phone')
        );

        $this->assertSame(
            'search',
            Generator::inputmode('search')
        );

        $this->assertSame(
            'url',
            Generator::inputmode('url')
        );

        $this->assertSame(
            'url',
            Generator::inputmode('link')
        );

        $this->assertSame(
            'url',
            Generator::inputmode('social_network')
        );

        $this->assertSame(
            'numeric',
            Generator::inputmode('code')
        );

        $this->assertNull(
            Generator::inputmode('foo')
        );
    }
}
