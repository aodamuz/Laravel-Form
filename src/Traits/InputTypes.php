<?php

namespace Aodamuz\Form\Traits;

trait InputTypes
{
    /**
     * Set the input type as type checkbox.
     *
     * @param  array  $attributes
     * @return static
     */
    public function checkbox(array $attributes = []) {
        $this->factory->attributes->set('type', __FUNCTION__);

        return $this;
    }

    /**
     * Set the input type to color type.
     *
     * @param  array  $attributes
     * @return static
     */
    public function color(array $attributes = []) {
        $this->factory->attributes->set('type', __FUNCTION__);

        return $this;
    }

    /**
     * Set the input type as date type.
     *
     * @param  array  $attributes
     * @return static
     */
    public function date(array $attributes = []) {
        $this->factory->attributes->set('type', __FUNCTION__);

        return $this;
    }

    /**
     * Sets the input type as datetime-local type.
     *
     * @param  array  $attributes
     * @return static
     */
    public function datetimeLocal(array $attributes = []) {
        $this->factory->attributes->set('type', 'datetime-local');

        return $this;
    }

    /**
     * Set the input type as email type.
     *
     * @param  array  $attributes
     * @return static
     */
    public function email(array $attributes = []) {
        $this->factory->attributes->set('type', __FUNCTION__);

        return $this;
    }

    /**
     * Set the input type to file type.
     *
     * @param  array  $attributes
     * @return static
     */
    public function file(array $attributes = []) {
        $this->factory->attributes->set('type', __FUNCTION__);

        return $this;
    }

    /**
     * Set the input type to type month.
     *
     * @param  array  $attributes
     * @return static
     */
    public function month(array $attributes = []) {
        $this->factory->attributes->set('type', __FUNCTION__);

        return $this;
    }

    /**
     * Sets the input type to type number.
     *
     * @param  array  $attributes
     * @return static
     */
    public function number(array $attributes = []) {
        $this->factory->attributes->set('type', __FUNCTION__);

        return $this;
    }

    /**
     * Set the input type as password type.
     *
     * @param  array  $attributes
     * @return static
     */
    public function password(array $attributes = []) {
        $this->factory->attributes->set('type', __FUNCTION__);

        return $this;
    }

    /**
     * Sets the input type to radio type.
     *
     * @param  array  $attributes
     * @return static
     */
    public function radio(array $attributes = []) {
        $this->factory->attributes->set('type', __FUNCTION__);

        return $this;
    }

    /**
     * Set the input type to type range.
     *
     * @param  array  $attributes
     * @return static
     */
    public function range(array $attributes = []) {
        $this->factory->attributes->set('type', __FUNCTION__);

        return $this;
    }

    /**
     * Set the input type to type search.
     *
     * @param  array  $attributes
     * @return static
     */
    public function search(array $attributes = []) {
        $this->factory->attributes->set('type', __FUNCTION__);

        return $this;
    }

    /**
     * Set the input type to type tel.
     *
     * @param  array  $attributes
     * @return static
     */
    public function tel(array $attributes = []) {
        $this->factory->attributes->set('type', __FUNCTION__);

        return $this;
    }

    /**
     * Set the input type to type text.
     *
     * @param  array  $attributes
     * @return static
     */
    public function text(array $attributes = []) {
        $this->factory->attributes->set('type', __FUNCTION__);

        return $this;
    }

    /**
     * Set the input type to type time.
     *
     * @param  array  $attributes
     * @return static
     */
    public function time(array $attributes = []) {
        $this->factory->attributes->set('type', __FUNCTION__);

        return $this;
    }

    /**
     * Set the input type to url type.
     *
     * @param  array  $attributes
     * @return static
     */
    public function url(array $attributes = []) {
        $this->factory->attributes->set('type', __FUNCTION__);

        return $this;
    }

    /**
     * Set the input type to type week.
     *
     * @param  array  $attributes
     * @return static
     */
    public function week(array $attributes = []) {
        $this->factory->attributes->set('type', __FUNCTION__);

        return $this;
    }
}
