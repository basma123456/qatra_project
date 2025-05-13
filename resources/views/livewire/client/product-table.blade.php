<div class="pt-3" style="display: {{$qty == 0 ? 'none' : 'flex' }}">

    {{-- <div  id="loadingSpinner" class="spinner text-center m-auto" style=" display: none; z-index: 10; position: fixed; left: 100vh; top:50vh;"></div>--}}
    <div id="loadingMessage" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: rgba(0,0,0,0.5); color: white; padding: 20px; border-radius: 5px;">
        <h3>يرجى الانتظار...</h3>
    </div>

    <script>
        function spinner() {
            // Show the loading spinner
            document.getElementById("loadingMessage").style.display = "block";
            // Simulate a delay (e.g., an API call or some processing)
            setTimeout(function() {
                // Hide the loading spinner after 3 seconds (for example)
                document.getElementById("loadingMessage").style.display = "none";
            }, 10000);
        }

    </script>
    <!-----end spinner -->

    @error('qty') <span class="text-danger">{{ $message }}</span> @enderror
    <br>
    @error('district_id') <span class="text-danger">{{ $message }}</span> @enderror
    <br>
    @error('mosque_id') <span class="text-danger">{{ $message }}</span> @enderror
    <br>

    <div class="row mb-3">
        <div class="col-12 col-lg-4 productImg">
            <div class="imgbox mx-auto">
                <div class="topbox d-flex align-items-center justify-content-center">
                    <h6 wire:ignore> {{$product->name}} </h6>
                </div>
                <img onclick="window.location.href='{{route('client.products.show' , $product->slug)}}'" src="{{$product->getFirstPhoto()}}" class="img-fluid linkable" wire:ignore />
            </div>
        </div>

        <div class="col-12 col-lg-4 text-center mt-3 mt-lg-0 ProductAmount">
            <div class="product_info">
                <div class="counter d-flex justify-content-center align-items-center">
                    <span class="mx-3" wire:ignore> <b> {{$product->price}} ر.س </b> </span>
                    <div class="btns d-flex align-items-center">
                        <button wire:click="addToCart()" onclick="spinner()" class="btn btn-increamet">+</button>
                        <input type="number" readonly disabled required  style="width: 4rem; height: 2.35rem; text-align: center; background-color:transparent; border:none; border-top:1px solid;  border-bottom:1px solid;" id="qty_{{$product->id}}" wire:model="qty">
                        <button wire:click="minusFromCart()" onclick="spinner()" class="btn btn-decreamet">-</button>
                    </div>
                </div>
            </div>
            <div class="row pt-4">
                <div class="seleect col-12 py-1 text-end">
                    <h6>المدن</h6> 
                    <select onchange="spinner()" required class="form-select" wire:change="changeDistricts()" wire:model="city_id" id="inputGroupSelect02">
                        <option value="0" disabled>حدد المدينة</option>
                        @foreach($cities as $city)
                        <option {{$city->id == +(@$cart_item['options']['city_id']) ? 'selected' : ''}} value="{{$city->id}}">{{$city->name_ar}} </option>
                        @endforeach
                    </select>
                </div>

                <div class="seleect col-12 py-1 text-end">
                    <h6>المنطقة</h6>
                    <select onchange="spinner()" required class="form-select" wire:change="changeMosques()" wire:model="district_id" id="inputGroupSelect02">
                        <option value="0" disabled>حدد المنطقة</option>
                        <option {{ +($cart_item['options']['district_id']) ==  -1 ? 'selected' : ''}} value="-1"> الاكثر
                            احتياجا
                        </option>
                        @foreach($districts as $district)
                        <option {{$district->id == +($cart_item['options']['district_id']) ? 'selected' : ''}} value="{{$district->id}}">{{$district->name_ar}} </option>
                        @endforeach
                    </select>
                </div>

                <div class="seleect col-12 py-1 text-end mb-3">
                    <h6>المسجد</h6>
                    <select onchange="spinner()" required class="form-select" wire:change="updateMosques()"  wire:model="mosque_id" id="inputGroupSelect02">
                        <option value="0" disabled>حدد المسجد</option>
                        @foreach($mosques as $mosque)
                        <option {{$mosque->id == +($cart_item['options']['mosque_id']) ? 'selected' : ''}} value="{{$mosque->id}}">{{$mosque->name_ar}} </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-4 text-center mt-3 mt-lg-0 ProductTotal">
            <h4 class="text-danger h-25">{{$priceQty}}</h4>
            @if( @$cart_item['options']['sender_name'] != NULL)
            <i class="bx bx-gift btn fs-3 text-main" data-bs-toggle="modal" data-bs-target="#{{ $hash['hash'] }}"></i>
            <!-- Modal -->
            <div class="modal fade" id="{{ $hash['hash'] }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel"> بيانات الاهداء </h1>
                            <button type="button" class="btn-close mx-0" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>اسم المهدي : {{ @$cart_item['options']['sender_name'] }} </p>
                            <p>ااسم المهدى إليه : {{ @$cart_item['options']['recipient_name'] }} </p>
                            <p>اسم المهدي : {{ @$cart_item['options']['recipient_mobile'] }} </p>
                        </div>
                    </div>
                </div>
            </div>
            @endif


            @if(@$cart_item['options']['delivery_name'] != NULL)
            <i class="bx bxs-user-detail btn fs-3 text-main" data-bs-toggle="modal" data-bs-target="#delivery_{{ $hash['hash'] }}"></i>
            <!-- Modal -->
            <div class="modal fade" id="delivery_{{ $hash['hash'] }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel"> بيانات الاهداء </h1>
                            <button type="button" class="btn-close mx-0" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>اسم المستلم : {{ @$cart_item['options']['delivery_name'] }} </p>
                            <p>رقم الجوال المستلم : {{ @$cart_item['options']['delivery_mobile'] }} </p>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @if(@$cart_item['options']['favoriteMosque'] == 1)
                <i class='bx bxs-heart btn fs-3 text-main' ></i>
            @endif

            <div class="row">
                
                {{-- <button class="mb-0 btn btn-primary" onclick="spinner()" wire:click="updateQty()"> تعديل <i class='bx bx-edit'></i>
                </button> --}}
            </div>
        </div>



        <br>
        <hr>
        <br>

    </div>


    <button wire:click="deleteCart()" class="btn btn-sm btn-danger me-1" style="margin-left:0; width: fit-content; height: fit-content; font-size: small "> x
    </button>

    <hr>
</div>
