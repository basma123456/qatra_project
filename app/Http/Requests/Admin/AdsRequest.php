<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use function App\Helpers\slug2;

class AdsRequest extends FormRequest
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



    public function attributes()
    {
        $attr = [];
        $attr += ['title' => 'Title'];
        $attr += ['slug' => 'Slug'];
        $attr += ['description' => 'Description'];
        $attr += ['content' => 'Content'];
        $attr += ['meta_title' => 'Meta title'];
        $attr += ['meta_description' => 'Meta description'];
        $attr += ['meta_key' => 'Meta key'];
        $attr += ['image' => 'Image'];

        $attr += ['bg_color' => 'Back Ground Color'];
        $attr += ['link' => 'Link'];

        return $attr;

    }

    public function rules()
    {
        $req = [];

        $req += ['title' => 'required'];
        $req += ['slug' => 'required'];
        $req += ['description' => 'string|nullable'];
//        $req += ['content' => 'string|nullable'];
        $req += ['meta_title' => 'nullable'];
        $req += ['meta_description' => 'nullable'];
        $req += ['meta_key' => 'nullable'];

        $req += ['image' => 'nullable|image'];
        $req += ['logo' => 'nullable|image'];


        $req += ['status' => 'nullable'];
        $req += ['feature' => 'nullable'];
        $req += ['show_logo_status' => 'nullable'];


        $req += ['bg_color' => 'nullable|string'];
        $req += ['link' => 'nullable|string|max:255'];


        return $req;
    }


    public function getSanitized()
    {
        $data = $this->validated();
        $data['slug'] = slug2($data['slug']);
        $data['status'] = isset($data['status']) ? true : false;
        $data['feature'] = isset($data['feature']) ? true : false;
        $data['show_logo_status'] = isset($data['show_logo_status']) ? true : false;



        if (request()->isMethod('PUT')) {
            $data['updated_by'] = @auth()->user()->id;
        } else {
            $data['created_by'] = @auth()->user()->id;
        }
        return $data;
    }
}
