<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Spatie\Multitenancy\Models\Tenant;

class IsDomainExist implements Rule
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
      $subDomain = explode(':', $_SERVER['HTTP_HOST'], 2);
      $domain = $value.'.'.$subDomain[0];
      $isDomainExist = Tenant::where('domain', $domain)->first();
      if ($isDomainExist) {
        return false;
      }
      return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The domain has already been taken.';
    }
}
