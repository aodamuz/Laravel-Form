<?php

namespace Aodamuz\Form\Tests;

use Mockery as m;
use Aodamuz\Form\Input;
use Aodamuz\Html\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use PHPUnit\Framework\TestCase;
use Illuminate\Contracts\View\Factory as ViewFactory;

class InputTest extends TestCase
{
    use Assertion;

    /**
     * @var Input
     */
    protected $instance;

    /**
     * This method is called before each test.
     */
    protected function setUp(): void
    {
        // Prepare request for test with some data
        $request = Request::create('/foo', 'GET', [
            "person" => [
                "name"    => "John",
                "surname" => "Doe",
            ],
            "agree" => 1,
            "array" => [1, 2, 3],
        ]);

        $request = Request::createFromBase($request);

        $this->viewFactory = m::mock(ViewFactory::class);
        $this->instance    = new Input($this->viewFactory, $request);
        $this->instance    = $this->instance->fake();
    }

    /** @test */
    public function testing_the_name_method()
    {
        $this->assertSame(
            '<input type="text" name="bar" id="element-bar" placeholder="Bar..." autocomplete="undefined">',
            $this->instance->name('bar')->render()
        );
    }

    /** @test */
    public function testing_the_property_of_the_identifier()
    {
        $identifier = $this->getClassProperty(
            $this->instance->name('bar'), 'identifier'
        );

        $this->assertSame('bar', $identifier);

        $identifier = $this->getClassProperty(
            $this->instance->name('bar.into'), 'identifier'
        );

        $this->assertSame('bar.into', $identifier);

        $identifier = $this->getClassProperty(
            $this->instance->name('array[key]'), 'identifier'
        );

        $this->assertSame('array.key', $identifier);

        $identifier = $this->getClassProperty(
            $this->instance->name('array[key][sub]'), 'identifier'
        );

        $this->assertSame('array.key.sub', $identifier);
    }

    /** @test */
    public function testing_the_wire_method()
    {
        $this->assertSame(
            '<input type="text" wire:model="bar" id="element-bar" placeholder="Bar..." autocomplete="undefined">',
            $this->instance->wire('bar')->render()
        );

        $this->assertSame(
            '<input type="text" wire:model.defer="bar" id="element-bar" placeholder="Bar..." autocomplete="undefined">',
            $this->instance->wire('bar', 'defer')->render()
        );

        $this->assertSame(
            '<input type="text" wire:model.debounce.500ms="bar" id="element-bar" placeholder="Bar..." autocomplete="undefined">',
            $this->instance->wire('bar', ['debounce', '500ms'])->render()
        );
    }

