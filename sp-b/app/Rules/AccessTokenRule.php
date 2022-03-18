<?php

namespace App\Rules;

use App\Models\AccessTokenModel;
use Illuminate\Contracts\Validation\Rule;

class AccessTokenRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return AccessTokenModel::isTokenValid($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':attribute é inválido ou expirou.';
    }
}
