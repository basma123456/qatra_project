<?php

namespace App\Http\Livewire\Client;

use App\Models\District;
use App\Models\Mosque;
use App\Models\Product;
use Jackiedo\Cart\Facades\Cart;
use Livewire\Component;

class ProductMainItem extends Component
{


    public $qty = 1;
    public $mosque_search = '';
    public $mosque_search_table_array = [];
    public $searched_result_mosque;
    public $btn_success;
    
    public $priceQty;
    public array $allCarts = [];
    public $cart;
    public $product;
    public $hash;

    public $mosques;
    public $cities;
    public $districts;
    public $city_id = 0;
    public $district_id = -2;
    public $mosque_id = 0;

    public $selectedOptionMosque;

    public $sender_name;
    public $recipient_name;
    public $recipient_mobile;

    public $has_gift = 0, $hasDeliveryPerson = 0, $delivery_name = "", $delivery_mobile = "";
    public $certain_person;
    public $success;

    public $favoriteMosque = 0;



    protected function rules(){
        $rule = [
            'mosque_id' => 'required|integer|min:1',
            'district_id' => 'required|integer|min:1',
            'city_id' => 'required|integer|min:1',
            'qty' => 'required|integer|min:1',
        ];

        if($this->has_gift){
            $rule['sender_name'] = 'required|string|min:3';
            $rule['recipient_name'] ='required|string|min:3';
            $rule['recipient_mobile'] ='required';
        }
        
        if($this->hasDeliveryPerson){
            $rule['delivery_name'] = 'required|string|min:3';
            $rule['delivery_mobile'] = 'required';
        }
        return $rule;
    }

    // protected $rules = [
    //     'qty' => 'required|integer|min:1',
    //     'delivery_name' => 'nullable|string',
    //     'delivery_mobile' => 'nullable|string',
    // ];

    protected $messages = [
        'mosque_id.min' => 'يجب ان تختار مسجد من  القائمة اولا .',
        'district_id.min' => 'يجب ان تختار منطقة  بالقائمة اولا .',
        'city_id.min' => "يجب ان تختار مدينة من القائمة اولا .",
        'qty.min' => "يجب ان تختار كمية و تكون اعلي من الصفر . ",
    ];


    public function addToCart()
    {
        $this->qty++;
        return;
    }

    public function minusFromCart()
    {
        $this->qty--;
        if ($this->qty < 0) {
            $this->qty = 0;
            toastr()->error('  لقد وصلت لصفر !');
        }
        return;
    }


    public function redirectToMosquesProducts($selectedOptionMosque)
    {
        $this->selectedOptionMosque = $selectedOptionMosque;
        if (!is_numeric($this->selectedOptionMosque) || !Mosque::find($this->selectedOptionMosque)) {
            $this->emit('redirect', ['url' => '/#ProductSwiper']);
            return;
        }
        $this->emit('redirect', ['url' => url('/?mosque=' . $this->selectedOptionMosque . "#ProductSwiper")]);
    }


    public function showGiftSection($val)
    {
        return $this->has_gift = $val;

    }
    public function Updatedelivery($val)
    {
        return $this->hasDeliveryPerson = $val;

    }

