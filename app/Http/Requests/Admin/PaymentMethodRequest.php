<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PaymentMethodRequest extends FormRequest
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


    public function attributes()
    {
        $attr = [];
        $attr += ['title' => 'Title'];
        $attr += ['content' => 'Content'];
        $attr += ['minimum_price' => 'Minimum Price'];
        $attr += ['payment_key' => 'Payment Key'];
        $attr += ['image' => 'Image'];
        $attr += ['status' => 'Status'];
        $attr += ['available_in_cart' => 'Available In Cart'];


        return $attr;

    }


    public function rules()
    {
        $req = [];

        $req += ['title' => 'string|min:2|max:180|required'];
        $req += ['content' => 'string|nullable'];
        $req += ['minimum_price' => 'numeric|min:0|max:999999999999.99'];
        $req += ['payment_key' => 'string|min:2|max:180|nullable'];
        $req += ['image' => 'image|nullable'];
        $req += ['status' => 'integer|between:0,1|nullable'];
        $req += ['available_in_cart' => 'integer|between:0,1|nullable'];


        return $req;
    }


    public function getSanitized()
    {
        $data = $this->validated();
        $data['status'] = isset($data['status']) ? true : false;
        $data['available_in_cart'] = isset($data['available_in_cart']) ? true : false;

        if (request()->isMethod('PUT')) {
            $data['updated_by'] = @auth()->guard('admin')->user()->id ?? 0;
        } else {
            $data['created_by'] = @auth()->guard('admin')->user()->id ?? 0;
        }
        return $data;
    }

}
