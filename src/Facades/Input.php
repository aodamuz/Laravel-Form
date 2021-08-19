<?php

namespace Aodamuz\Form\Facades;

use Illuminate\Support\Facades\Facade;

class Input extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     *
     * @throws \RuntimeException
     */
    protected static function getFacadeAccessor()
    {
        return 'input';
    }
}
