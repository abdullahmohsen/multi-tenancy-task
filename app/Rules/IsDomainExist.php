<?php

namespace App\Rules;

use App\Models\Tenant;
use Illuminate\Contracts\Validation\Rule;

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
      $domain = $value . '.' . request()->getHost();
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
