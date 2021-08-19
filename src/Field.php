<?php

namespace Aodamuz\Form;

use Aodamuz\Form\Traits;
use Aodamuz\Html\Factory;
use Illuminate\Http\Request;
use Aodamuz\Html\Wrapperable;
use Illuminate\Support\Traits\Macroable;
use Illuminate\Contracts\Session\Session;
use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull;

abstract class Field
{
    use Macroable,
        Wrapperable,
        Traits\Groupable,
        Traits\labelable,
        Traits\Renderable,
        Traits\Initialable,
        Traits\InteractsWithErrors {
            Macroable::__call as macroCall;
        }

    /**
     * Indicate if the instance is for unit testing.
     *
     * @var bool
     */
    protected bool $fake = false;

    /**
     * Name of the Html tag.
     *
     * @var string|null
     */
    protected ?string $tagName = null;

    /**
     * Tipo de elemento actual.
     *
     * @var string
     */
    protected string $type;

    /**
     * The session store implementation.
     *
     * @var \Illuminate\Contracts\Session\Session
     */
    protected Session $session;

    /**
     * The View factory instance.
     *
     * @var \Illuminate\Contracts\View\Factory
     */
    protected ViewFactory $view;

    /**
     * Html tag factory instance.
     *
     * @var Factory
     */
    protected Factory $factory;

    /**
     * The Request instance.
     *
     * @var \Illuminate\Http\Request
     */
    protected Request $request;

    /**
     * Create a new form field instance.
     *
     * @param  ViewFactory $view
     * @param  Request     $request
     */
    public function __construct(ViewFactory $view, Request $request = null)
    {
        $this->view    = $view;
        $this->request = $request;
        $this->factory = Factory::make(
            $this->tagName ?: strtolower(
                basename(get_class($this))
            )
        );
    }

    /**
     * Set the current instance for unit tests.
     *
     * @return static
     */
    public function fake()
    {
        $this->fake = true;

        return $this;
    }

    /**
     * Prepare the attributes for the current element.
     *
     * @return void
     */
    abstract protected function prepareAttributes();

    /**
     * Set the session store implementation.
     *
     * @param  \Illuminate\Contracts\Session\Session $session
     *
     * @return $this
     */
    public function setSessionStore(Session $session)
    {
        $this->session = $session;

        return $this;
    }

    /**
     * Get the value that should be assigned to the field.
     *
     * @param  string $name
     * @param  string $value
     *
     * @return mixed
     */
    public function getValueAttribute(string $name, string $value = null)
    {
        if ($this->tagName === 'input') {
            if ($this->type === 'file') {
                return null;
            }

            $value = $this->factory->attributes->pull('value', $value);

            if (!empty($value)) {
                return $value;
            }

            if ($this->type === 'password') {
                return null;
            }
        }

        if (empty($this->identifier)) {
            return $value;
        }

        if ($this->type !== 'file') {
            if ($this->type !== 'password') {
                $value = $this->session->getOldInput($this->identifier, $value);

                $this->factory->attributes->set('value', $value);
            }
        }

        $old = $this->old();

        if (!empty($old)) {
            return $old;
        }

        if (function_exists('app')) {
            $hasNullMiddleware = app("Illuminate\Contracts\Http\Kernel")
                ->hasMiddleware(ConvertEmptyStringsToNull::class);

            if ($hasNullMiddleware
                && empty($old)
                && empty($value)
                && !empty($this->view->shared('errors'))
                && count(is_countable($this->view->shared('errors')) ? $this->view->shared('errors') : []) > 0
            ) {
                return null;
            }
        }

        $request = $this->request->input($this->identifier);

        if (!empty($request)) {
            return $request;
        }

        if (!empty($value)) {
            return $value;
        }
    }

    /**
     * Get a value from the session's old input.
     *
     * @return mixed
     */
    public function old()
    {
        $payload = $this->session->getOldInput($this->identifier);

        if (!is_array($payload)) {
            return $payload;
        }

        if (!in_array($this->type, ['select', 'checkbox'])) {
            if (!isset($this->payload[$key])) {
                $this->payload[$key] = collect($payload);
            }

            if (!empty($this->payload[$key])) {
                $value = $this->payload[$key]->shift();

                return $value;
            }
        }

        return $payload;
    }

    /**
     * Dynamically handle calls to the class.
     *
     * @param  string $method
     * @param  array  $parameters
     *
     * @return mixed
     *
     * @throws \BadMethodCallException
     */
    public function __call(string $method, array $parameters)
    {
        if (static::hasMacro($method)) {
            return $this->macroCall($method, $parameters);
        }

        $this->factory->attributes->add($method, $parameters[0] ?? true);

        return $this;
    }
}
