<div class="Product SingleProduct">

    <!-----spinner -->
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

    <div class="container mt-5">


        <div class="row mt-3">

            <div class="col-12 col-lg-5 ">
                <div class="imgbox mx-3">
                    <div class="topbox d-flex align-items-center justify-content-center col-12">
                        <h1 wire:ignore> {{$product->name}} </h1>
                    </div>
                    <!-- Slider main container -->
                    <div class="swiper SingleProduect col-12">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            @if( is_array(json_decode($product->img , true)))
                                @foreach(json_decode($product->img , true) as $img2)
                                <div class="swiper-slide">
                                    <img src="{{ asset("storage/" . $img2) }}" class="img-fluid" />
                                </div>
                                @endforeach
                                @else
                                <div class="swiper-slide">
                                    <img src="{{$product->getFirstPhoto() }}" class="img-fluid" />
                                </div>
                            @endif
                        </div>
                        <div class="PaginnationImg  col-12 p-3 mb-3">
                            @if(is_array(json_decode($product->img , true)))
                                @foreach(json_decode($product->img , true) as $img)
                                    <img src="{{ asset("storage/" . $img) }}" class="SmallImg img-fluid" />
                                @endforeach
                            @else
                                <img src="{{ $product->getFirstPhoto()  }}" class="SmallImg img-fluid" />
                            @endif

                        </div>
                    </div>
                </div>
            </div>
                <div class="leftSide col-12 col-lg-7 p-3 mt-0">
                    <h2>تفاصيل المنتج:</h2>
                    <p wire:ignore>
                        {!! $product->description !!}
                    </p>
                    <div class="info d-flex align-items-center mt-5 mx-3">
                        <div class="qunatity">
                            <h5>الكمية</h5>
                            <div class="btns d-flex align-items-center">
                                <button wire:click="addToCart()" onclick="spinner()" class="btn btn-increamet">+</button>
                                <input type="number" onchange="spinner()" wire:model="qty" step="any" style="width: 4rem; height: 2.35rem; text-align: center; background-color:transparent; border:none; border-top:1px solid;  border-bottom:1px solid;">

                                <button wire:click="minusFromCart()" onclick="spinner()" class="btn btn-decreamet">-
                                </button>

                            </div>
                            @error('qty') <span class="text-danger">{{ $message }}</span> @enderror

                            <div class="stars mt-3">
                                <i class="bx bxs-star text-warning"></i>
                                <i class="bx bxs-star text-warning"></i>
                                <i class="bx bxs-star text-warning"></i>
                                <i class="bx bxs-star text-warning"></i>
                                <i class="bx bxs-star text-warning"></i>
                                <i class="bx bx-share-alt text-success"></i>
                            </div>
                        </div>
                        <div class="price">
                            <h5>السعر</h5>
                            <h4>{{ $product->price }}</h4>
                        </div>
                        {{-- @if($qty > 0 )
                    <div class="price">
                        <h5>الاجمالي</h5>
                        <h4>{{ $product->price * $qty }}</h4>
                    </div>
                    @endif --}}
                </div>

                <div class="row">

                    <!----------------select option --------------->
                    <div class="col-6 input-group-1 mt-3 mb-3">
                        <select onchange="spinner()" class="form-select select2" wire:model="city_id" wire:change="changeDistricts()" id="inputGroupSelect02">
                            <option value="0" selected>حدد المدينة</option>

                            @foreach($cities as $city)
                            <option value="{{$city->id}}">{{$city->name_ar}}</option>
                            @endforeach
                        </select>

                        @error('city_id') <span class="text-danger">{{ $message }}</span> @enderror

                    </div>

                    <!----------------select option --------------->
                    <div class="col-6 input-group-1 mt-3 mb-3">
                        <select onchange="spinner()" class="form-select select2" wire:model="district_id" wire:change="changeMosques()" id="inputGroupSelect02">
                            <option value="-2" selected>حدد المنطقة</option>
                            <option value="-1" selected> الاكثر احتياجا</option>

                            @foreach($districts as $district)
                            <option value="{{$district->id}}">{{$district->name_ar}}</option>
                            @endforeach
                        </select>

                        @error('district_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div onchange="spinner()" class="input-group-2 mb-3">
                        <select class="form-select select2" wire:model="mosque_id" id="inputGroupSelect02">
                            <option value="0" selected>حدد المسجد</option>
                            @foreach($mosques as $mosque)
                            <option value="{{$mosque->id}}">{{$mosque->name_ar}}</option>
                            @endforeach
                        </select>
                        @error('mosque_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="input-group-2 mb-3">
                        <input class="form-select" wire:keydown.enter="searchMosque()" wire:model="mosque_search" placeholder="ابحث باسم المسجد ثم اضغط علي زر Enter لاظهار النتائج">

                        @if(!empty($mosque_search_table_array))
                        <table class="table stripe" id="mosqueTable">
                            <tr>
                                <th>اسم المسجد</th>
                                <th><span class="btn  btn-danger btn-sm" onclick="document.getElementById('mosqueTable').style.display = 'none'"> x </span>
                                </th>
                            </tr>
                            @foreach($mosque_search_table_array as $item)
                            <tr>
                                <td wire:ignore>{{$item->name_ar}}</td>
                                <td><span type="button" onclick="spinner()" class="btn {{$btn_success == $item['id'] ? "btn-success" : ''}}" wire:model="searched_result_mosque" wire:click="getThisMosque({{$item}})"> اختر </span></td>

                            </tr>
                            @endforeach
                        </table>
                        @endif
                    </div>
                    <!----------------end select option --------------->
                </div>

                <section class="order-detail mt-2">
                    <!-- Product Detail  Start -->
                    <span class="ms-3">هل ترغب بإهداء هذا الطلب ؟ </span>
                    <input wire:click="showGiftSection(0)" @if($has_gift==0) checked @endif type="radio">
                    <label class="form-check-label ms-3" for="is_gift_card_0" class="me-3">لا </label>
                    <input wire:click="showGiftSection(1)" class="ms-3" @if($has_gift==1) checked @endif type="radio">
                    <label class="form-check-label" for="is_gift_card_1">نعم </label>

                    <div class="custom-form mt-2" style="display:{{$has_gift == 0  ?  "none"  :  'block'}}">
                        <div class="row">
                            <div class="col-12 col-md-4 mb-2">
                                <div class="input-box mb-0">
                                    <input wire:model="sender_name" id="gift_sender" class=" form-control" type="text" placeholder="اسم المهدي" />
                                    @error('sender_name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-4 mb-2">
                                <div class="input-box mb-0">
                                    <input wire:model="recipient_name" id="gift_recipient_name" class=" form-control" type="text" placeholder="اسم المهدى إليه" />
                                    @error('recipient_name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="input-box mb-0">
                                    <input wire:model="recipient_mobile" id="gift_recipient_mobile" type="number" placeholder="رقم جوال المهدى إليه" class="form-control" />
                                    @error('recipient_mobile') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-12 my-2">
                                <div class="alert alert-warning py-1" role="alert">
                                    <i class="ri-alert-line"></i> ملاحظة: سيتم إرسال البطاقة باستخدام تطبيق الواتساب الرجاء
                                    التأكد من أن المستلم لديه واتساب على نفس الرقم.
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Product Detail  End -->
                </section>

                <section class="order-detail mt-3">
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <input wire:click="Updatedelivery(0)" @if($hasDeliveryPerson==0) checked @endif type="radio" name="is_gift_card">
                            <label class="form-check-label  ms-3" for="is_gift_card_0" class="me-3"> توصيل مباشر للمسجد </label>
                        </div>
                        <div class="col-12 col-md-3">
                            <input wire:click="Updatedelivery(1)" @if($hasDeliveryPerson==1) checked @endif type="radio">
                            <label class="form-check-label"> تسليم شخص معين </label>
                        </div>
                    </div>

                    <div class="custom-form mt-2" style="display:{{$hasDeliveryPerson  == 0  ?  "none"  :  'block'}}">
                        <div class="row">
                            <div class="col-12 col-md-4 mb-2">
                                <div class="input-box mb-0">
                                    <input wire:model="delivery_name" id="delivery_name" class=" form-control" type="text" placeholder="اسم المستلم">
                                    @error('delivery_name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-4 mb-2">
                                <div class="input-box mb-0">
                                    <input wire:model="delivery_mobile" id="delivery_mobile" type="number" placeholder="رقم الجوال" class="form-control">
                                    @error('delivery_mobile') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-12 my-2">
                                <div class="alert alert-warning" role="alert">
                                    <i class="ri-alert-line"></i> ملاحظة: في حال لم يرد الشخص على اتصالات المندوب سيتم
                                    توصيل
                                    المياه للمسجد مباشرة، وذلك بعد التنسيق معكم ومتابعتكم.
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <label class=" toggle-switch mt-3">
                    <input type="checkbox" wire:model="favoriteMosque">
                    أضافه المساجد الي المفضله ؟
                </label>

                <div class="Btns row mt-5">
                    <div class="col-6">
                        <button wire:click="updateQty()" onclick="spinner()" class="btn btn-buy w-100">اضف للسلة</button>
                    </div>
                    <div class="col-6">
                        <button wire:click="checkout()" class="btn btn-buy bg-info w-100"> اطلب الان</button>
                    </div>
                </div>
            </div>
            <!-- Loading message, initially hidden -->
        </div>
    </div>
</div>
<!--Product details-->
