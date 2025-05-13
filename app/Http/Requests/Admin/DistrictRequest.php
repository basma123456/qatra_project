<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DistrictRequest extends FormRequest
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
            'name_ar'  => 'required|string|min:3',
            'name_en'  => 'required|string|min:3',
            'city_id'  => 'required',
            'status'  => 'nullable',
        ];
    }

    public function getSanitized()
    {
        $data = $this->validated();
        $data['status'] = isset($data['status']) ? true : false;
        return $data;
    }
}
