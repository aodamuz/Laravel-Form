<?php

namespace Aodamuz\Form\Traits;

use Aodamuz\Form\Generator;

trait Labelable
{
    /**
     * The visible name of the current item.
     *
     * @var string|null
     */
    protected ?string $label = null;

    /**
     * Gets or sets the label of the current item. When the element is grouped,
     * this value is used as visible text in the label tag.
     *
     * When this method is called and the $label parameter is not null and/or
     * is not empty, the method behaves like a setter.
     * If no parameter is added, the method returns the value of the current
     * element's label. If a tag has not been set, a new text will be generated
     * based on the value of the $identifier property.
     *
     * @param string $label
     * @return mixed
     */
    public function label(string $label = null)
    {
        if (!empty($label)) {
            $this->label = $label;

            return $this;
        }

        if (!empty($this->label)) {
            return $this->label;
        }

        return $this->label = Generator::label($this->identifier, null, !$this->fake);
    }
}