    /** @test */
    public function testing_magic_methods_for_attributes()
    {
        $this->assertSame(
            '<input type="text" name="foo" id="element-foo" value="bar" placeholder="Foo..." autocomplete="undefined">',
            $this->instance->name('foo')->value('bar')->render()
        );

        $this->assertSame(
            '<input type="text" name="bar" id="element-bar" value="foo" placeholder="Bar..." autocomplete="undefined">',
            $this->instance->name('bar')->value('foo')->render()
        );

        $this->assertSame(
            '<input type="checkbox" name="bar" id="element-bar" value="Input checkbox value">',
            $this->instance->name('bar')->checkbox()->value('Input checkbox value')->render()
        );

        $this->assertSame(
            '<input type="color" name="bar" id="element-bar" value="Input color value" placeholder="Bar..." autocomplete="undefined">',
            $this->instance->name('bar')->color()->value('Input color value')->render()
        );

        $this->assertSame(
            '<input type="date" name="bar" id="element-bar" value="Input date value" placeholder="Bar..." autocomplete="undefined">',
            $this->instance->name('bar')->date()->value('Input date value')->render()
        );

        $this->assertSame(
            '<input type="datetime-local" name="bar" id="element-bar" value="Input local value" placeholder="Bar..." autocomplete="undefined">',
            $this->instance->name('bar')->datetimeLocal()->value('Input local value')->render()
        );

        $this->assertSame(
            '<input type="email" name="bar" id="element-bar" value="Input email value" placeholder="Bar..." autocomplete="undefined">',
            $this->instance->name('bar')->email()->value('Input email value')->render()
        );

        $this->assertSame(
            '<input type="file" name="bar" id="element-bar">',
            $this->instance->name('bar')->file()->value('Input file value')->render()
        );

        $this->assertSame(
            '<input type="month" name="bar" id="element-bar" value="Input month value" placeholder="Bar..." autocomplete="undefined">',
            $this->instance->name('bar')->month()->value('Input month value')->render()
        );

        $this->assertSame(
            '<input type="number" name="bar" id="element-bar" value="Input number value" placeholder="Bar..." autocomplete="undefined">',
            $this->instance->name('bar')->number()->value('Input number value')->render()
        );

        $this->assertSame(
            '<input type="password" name="bar" id="element-bar" value="Input password value" placeholder="Bar..." autocomplete="undefined">',
            $this->instance->name('bar')->password()->value('Input password value')->render()
        );

        $this->assertSame(
            '<input type="radio" name="bar" id="element-bar" value="Input radio value">',
            $this->instance->name('bar')->radio()->value('Input radio value')->render()
        );

        $this->assertSame(
            '<input type="range" name="bar" id="element-bar" value="Input range value" placeholder="Bar..." autocomplete="undefined">',
            $this->instance->name('bar')->range()->value('Input range value')->render()
        );

        $this->assertSame(
            '<input type="search" name="bar" id="element-bar" value="Input search value" placeholder="Bar..." autocomplete="undefined">',
            $this->instance->name('bar')->search()->value('Input search value')->render()
        );

        $this->assertSame(
            '<input type="tel" name="bar" id="element-bar" value="Input tel value" placeholder="Bar..." autocomplete="undefined">',
            $this->instance->name('bar')->tel()->value('Input tel value')->render()
        );

        $this->assertSame(
            '<input type="text" name="bar" id="element-bar" value="Input text value" placeholder="Bar..." autocomplete="undefined">',
            $this->instance->name('bar')->text()->value('Input text value')->render()
        );

        $this->assertSame(
            '<input type="time" name="bar" id="element-bar" value="Input time value" placeholder="Bar..." autocomplete="undefined">',
            $this->instance->name('bar')->time()->value('Input time value')->render()
        );

        $this->assertSame(
            '<input type="url" name="bar" id="element-bar" value="Input url value" placeholder="Bar..." autocomplete="undefined">',
            $this->instance->name('bar')->url()->value('Input url value')->render()
        );

        $this->assertSame(
            '<input type="week" name="bar" id="element-bar" value="Input week value" placeholder="Bar..." autocomplete="undefined">',
            $this->instance->name('bar')->week()->value('Input week value')->render()
        );

        $this->assertSame(
            '<input type="checkbox" name="bar" id="element-bar" checked="checked">',
            $this->instance->name('bar')->checkbox()->checked()->render()
        );

        $this->assertSame(
            '<input type="number" name="bar" id="element-bar" min="1" placeholder="Bar..." autocomplete="undefined">',
            $this->instance->name('bar')->number()->min(1)->render()
        );

        $this->assertSame(
            '<input type="text" name="bar" id="element-bar" placeholder="any" autocomplete="undefined">',
            $this->instance->name('bar')->placeholder('any')->render()
        );
    }

