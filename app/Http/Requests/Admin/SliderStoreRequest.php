<?php

namespace App\Http\Requests\Admin;
use Locale;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use function App\Helpers\slug2;
use function Symfony\Component\String\Slugger\slug;

class SliderStoreRequest extends FormRequest
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

    public function attributes(){
        $attr = [];

            $attr += [  'title' => 'Title '  ];
            $attr += [ 'slug' => 'Slug '  ];
            $attr += [  'description' => 'Description '];

        $attr +=['image' =>'Image'];
        $attr += ['sort' =>'Sort'];
        $attr += ['status' =>'Status'];
        return $attr;
    }

    public function rules()
    {

        $req = [];

            $req += [  'title' => 'nullable'];
            $req += [  'slug' => 'nullable'];
            $req += [  'description' => 'nullable'];

        $this->isMethod('POST') ?
            $req += ['image' =>'required|image' ]
            :
            $req += ['image' =>'nullable|image' ]
        ;

        $req += ['sort' =>'nullable'];
        $req += ['url' =>'nullable'];
        $req += ['status' =>'nullable'];
        $req += ['updated_by' =>'nullable'];
        $req += ['created_by' =>'nullable'];


        return $req;
    }

    public function getSanitized(){

        $data = $this->validated();
        $data['status'] = isset($data['status']) ? true : false;

            $data['slug'] = slug2($data['title']);

        if(!isset($data['url'])) $data['url'] = "javascript:void(0)";
        $data['status'] = isset($data['status']) ? true : false;

        if (request()->isMethod('PUT')){
            $data['updated_by']  = @Auth::user()->id;
        }
        else{
            $data['created_by']  = @Auth::user()->id;
        }
        return $data;
    }



}
