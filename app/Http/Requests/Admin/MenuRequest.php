<?php

namespace App\Http\Requests\Admin;
use Locale;
use App\Models\Menue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
{
  
    public function authorize()
    {
        return true;
    }

    
    public function rules()
    {
        $req = [];
        $req += ['title' =>'required'];
        $req += ['slug' =>'required'];
        $req += ['parent_id' =>'nullable'];
        $req += ['sort' =>'nullable'];
        $req += ['type' =>'nullable'];
        $req += ['url' =>'nullable'];
        $req += ['position' =>'nullable'];
        $req += ['dynamic_table' =>'nullable'];
        $req += ['dynamic_url' =>'nullable'];
        $req += ['level' =>'nullable'];
        $req += ['status' =>'nullable'];
        $req += ['updated_by' =>'nullable'];
        $req += ['created_by' =>'nullable'];

        
        return $req;

    }

    public function getSanitized(){
        $data = $this->validated();

        if( $data['parent_id'] == 0 ){$date['parent_id']  = Null;}

        $data['status'] = isset($data['status']) ? true :false;
        $data['level'] =  $this->updateLevel(@Menue::find($data['parent_id']));
        // $data['position'] = MenuPositionEnum::MAIN;

        if(request()->isMethod('PUT')){
            $data['updated_by']  = @Auth::user()->id;

        }else{
            $data['created_by']  = @Auth::user()->id;
        }
        return $data;
    }


    public function updateLevel($parent)
    {
        if ($parent == null) {
            return 1;
        } else {
            return $parent->level + 1;
        }
    }

}