    /** @test */
    public function testing_the_grouped_mode()
    {
        $expected = '';

        $expected .= '<div class="flex w-full flex-col">';

            $expected .= '<label for="some-id" class="block truncate w-full mb-1">';
                $expected .= '<span class="inline-block">Testing Label</span>';
            $expected .= '</label>';

            $expected .= '<div class="flex flex-auto items-stretch">';
                $expected .= '<div class="flex-shrink flex-grow flex-auto w-px">';
                    $expected .= '<div class="relative">';
                        $expected .= '<input type="text" name="test" id="some-id" placeholder="Testing Label..." autocomplete="undefined">';
                    $expected .= '</div>';
                $expected .= '</div>';
            $expected .= '</div>';

        $expected .= '</div>';

        $this->assertSame(
            $expected,
            $this->instance->name('test')->label('Testing Label')->grouped()->id('some-id')->render()
        );

        $expected = '';

        $expected .= '<div class="flex w-full flex-col">';

            $expected .= '<label for="element-generated-label" class="block truncate w-full mb-1">';
                $expected .= '<span class="inline-block">Generated Label</span>';
            $expected .= '</label>';

            $expected .= '<div class="flex flex-auto items-stretch">';
                $expected .= '<div class="flex-shrink flex-grow flex-auto w-px">';
                    $expected .= '<div class="relative">';
                        $expected .= '<input type="text" name="generated_label" id="element-generated-label" placeholder="Generated Label..." autocomplete="undefined">';
                    $expected .= '</div>';
                $expected .= '</div>';
            $expected .= '</div>';

        $expected .= '</div>';

        $this->assertSame(
            $expected,
            $this->instance->name('generated_label')->grouped()->render()
        );
    }

    /** @test */
    public function passwords_not_filled()
    {
        $instance = $this->instance->setSessionStore($session = \Mockery::mock('Illuminate\Contracts\Session\Session'));

        $session->shouldReceive('getOldInput')->never();

        $this->assertSame(
            '<input type="password" name="bar" id="element-bar" placeholder="Bar..." autocomplete="undefined">',
            $instance->name('bar')->password()->render()
        );
    }

    /** @test */
    public function files_not_filled()
    {
        $instance = $this->instance->setSessionStore($session = \Mockery::mock('Illuminate\Contracts\Session\Session'));

        $session->shouldReceive('getOldInput')->never();

        $this->assertSame(
            '<input type="file" name="bar" id="element-bar">',
            $instance->name('bar')->file()->render()
        );
    }

    /** @test */
    public function checkboxes_not_filled()
    {
        $instance = $this->instance->setSessionStore($session = \Mockery::mock('Illuminate\Contracts\Session\Session'));

        $session->shouldReceive('getOldInput')->never();

        $this->assertSame(
            '<input type="checkbox" name="text[key][sub]" id="element-text-key-sub" value="default value">',
            $instance->name('text[key][sub]')->checkbox()->value('default value')->render()
        );
    }

    /** @test */
    public function checkboxes_can_be_filled_with_the_default_value()
    {
        $this->assertSame(
            '<input type="checkbox" name="text[key][sub]" id="element-text-key-sub" value="default value">',
            $this->instance->name('text[key][sub]')->checkbox()->value('default value')->render()
        );
    }

    /** @test */
    public function radio_not_filled()
    {
        $instance = $this->instance->setSessionStore($session = \Mockery::mock('Illuminate\Contracts\Session\Session'));

        $session->shouldReceive('getOldInput')->never();

        $this->assertSame(
            '<input type="radio" name="text[key][sub]" id="element-text-key-sub" value="default value">',
            $instance->name('text[key][sub]')->radio()->value('default value')->render()
        );
    }

    /** @test */
    public function radio_can_be_filled_with_the_default_value()
    {
        $this->assertSame(
            '<input type="radio" name="text[key][sub]" id="element-text-key-sub" value="default value">',
            $this->instance->name('text[key][sub]')->radio()->value('default value')->render()
        );
    }

    /** @test */
    public function repopulation()
    {
        $session = m::mock('Illuminate\Contracts\Session\Session');

        $this->instance->setSessionStore($session);

        // Here the oldInput should fill the field.

        $session
            ->shouldReceive('getOldInput')
            ->once()
            ->with('text.key.sub')
            ->andReturn('new value')
        ;

        $this->assertSame(
            '<input type="text" name="text[key][sub]" id="some-id" value="new value" placeholder="Text Key Sub..." autocomplete="undefined">',
            $this->instance->name('text[key][sub]')->id('some-id')->value('default value')->render()
        );
    }
}
