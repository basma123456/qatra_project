<?php

namespace App\Http\Livewire\Admin;

use App\Models\Bank;
use App\Models\PaymentMethod;
use Livewire\Component;
use Livewire\WithFileUploads;

class PaymentMethodUpdate extends Component
{
    use WithFileUploads;


    public $payment_method;
    public $title;
    public $payment_key;
    public $content;
    public $image;
    public $minimum_price;
    public $available_in_cart = 1; // Default checked
    public $status = 1;           // Default checked

    public $success = false;

    //New fields
    public $name_ar = [];
    public $name_en = [];
    public $account_name = [];
    public $account_no = [];
    public $iban = [];
    public $bank_image = [];

    protected $rules = [
        'title' => 'required|string|max:255',
        'payment_key' => 'required|string|max:255',
        'content' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'minimum_price' => 'required|numeric',

        'name_ar' => 'nullable|array',
        'name_en' => 'nullable|array',
        'account_name' => 'nullable|array',
        'account_no' => 'nullable|array',
        'iban' => 'nullable|array',
        'bank_image' => 'nullable|array',

    ];


    public function addRow()
    {
        $this->name_ar[] = ''; // Add an empty element to the array
        $this->name_en[] = '';
        $this->account_name[] = '';
        $this->account_no[] = '';
        $this->iban[] = '';
        $this->bank_image[] = '';

    }

    public function removeRow($index)
    {
        unset($this->name_ar[$index]);
        unset($this->name_en[$index]);
        unset($this->account_name[$index]);
        unset($this->account_no[$index]);
        unset($this->iban[$index]);
        unset($this->bank_image[$index]);

        $this->name_ar = array_values($this->name_ar); // Reset array keys after removing
        $this->name_en = array_values($this->name_en); // Reset array keys after removing
        $this->account_name = array_values($this->account_name); // Reset array keys after removing
        $this->account_no = array_values($this->account_no); // Reset array keys after removing
        $this->iban = array_values($this->iban); // Reset array keys after removing
        $this->bank_image = array_values($this->bank_image); // Reset array keys after removing


    }


    public function update()
    {
        $this->validate();
        $data = [
            'title' => $this->title,
            'payment_key' => $this->payment_key,
            'content' => $this->content,
            'minimum_price' => $this->minimum_price,
            'available_in_cart' => $this->available_in_cart ? 1 : 0, // Convert checkbox to 0 or 1
            'status' => $this->status ? 1 : 0,                   // Convert checkbox to 0 or 1
        ];
        if ($this->image) {
            $imageName = time() . 'image' . '.' . $this->image->extension();
            $data['image'] = "attachments" . "/" . $this->image->storeAs('payment_methods', $imageName, 'attachment');
        }
        $operation = $this->payment_method->update($data);

        if ($this->name_ar && !empty($this->name_ar)) {
            $this->rules = [
                'title' => 'required|string|max:255',
                'payment_key' => 'required|string|max:255',
                'content' => 'nullable|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'minimum_price' => 'required|numeric',

                'name_ar.*' => 'required|string',
                'name_en.*' => 'nullable|string',
                'account_name.*' => 'required|string',
                'account_no.*' => 'required|string',
                'iban.*' => 'required|string',
                'bank_image.*' => 'required|image',

            ];
            $this->validate();
        }

        foreach ($this->name_ar as $key => $val) {
            $data['name_ar'][$key] = 'required|string';
            $data['name_en'][$key] = 'nullable|string';
            $data['account_name'][$key] = 'required|string';
            $data['account_no'][$key] = 'required|string';
            $data['iban'] [$key]= 'required|string';
            $data['bank_image'][$key] = 'required|image|mimes:jpeg,png,jpg,gif|max:2048';

            /***************************/
            if ($this->bank_image[$key]) {
                $imageName = time() . 'image' . '.' . $this->bank_image[$key]->extension();
                $bank = "attachments" . "/" . $this->bank_image[$key]->storeAs('banks', $imageName, 'attachment');
            }
            /****************************/
            Bank::create([
                'name_ar' => $this->name_ar[$key],
                'name_en' => $this->name_en[$key],
                'account_name' => $this->account_name[$key],
                'account_no' => $this->account_no[$key],
                'iban' => $this->iban[$key],
                'payment_method_id' => $this->payment_method->id,
                'image' => @$bank,
            ]);
        }
        session()->flash('success', "لقد ادخلت هذة الصفحة بنجاح");
        if ($operation == true) {
            $this->success = true;
        }
        $this->payment_method->refresh();

        return back();
    }


    public function deleteThis($bankValId)
    {
      $bankThis =  Bank::find($bankValId);
     if($bankThis) {
         $bankThis->delete();
         $this->payment_method->refresh();
         toastr()->error('لقد قمت بالغاء هذا الحساب بنجاح');
     }else{
         toastr()->warning( "حدث خطأ ما ....");
     }
    }

    public function mount($payment_method)
    {
        $this->payment_method = $payment_method;
        $this->title = $this->payment_method->title;
        $this->payment_key = $this->payment_method->payment_key;
        $this->content = $this->payment_method->content;
//        $this->image = $this->payment_method->image;
        $this->minimum_price = $this->payment_method->minimum_price;
        $this->available_in_cart = $this->payment_method->available_in_cart;
        $this->status = $this->payment_method->status;
    }

    public function render()
    {
        return view('livewire.admin.payment-method-update');
    }
}
