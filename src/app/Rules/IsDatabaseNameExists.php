<?php

namespace App\Rules;

use App\Models\Tenant;
use Illuminate\Contracts\Validation\Rule;

class IsDatabaseNameExists implements Rule
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
      $databaseName = str_replace(' ', '-', $value);
      $isDatabaseExist = Tenant::where('database', $databaseName)->first();
      if ($isDatabaseExist) {
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
      return 'The database has already been taken.';
    }
}
