<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DancerSaveRequest extends FormRequest
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
        //'num','name1','name2','dancer_category_id'
        return [
            'num' => 'required|numeric',
            'name' => 'required',
            'dancer_category_id' => 'required',
        ];
    }
}
