<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
          'name'           => 'required',
          'description'    => 'required',
          'priority'       => 'required|in:urgent,high,normal,low',
          'employees_id'   => 'required|array|min:1|exists:employees,id',
          'employees_id.*' => 'required|string|distinct|min:1'
        ];
    }
}
