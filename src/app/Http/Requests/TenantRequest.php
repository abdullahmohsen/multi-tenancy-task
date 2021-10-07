<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\IsDomainExists;

class TenantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
      return [
        'name'                  => 'required',
        'email'                 => 'required|email',
        'password'              => 'required|confirmed|min:8',
        'password_confirmation' => 'required',
        'database'              => 'required|unique:tenants,database',
        'domain'                => ['required', new IsDomainExists()]
      ];
    }

}
