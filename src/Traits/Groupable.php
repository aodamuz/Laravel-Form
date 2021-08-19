<?php

namespace Aodamuz\Form\Traits;

trait Groupable
{
    /**
     * Indicate if the item is grouped.
     *
     * @var bool
     */
    protected bool $grouped = false;

    /**
     * Sets the item as grouped.
     *
     * @param  bool|boolean $value
     * @return static
     */
    public function grouped(bool $value = true) : self
    {
        $this->grouped = $value;

        return $this;
    }

    /**
     * Get the wrapping of the element when it is grouped.
     *
     * @return string
     */
    protected function defaultWrapper() : string
    {
        $html = $toggler = $directive = '';

        if ($this->factory->attributes->get('type') === 'password') {
            $this->factory->attributes->add(':type', 'type');

            $directive = ' x-data="password"';

            $toggler .= '<button type="button" x-bind="trigger" tabindex="-1" class="-translate-y-1/2 absolute btn p-1 right-2 top-1/2">';
                $toggler .= '<svg width="18" height="18" fill="none" stroke-width="2" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">';
                    $toggler .= '<path x-show="!show" d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>';
                    $toggler .= '<circle x-show="!show" cx="12" cy="12" r="3"></circle>';

                    $toggler .= '<path x-show="show" d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24" style="display: none;"></path>';
                    $toggler .= '<line x-show="show" x1="1" y1="1" x2="23" y2="23" style="display: none;"></line>';
                $toggler .= '</svg>';
            $toggler .= '</button>';
        }

        $html .= '<div class="flex w-full flex-col">';

            // Label
            $html .= "<label for=\"{$this->factory->attributes->get('id')}\" class=\"block truncate w-full mb-1\">";
                $html .= "<span class=\"inline-block\">{$this->label()}</span>";
                if ($this->factory->attributes->has('required')) {
                    $html .= '<span class="inline-block ml-1 text-red-600 animate-pulse">*</span>';
                }
            $html .= '</label>';

            // Element
            $html .= '<div class="flex flex-auto items-stretch">';
                $html .= '<div class="flex-shrink flex-grow flex-auto w-px">';
                    $html .= "<div{$directive} class=\"relative\">";
                        $html .= ':current-element';
                        $html .= $toggler;
                    $html .= '</div>';
                $html .= '</div>';
            $html .= '</div>';

        $html .= '</div>';

        return $html;
    }
}
