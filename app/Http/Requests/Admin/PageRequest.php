<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use function App\Helpers\slug2;

class PageRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function attributes()
    {
        $attr = [];
        $attr += ['title' => 'Title'];
        $attr += ['slug' => 'Slug'];
        $attr += ['content' => 'Content'];
        $attr += ['meta_title' => 'Meta title'];
        $attr += ['meta_description' => 'Meta description'];
        $attr += ['meta_key' => 'Meta key'];
        $attr += ['image' => 'Image'];
        return $attr;

    }

    public function rules()
    {
        $req = [];

        $req += ['title' => 'required'];
        $req += ['slug' => 'required'];
        $req += ['content' => 'nullable'];
        $req += ['meta_title' => 'nullable'];
        $req += ['meta_description' => 'nullable'];
        $req += ['meta_key' => 'nullable'];

        $req += ['image' => 'nullable|image'];
        $req += ['status' => 'nullable'];
        return $req;
    }


    public function getSanitized()
    {
        $data = $this->validated();
        $data['slug'] = slug2($data['slug']);
        $data['status'] = isset($data['status']) ? true : false;

        if (request()->isMethod('PUT')) {
            $data['updated_by'] = @auth()->user()->id;
        } else {
            $data['created_by'] = @auth()->user()->id;
        }
        return $data;
    }
}
