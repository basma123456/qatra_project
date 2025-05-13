<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\Product;
use App\Traits\FileHandler;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Livewire\Component;
use Livewire\WithFileUploads;

class UploadPhotos extends Component
{
    use WithFileUploads;
    use FileHandler;
    public $images = [];
    public $product_id;
    public $product;
    public $json_images;
    public $storing_images = [];


    public function mount($product_id = null, $product = null)
    {
        $this->product_id = $product_id;
        $this->product = $product;
    }

    public function render()
    {
        $this->emit('showLoadingMessage');

        return view('livewire.admin.product.upload-photos');
    }

    public function store(Request $request)
    {
        if(isset($this->product->img)) {
            $this->deleteProductImages($this->product, 'img');
        }


        $this->validate([
            'images.*' => 'image|max:1024', // 1MB Max
        ]);
        $this->emit('showLoadingMessage');

        foreach ($this->images as $key => $image) {
            $this->storing_images[$key] = $image->store('images_products', 'public');
            $this->images[$key] = null;

        }

        if(empty($this->storing_images)){
            toastr()->error( 'اختر صورة علي الاقل');
            $this->emit('hideLoadingMessage');

            return ;
        }

        if ($this->product_id == null && $this->product == null) {
//            dd('yes');
            $this->product = Product::create([
                'name_ar' => '',
                'name_en' => '',
                'category_id' => 1,
            ])->refresh();
            $this->product_id =  $this->product->id;
        }


        $this->json_images = json_encode($this->storing_images);

        $this->product ->update(['img' => $this->json_images]);
        $this->emit('hideLoadingMessage');

        toastr()->success( 'تم ادخال الصور بنجاح');

    }


}
