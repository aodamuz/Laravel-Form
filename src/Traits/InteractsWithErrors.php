<?php

namespace Aodamuz\Form\Traits;

use Illuminate\Support\ViewErrorBag;
use Illuminate\Contracts\Support\MessageBag;

trait InteractsWithErrors
{
    /**
     * Bag of errors in the views.
     *
     * @var string
     */
    protected $bag = 'default';

    /**
     * Returns a boolean wether the given attribute has an error.
     *
     * @return boolean
     */
    public function hasError() : bool
    {
        $errors = $this->errors();

        return $errors->has(
            $this->identifier
        ) || $errors->has(
            "{$this->identifier}.*"
        );
    }

    /**
     * Sets the name of the current MessageBag.
     *
     * @param  string $bag
     * @return static
     */
    public function bag(string $bag) : self
    {
        $this->bag = $bag;

        return $this;
    }

    /**
     * Getter for the ErrorBag.
     *
     * @return \Illuminate\Contracts\Support\MessageBag
     */
    protected function errors() : MessageBag
    {
        return $this->view->shared(
            'errors',
            $this->request->session()->get('errors', new ViewErrorBag)
        )->getBag($this->bag);
    }
}
