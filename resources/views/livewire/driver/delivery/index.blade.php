<div class="col-md-6 col-xl-4" id="row_{{ @$item->order_id }}">
    <div class="card shadow-none bg-transparent border border-primary m-2">
        <div class="card-body">
            <h5 class="card-title">طلب رقم #{{ @$item->orderdetails->id }}</h5>
            <h5 class="card-title"> اوردر رقم #{{ @$item->order->id }}</h5>
            <p class="card-text">
                {{ @$item->orderdetails->mosque->name }} ، {{ @$item->orderdetails->mosque->city->name }} ،
                {{ @$item->orderdetails->mosque->district->name }}
            </p>
            <p>يبعد عنك : {{ number_format($item->distance, 2) }} كم</p>


            <ul class="p-0 m-0">
                <li class="d-flex mb-3">
                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                        <div class="me-2">
                            <p class="mb-0 lh-1">{{ @$item->orderdetails->title }} </p>
                        </div>
                        <div class="item-progress">الكمية:{{ @$item->orderdetails->quantity }}</div>
                    </div>
                </li>

            </ul>
            <div class="row justify-content-center">
                <div class="col text-center">
                    <a href="https://www.google.com/maps/search/?api=1&query={{ @$item->order->mosque->latitude }},{{ @$item->order->mosque->longitude }}" target="_blank" class="btn rounded-pill btn-icon btn-label-primary">
                        <span class="tf-icons bx bx-map"></span>
                    </a>
                </div>
                <div class="col text-center">
                    {{-- <a href="" class="btn rounded-pill btn-icon btn-label-primary">
                                <span class="tf-icons bx bxs-camera-plus"></span>
                            </a> --}}
                    <button data-bs-toggle="modal" data-bs-target="#exampleModal{{ $item->id }}">
                        <span class="tf-icons fa fa-camera"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $item->id }}" aria-hidden="true" wire:ignore>
        <div class="modal-dialog">
            <form wire:submit.prevent="submitForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel{{ $item->id }}">
                            تحديث حالة طلب رقم #{{ @$item->order_details_id }}
                            <br>
                            اوردر رقم #{{ @$item->order_id }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    
                        <div class="row">
                            <div class="col-sm-6">
                                @for ($i = 1; $i <= 4; $i++) 
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label">صورة {{ $i }}</label>
                                        <input wire:model="img.{{ $i }}" class="form-control" type="file" id="formFile{{ $i }}" onchange="previewImage(this)" data-output="formfilepreview{{ $i }}" data-button="button_remove_image{{ $i }}" />
                                        <img class="border p-1 my-1 w-100 rounded" src="" id="formfilepreview{{ $i }}" style="display: none" />
                                        <button type="button" class="btn btn-danger mt-2 p-2 button_remove_image" id="button_remove_image{{ $i }}" data-output="formfilepreview{{ $i }}" data-file="formFile{{ $i }}" style="display: none"><i class='bx bx-x-circle'></i></button>
                                    </div>
                                @endfor
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">تفاصيل أخرى</label>
                                <textarea class="form-control" wire:model="message" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="roleEx3" class="form-label">اختر حالة الطلب الجديدة</label>
                                <div class="form-check">
                                    <input wire:model="status" class="form-check-input" type="radio" value="1" id="defaultRadio1" @if($status == 1) checked @endif >
                                    <label class="form-check-label" for="defaultRadio1"> تم التوصيل </label>
                                </div>
                                <div class="form-check">
                                    <input wire:model="status" class="form-check-input" type="radio" value="0" id="defaultRadio2">
                                    <label class="form-check-label" for="defaultRadio2"> تعذر التوصيل </label>
                                </div>
                            </div>
                        </div>
                    
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">غلق</button>
                    <button type="submit" class="btn btn-primary">إرسال </button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
