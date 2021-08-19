<?php

namespace Aodamuz\Form;

use Illuminate\Support\Str;

class Generator
{
    /**
     * Generate an ID, once, for a given form element.
     *
     * @param  string|null  $name
     *
     * @return string
     */
    public static function id(?string $name) : string
    {
        $name = !$name ? Str::random(6) : clean_string($name);

        return "element-{$name}";
    }

    /**
     * Generate a label for the given field.
     *
     * @param  null|string  $name
     * @param  string  $append
     * @param  bool  $withTranslator
     *
     * @return mixed
     */
    public static function label(?string $name, ?string $append = null, bool $withTranslator = true) : ?string
    {
        if (!empty($name)) {
            if (Str::contains($name, '_confirmation')) {
                $name = 'Confirm ' . str_replace(
                    'confirmation', '',
                    implode(' ', explode('_', $name))
                );
            }

            $name = ucwords(clean_string($name, ' '));

            return ($withTranslator ? __($name) : $name) . $append;
        }

        return null;
    }

    /**
     * Get the default "autocomplete" attribute based on the name attribute.
     *
     * @param  string|null  $name
     *
     * @return null|string
     */
    public static function autocomplete(?string $name) : ?string
    {
        if (!empty($name)) {
            switch ($name) {
                case 'password':
                case 'current_password':
                    return 'current-password';

                case 'password_confirmation':
                    return 'new-password';

                case 'first_name':
                    return 'given-name';

                case 'last_name':
                    return 'family-name';

                case 'email':
                    return 'email';
            }
        }

        /**
         * Completely disable autocomplete.
         *
         * @link https://developer.mozilla.org/en-US/docs/Web/Security/Securing_your_site/Turning_off_form_autocompletion
         */
        return 'undefined';
    }

    /**
     * Get the default "inputmode" attribute based on the name attribute.
     *
     * @param  string|null  $name
     *
     * @return null|string
     */
    public static function inputmode(?string $name) : ?string
    {
        if (!empty($name)) {
            if (Str::contains($name, ['contact', 'phone'])) {
                return 'tel';
            }

            if (Str::contains($name, 'search')) {
                return 'search';
            }

            if (Str::contains($name, ['url', 'link', 'social_network'])) {
                return 'url';
            }

            if (Str::contains($name, 'email')) {
                return 'email';
            }

            if ($name === 'code') {
                return 'numeric';
            }
        }

        return null;
    }
}
