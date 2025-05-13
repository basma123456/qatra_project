<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
        $arr = [];

        $arr += ['name' => 'required|string|min:3|max:190'];
        $arr += ['description' => 'nullable|string|min:3'];
        $arr += ['status' => 'nullable|boolean'];
        $arr += ['sort' => 'nullable|integer'];
        $arr += ['feature' => 'nullable|boolean'];
        $arr += ['gender' => 'nullable|boolean'];
        $arr += ['rate' => 'nullable|integer'];


        if (request()->method() == "post") {
            $arr += ['image' => 'required|image|mimes:jpeg,jpg,png|max:2048'];
        } else {
            $arr += ['image' => 'nullable|image|mimes:jpeg,jpg,png|max:2048'];
        }
        return $arr;
    }


    public function getSanitized()
    {

        $data = $this->validated();

        $data['status'] = isset($data['status']) ? true : false;
        $data['feature'] = isset($data['feature']) ? true : false;
        if (request()->isMethod('PUT')) {
            $data['updated_by'] = @auth()->user()->id;
        } else {
            $data['created_by'] = @auth()->user()->id;
        }
        return $data;
    }


}