    public function updateQty()
    {
         $this->validate(); // Validate the input fields

        $product = $this->product;
        if ($this->qty == 0 && !isset($this->hash['quantity'])) {

            $cart = Cart::name('shopping')->useForCommercial()->addItem([
                'id' => $product->id,
                'title' => $product->name_ar,
                'quantity' => 1,
                'price' => $product->price,
                'taxable' => $product->taxable ? true : false,
                'options' => [
                    'sender_name' => $this->sender_name, // Add any additional data
                    'recipient_name' => $this->recipient_name,
                    'recipient_mobile' => $this->recipient_mobile,
                    'total_price' => $product->price,
                    'city_id' => $this->city_id,
                    'district_id' => $this->district_id,
                    'mosque_id' => $this->mosque_id,
                    'delivery_name' => $this->delivery_name,
                    'delivery_mobile' => $this->delivery_mobile,
                    'delivery_type_id' => $this->delivery_mobile != "" ? 2 : 1,
                    'favoriteMosque' => $this->favoriteMosque,
                ],

            ]);
            $this->qty = 1;
            $this->priceQty = $product->price;
            $this->success = true;

        } elseif (isset($this->hash['options']) &&

            ((isset($this->hash['quantity']) && $this->qty !== 0 && (!isset($this->hash['options']['sender_name']) && isset($this->sender_name))
                    || (isset($this->sender_name) && ($this->sender_name != $this->hash['options']['sender_name'])))
                || (($this->hash['options']['district_id'] !== $this->district_id) || ($this->hash['options']['mosque_id'] !== $this->mosque_id)))
        ) {

            $cookieId = uniqid(); // Generate a unique identifier for the cookie
            $cart = Cart::name('shopping')->useForCommercial()->addItem([
                'id' => $product->id,
                'title' => $product->name_ar,
                'quantity' => $this->qty,
                'price' => $product->price,
                'total_price' => $product->price,
                'taxable' => $product->taxable ? true : false,
                'options' => [
                    'cookie_id' => $cookieId, // Include the new cookie ID
                    'sender_name' => $this->sender_name, // Add any additional data
                    'recipient_name' => $this->recipient_name,
                    'recipient_mobile' => $this->recipient_mobile,
                    'city_id' => $this->city_id,
                    'district_id' => $this->district_id,
                    'mosque_id' => $this->mosque_id,
                    'delivery_name' => $this->delivery_name,
                    'delivery_mobile' => $this->delivery_mobile,
                    'delivery_type_id' => $this->delivery_mobile != "" ? 2 : 1,
                    'favoriteMosque' => $this->favoriteMosque,
                ],

            ]);
            $this->qty = 1;
            $this->total_price = $product->price;
            $this->sender_name = null; //here
            $this->recipient_name;
            $this->recipient_mobile;
            $this->success = true;
//            $this->has_gift = 0;

        } elseif ((isset($this->hash['options']) && ($this->hash['options']['district_id'] === $this->district_id) && ($this->hash['options']['mosque_id'] === $this->mosque_id)) &&
            (isset($this->hash['quantity']) && $this->qty !== 0 &&
                (((
                        (!isset($this->hash['options']['sender_name']) || $this->hash['options']['sender_name'] == '')) && ($this->sender_name == null || $this->sender_name == ''))
                    ||
                    (isset($this->hash['options']['sender_name']) && ($this->hash['options']['sender_name'] === $this->sender_name))
                ))) {

            $product = $this->product;
            $product_id = $this->product->id;
            $newQty = $this->hash['quantity'] + $this->qty;
            $newTotal = $this->hash['total_price'] + ($product->price * $this->qty);
            $cartItem = Cart::updateItem($this->hash['hash'], [
                'quantity' => $newQty,
                'total_price' => $newTotal,
                'options' => [
                    'sender_name' => $this->sender_name, // Add any additional data
                    'recipient_name' => $this->recipient_name,
                    'recipient_mobile' => $this->recipient_mobile,
                    'city_id' => $this->city_id,
                    'district_id' => $this->district_id,
                    'mosque_id' => $this->mosque_id,
                    'delivery_name' => $this->delivery_name,
                    'delivery_mobile' => $this->delivery_mobile,
                    'delivery_type_id' => $this->delivery_mobile != "" ? 2 : 1,
                    'favoriteMosque' => $this->favoriteMosque,

                ],

            ]);
            $this->qty = 0;
            $this->total_price = $product->price;
            $this->success = true;

        } elseif ($this->qty == 0) {
            $this->success = false;
            toastr()->error("من فضلك ادخل الكمية اولا");

            return;

        } elseif ($this->mosque_id == 0) {
            $this->success = false;
            toastr()->error(" اختر المسجد اولا");

            return;

        } elseif ($this->district_id == -2) {
            $this->success = false;
            toastr()->error(" اختر  المنطقة اولا");

            return;

        } elseif ($this->city_id == 0) {
            $this->success = false;
            toastr()->error(" اختر  المدينة اولا");

            return;

        } else {
            $cart = Cart::name('shopping')->useForCommercial()->addItem([
                'id' => $product->id,
                'title' => $product->name_ar,
                'quantity' => $this->qty,
                'price' => $product->price,
                'total_price' => $product->price,
                'taxable' => $product->taxable ? true : false,
                'options' => [
                    'sender_name' => $this->sender_name, // Add any additional data
                    'recipient_name' => $this->recipient_name,
                    'recipient_mobile' => $this->recipient_mobile,
                    'city_id' => $this->city_id,
                    'district_id' => $this->district_id,
                    'mosque_id' => $this->mosque_id,
                    'delivery_name' => $this->delivery_name,
                    'delivery_mobile' => $this->delivery_mobile,
                    'delivery_type_id' => $this->delivery_mobile != "" ? 2 : 1,
                    'favoriteMosque' => $this->favoriteMosque,

                ],
            ]);
            $this->qty = 0;
            $this->total_price = $product->price;
            $this->success = true;
        }

        $this->emit('cart_updated');
        $this->emptyData();
        toastr()->success('تم الاضافة الي السلة بنجاح!');
        return 1;
    }


