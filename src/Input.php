<?php

namespace Aodamuz\Form;

use Aodamuz\Form\Traits\InputTypes;

class Input extends Field
{
    use InputTypes;

    /**
     * The types of Inputs in which the attributes should not be generated
     * automatically.
     *
     * @var array
     */
    protected $noAttributeGenerator = [
        'checkbox', 'radio', 'file'
    ];

    /**
     * Prepare the attributes for the current element.
     *
     * @return void
     */
    protected function prepareAttributes()
    {
        $value = $this->factory->attributes->pull('value');

        if (!in_array($this->type, $this->noAttributeGenerator)) {
            if ($this->label) {
                $this->factory->attributes->add(
                    'placeholder',
                    "{$this->label}..."
                );
            } else {
                $this->factory->attributes->add(
                    'placeholder',
                    Generator::label($this->identifier, '...', !$this->fake)
                );
            }

            $this->factory->attributes->add(
                'autocomplete',
                Generator::autocomplete($this->identifier)
            );

            $this->factory->attributes->add(
                'inputmode',
                Generator::inputmode($this->identifier)
            );
        }

        if ($this->type === 'file')
            return;

        if (isset($this->session) && !empty($this->identifier)) {
            if (!in_array($this->type, ['password', 'checkbox', 'radio'])) {
                $value = $this->session->getOldInput($this->identifier) ?? $value;
            }
        }

        $this->factory->attributes->set('value', $value);
    }
}
