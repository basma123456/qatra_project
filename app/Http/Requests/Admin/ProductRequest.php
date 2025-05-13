<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use function App\Helpers\slug2;

class ProductRequest extends FormRequest
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

        $arr += ['name_ar' => 'required|string|min:3|max:190'];
        $arr += ['description_ar' => 'nullable|string|min:3'];
        $arr += ['price' => 'required|numeric|min:0|max:99999999999'];
        $arr += ['category_id' => 'required|exists:categories,id'];
        $arr += ['status' => 'nullable|boolean'];
        $arr += ['deliverable' => 'nullable|boolean'];
        $arr += ['taxable' => 'nullable|boolean'];
        $arr += ['no_carton' => 'nullable|boolean'];
        $arr += ['sort' => 'nullable|integer'];
        $arr += ['feature' => 'nullable|boolean'];
        $arr += ['mosque_id' => 'nullable|array'];
        $arr += ['mosque_id.*' => 'nullable|integer|exists:mosques,id'];

        $arr += ['slug' => 'required|string|min:3|max:190'];
        $arr += ['meta_key' => 'nullable|string|min:3|max:190'];
        $arr += ['meta_description' => 'nullable|string|min:3'];
        $arr += ['meta_title' => 'nullable|string|min:3|max:190'];
        $arr +=['product_id' => 'nullable|integer'];

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
        /********************deleted part*************/
        $data['name_en'] = '';
        /********************deleted part*************/


        $data['status'] = isset($data['status']) ? true : false;
        $data['feature'] = isset($data['feature']) ? true : false;
        $data['deliverable'] = isset($data['deliverable']) ? true : false;
        $data['taxable'] = isset($data['taxable']) ? true : false;
        $data['no_carton'] = isset($data['no_carton']) ? true : false;

        $data['slug'] = slug2($data['slug'] ?? '') ?? null;
        if (request()->isMethod('PUT')) {
            $data['updated_by'] = @auth()->user()->id;
        } else {
            $data['created_by'] = @auth()->user()->id;
        }
        return $data;
    }


}
