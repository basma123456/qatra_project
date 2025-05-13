<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use function App\Helpers\slug2;

class CategoryRequest extends FormRequest
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


    public function rules()
    {
        $arr = [];

        $arr += ['name_ar' => 'required|string|min:3|max:190'];
        $arr += ['description' => 'nullable|string|min:3'];
        $arr += ['status' => 'nullable|boolean'];
        $arr += ['sort' => 'nullable|integer'];
        $arr += ['feature' => 'nullable|boolean'];
        $arr += ['slug' => 'required|string|min:3|max:190'];
        $arr += ['meta_key' => 'nullable|string|min:3|max:190'];
        $arr += ['meta_description' => 'nullable|string|min:3'];
        $arr += ['meta_title' => 'nullable|string|min:3|max:190'];

        return $arr;
    }

    public function getSanitized()
    {

        $data = $this->validated();
        /********************deleted part*************/
        $data['name_en'] = '';
        /********************deleted part*************/


        $data['status'] = isset($data['status']) ? true : false;
        $data['feature'] = isset($data['feature']) ? true : false;




        $data['slug'] = slug2($data['slug'] ?? '') ?? null;
        if (request()->isMethod('PUT')) {
            $data['updated_by'] = @auth()->user()->id;
        } else {
            $data['created_by'] = @auth()->user()->id;
        }
        return $data;
    }

}
