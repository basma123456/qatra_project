<div>


    {{--    @if($photo)--}}
    {{--        <img src="{{$photo->temporaryUrl()}}">--}}
    {{--        @endif--}}

    {{--<form wire:submit.prevent="store">--}}
    {{--    <label>photo</label>--}}
    {{--    <input type="file"  wire:model="photo">--}}
    {{--    @error('photo')--}}
    {{--    <span class="error">{{$message}}</span>--}}
    {{--    @enderror--}}
    {{--    <button class="btn " type="submit"> save</button>--}}


    {{--    <img src="{{ asset('storage/images_tests/1737342325.jpg') }}" alt="Uploaded Image">--}}

    {{--</form>--}}

    {{--    foreach ($this->images as $key => $image) {--}}
    {{--    $this->images[$key] = $image->store('images_22','public');--}}
    {{--    }--}}

    <div class="container d-flex">
        @if($product && is_array(json_decode($product->img , true)))
        @foreach(json_decode($product->img , true) as $img)
            <img style="width: 100px; height: 100px; border-radius: 20px; border: 2px solid white" class="col" src="{{ asset("storage/" . $img) }}" alt=""
            >
        @endforeach
            @endif
    </div>


    <br>
    <div class="container d-flex">
        @foreach($this->images as $key => $image)
            @if($image)
                    <img class="col" style="width: 100px; height: 100px; border-radius: 20px; border: 2px solid white" src="{{$image->temporaryUrl()}}">
            @endif
        @endforeach
    </div>

    <div>
        <div class=" add-input">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="file" class="form-control" wire:model="images" multiple>
                        @error('image.*') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>


                <input  class="d-none" type="number" name="product_id" value="{{$product_id}}">

            </div>
        </div>
    </div>
    <br>


    <div class="col-md-12 text-center">
        <button class="btn text-white btn-success d-block" wire:click.prevent="store">اضغط هنا لتاكيد اختيار الصور</button>
    </div>


    @if(empty($this->images) )

    <!-- Loading message, initially hidden -->
    <div id="loadingMessage" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: rgba(0,0,0,0.5); color: white; padding: 20px; border-radius: 5px;">
        <h3>يرجى الانتظار جاري تحميل الصور ...</h3>
    </div>
        @endif

</div>
