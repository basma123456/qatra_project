<?php

namespace App\Http\Livewire\Client;

use App\Models\District;
use App\Models\Mosque;
use App\Models\Product;
use Jackiedo\Cart\Facades\Cart;
use Livewire\Component;

class ProductTable extends Component
{


    public $qty;
    public $priceQty;
    public $cart;
    public $product;
    public $hash;
    public $cart_item;
    public $checkFound = 1;

    public $mosques;
    public $districts;
    public $district_id;
    public $mosque_id;

    public $cities;
    public $city_id = 0;
    public $errors = [];


    protected $rules = [
        'mosque_id' => 'required|integer|min:1',
        'district_id' => 'required|integer|min:-1',
        'city_id' => 'required|integer|min:1',
        'qty' => 'required|integer|min:1',
    ];

    protected $messages = [
        'mosque_id.min' => 'يجب ان تختار مسجد من  القائمة اولا .',
        'district_id.min' => 'يجب ان تختار منطقة  بالقائمة اولا .',
        'city_id.min' =>  "يجب ان تختار مدينة من القائمة اولا .",
        'qty.min' => "يجب ان تختار كمية و تكون اعلي من الصفر . ",
    ];


    public function addToCart()
    {
        $this->qty++;
        $this->updateInfoArea();
        $this->emit('cart_updated');

    }
    public function changeQty()
    {
        $this->priceQty = ((int)$this->qty * $this->product->price);
        $this->updateInfoArea();
        $this->emit('cart_updated');
    }

    public function changeToZero()
    {
        if (isset($this->hash['hash']) && isset($this->hash['quantity']) && $this->qty == 0) {
            $this->qty = 0;
            $this->priceQty = $this->product->price;
            if (Cart::hasItem($this->hash['hash'])) {
                Cart::removeItem($this->hash['hash'], true);
            }
            toastr()->info('تم الازالة من السلة بنجاح!');
            $this->updateInfoArea();
            $this->emit('cart_updated');
        }
    }

    public function updateQty()
    {
        $product = $this->product;
        $product_id = $this->product->id;
        if (isset($this->hash['hash']) && isset($this->hash['quantity']) && $this->qty == 0) {
            $this->qty = 0;
            $this->priceQty = $product->price;
            if (Cart::hasItem($this->hash['hash'])) {
                Cart::removeItem($this->hash['hash'], true);
            }
            toastr()->info('تم الازالة من السلة بنجاح!');
            $this->emit('cart_updated');

        } elseif (isset($this->hash['hash']) && isset($this->hash['quantity']) && $this->qty > 0) {

            $newQty = $this->qty;
            $newTotal = $this->qty * $product->price;
            $cartItem = Cart::updateItem($this->hash['hash'], [
                'quantity' => $newQty,
                'total_price' => $newTotal,
                'options' => [
                    'district_id' => $this->district_id ?? 0,
                    'mosque_id' => $this->mosque_id ?? 0,
                    'city_id' => $this->city_id ?? 0,

                ]
            ]);
            $this->qty = $newQty;
            $this->priceQty = $newTotal;

            toastr()->info('تم تعديل   السلة بنجاح!');
            $this->emit('cart_updated');

        } elseif ($this->qty < 1) {
            toastr()->warning("لقد وصلت للعدد صفر");
            $this->emit('cart_updated');


        }elseif ($this->qty == 0) {
            $this->emit('hideLoadingMessage');

            toastr()->error("من فضلك ادخل الكمية اولا");

            return;

        } elseif ($this->mosque_id == 0) {
            $this->emit('hideLoadingMessage');

            toastr()->error(" اختر المسجد اولا");

            return;

        } elseif ($this->district_id <-1) {
            $this->emit('hideLoadingMessage');

            toastr()->error(" اختر  المنطقة اولا");

            return;

        }elseif ($this->city_id == 0) {
            $this->emit('hideLoadingMessage');

            toastr()->error(" اختر  المدينة اولا");

            return;

        }
    }

    public function minusFromCart()
    {
        if($this->qty > 1) {
            $this->qty--;
        }

        if ($this->qty < 1) {
            $this->qty = 1;
        }
        $this->updateInfoArea();
        $this->emit('cart_updated');

    }

    public function deleteCart()
    {
        if (isset($this->hash['hash']) && isset($this->hash['quantity']) ) {
            $this->qty = 0;
            $this->priceQty = $this->product->price;
            if (Cart::hasItem($this->hash['hash'])) {
                Cart::removeItem($this->hash['hash'], true);
            }
            toastr()->info('تم الازالة من السلة بنجاح!');
            $this->emit('cart_updated');
        }

    }

    public function changeMosques()
    {
        if($this->district_id > 0) {
            $this->mosques = Mosque::where('district_id', $this->district_id)->get();
        }else{
            $this->mosques = Mosque::where(['city_id'=> $this->city_id , 'high_need' => 1])->get();
        }
        $this->updateInfoArea();

    }

    public function changeDistricts()
    {
        $this->districts = District::where('city_id', $this->city_id)->get();
        $this->updateInfoArea();
    }

    public function updateMosques()
    {
        $this->updateInfoArea();
    }

    public function updateInfoArea(){
        if(Cart::hasItem(@$this->hash['hash']) || Cart::hasItem(@$this->cart_item['hash'])){
            $cartItem = Cart::updateItem( $this->hash['hash'] ?? @$this->cart_item['hash'], [
                'quantity' => $this->qty,
                'total_price' => $this->priceQty,
                'options' => [
                    'district_id' => $this->district_id ?? 0,
                    'mosque_id' => $this->mosque_id ?? 0,
                    'city_id' => $this->city_id ?? 0,
                ]
            ]);
        }
       
    }

    public function mount($product, $cart_item, $mosques, $districts , $cities)
    {
        $this->product = $product;
        $this->qty = $this->cart_item->quantity ?? 0;
        $this->priceQty = +($this->cart_item->quantity * $product->price) ?? 0;
        $this->cart_item = $cart_item;
        $this->mosques = $mosques;
        $this->districts = $districts;
        $this->mosque_id = $cart_item->options?->mosque_id ?? 0;
        $this->district_id = $cart_item->options?->district_id ?? 0;
        $this->city_id = $cart_item->options?->city_id ?? 0;
        $this->cities = $cities;

    }

    public function render()
    {
        $this->errors = $this->messages;
        $this->cart = Cart::getDetails()->items;
        foreach ($this->cart as $key => $val) {
            if ($val->id === $this->product->id && $this->district_id === $val->options->district_id && $this->mosque_id === $val->options->mosque_id && $this->city_id === $val->options->city_id) {
                $this->hash = $val;
                break;
            }
        }
        $this->priceQty = + ((int)$this->qty * $this->product->price) ?? 0;

        return view('livewire.client.product-table');
    }

}
