<?php

namespace Aodamuz\Form\Traits;

use Aodamuz\Form\Generator;

trait Renderable
{
    /**
     * Get content as a string of HTML.
     *
     * @return string
     */
    public function toHtml()
    {
        return $this->render();
    }

    /**
     * Render the element as a valid html.
     *
     * @return string
     */
    public function render() : string
    {
        $this->type = $this->factory->attributes->get('type', $this->tagName);

        // If the id attribute does not exist, one will be generated based on
        // the value of the $ identifier property, if the value of the
        // $identifier property does not exist, one will be generated with
        // random letters and numbers.
        if (!$this->factory->attributes->has('id')) {
            $this->factory->attributes->add('id', Generator::id($this->identifier));
        }

        $this->prepareAttributes();

        if ($this->grouped) {
            $this->factory->setWrapper(
                $this->hasWrapper() ? $this->wrapper : $this->defaultWrapper()
            );
        }

        $this->label = null;

        return $this->factory->render();
    }
}