    public function changeMosques()
    {
        if ($this->district_id > 0) {
            $this->mosques = Mosque::where('district_id', $this->district_id)->get();
        } else {
            $this->mosques = Mosque::where(['city_id' => $this->city_id, 'high_need' => 1])->get();
        }

    }

    public function changeDistricts()
    {
        $this->districts = District::where('city_id', $this->city_id)->get();
    }


    public function searchMosque()
    {
        if ($this->mosque_search != '') {
            $this->mosque_search_table_array = Mosque::where('name_ar', "like", "%" . $this->mosque_search . "%")->get();

        } else {
            $this->mosque_search_table_array = [];
            $this->searched_result_mosque = '';
            $this->district_id = 0;
            $this->city_id = 0;
            $this->mosque_id = 0;
            $this->changeMosques();
            $this->changeDistricts();
        }
    }


    public function getThisMosque($item)
    {
        if ($item) {
            $this->searched_result_mosque = $item;
            $this->district_id = $item['district_id'];
            $this->city_id = $item['city_id'];
            $this->mosque_id = $item['id'];
            $this->changeMosques();
            $this->changeDistricts();
            $this->btn_success = $item['id'];
        } else {
            toastr()->error('لا توجد نتائج لهذا البحث');
            $this->btn_success = 0;
        }
    }

    public function emptyData(){
        $this->sender_name = '';
        $this->recipient_name = '';
        $this->recipient_mobile = '';
        $this->delivery_name = '';
        $this->delivery_mobile = '';
        $this->has_gift = 0;
        $this->hasDeliveryPerson = 0;
        $this->qty = 1;
        $this->success = false;
        $this->mosque_search = '';
        $this->mosque_search_table_array = [];
        $this->searched_result_mosque = '';
        $this->district_id = 0;
        $this->city_id = 0;
        $this->mosque_id = 0;
        
    }
    
    public function checkout(){
        $res = $this->updateQty();
        if($res)return redirect()->route('client.cart.index');

    }

    public function mount($product, $mosques, $districts, $cities )
    {
        $this->product = $product;
        $this->mosques = $mosques;
        $this->cities = $cities;
        $this->districts = $districts;
        $this->city_id = 0;
        $this->district_id = -2;
        $this->mosque_id = 0;
        $this->qty = 1;
        $this->success = false;
        $this->sender_name = '';
        $this->recipient_name = '';
        $this->recipient_mobile = '';
        $this->delivery_name = '';
        $this->delivery_mobile = '';
        $this->has_gift = 0;
        $this->hasDeliveryPerson = 0;
    }

    public function render()
    {
        $this->cart = Cart::getDetails()->items;
        foreach ($this->cart as $key => $val) {
            if ($val->id === $this->product->id && $this->sender_name === $val->options->sender_name && $this->district_id === $val->options->district_id && $this->mosque_id === $val->options->mosque_id) {
                $this->hash = $val;
                break;
            }
        }
        return view('livewire.client.product-main-item');
    }


}
