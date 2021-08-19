<?php

namespace Aodamuz\Form\Traits;

use Illuminate\Support\Str;

trait Initialable
{
    /**
     * Identifier of the current element. This property is used to assign the
     * value of the "name" attribute or the "wire:model" attribute.
     *
     * @var string|null
     */
    protected ?string $identifier = null;

    /**
     * Start a new instance with the given "name" attribute.
     *
     * @param  string $name
     * @param  array  $attributes
     * @return static
     */
    public function name(string $name, array $attributes = []) : self
    {
        $this->setIdentifier($name);

        $attributes['type'] = 'text';
        $attributes['name'] = $name;

        $this->factory->attributes->add($attributes);

        return $this;
    }

    /**
     * Start a new instance with a livewire model.
     *
     * @param  string $name
     * @param  array|string|null $modifiers
     * @param  array  $attributes
     * @return static
     */
    public function wire(string $name, $modifiers = null, array $attributes = []) : self
    {
        $this->setIdentifier($name);

        $attributes['type'] = 'text';
        $attributes["wire:model{$this->modifiersParser($modifiers)}"] = $name;

        $this->factory->attributes->add($attributes);

        return $this;
    }

    /**
     * Mix the given attributes with the attribute list.
     *
     * @param  array  $attributes
     * @return static
     */
    public function merge(array $attributes) : self
    {
        foreach ($attributes as $key => $value) {
            if (
                $key === 'name' ||
                $key === 'wire:model' ||
                Str::startsWith($key, 'wire:model')
            ) {
                $this->setIdentifier($value);
            }
        }

        $this->factory->attributes->set(array_merge(
            $this->factory->attributes->all(),
            $attributes
        ));

        return $this;
    }

    /**
     * Establece el identificador del elemento actual.
     *
     * This method sets the value of the $identifier property, which is used to
     * access the value of the "name" attribute or the "wire:model" attribute.
     * This value is important for locating validation errors and for generating
     * missing attributes and visible text for the element when grouped.
     *
     * @param string $value
     * @return static
     */
    public function setIdentifier(string $value) : self
    {
        $this->identifier = str_replace(
            ['[]', '[', ']'],
            ['', '.', ''],
            $value
        );

        return $this;
    }

    /**
     * Parse and convert a given livewire modifier.
     *
     * @param  array|string|null $modifiers
     * @return string|null
     */
    protected function modifiersParser($modifiers) : ?string
    {
        if ($modifiers) {
            if (is_array($modifiers)) {
                $modifiers = implode('.', $modifiers);
            }

            $modifiers = '.'.trim($modifiers, '.');
        }

        return $modifiers;
    }
}
