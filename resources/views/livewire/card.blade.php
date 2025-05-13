<div>
    <div class="p-4">

        <form class="row g-3" wire:submit.prevent="savedetail">
            <div class="col-12">
                <p>إضافة نص جديد للصورة : </p>
            </div>
            <div class="col-1">
                <input type="text" class="form-control" id="card_detail_x" wire:model.defer="x" placeholder=" X">
                <label for="X" class="form-label">X</label>
            </div>
            <div class="col-1">
                <input type="text" class="form-control" id="card_detail_y" wire:model.defer="y" placeholder=" Y">
                <label for="Y" class="form-label">Y</label>
            </div>
            <div class="col-3">

                <input type="text" class="form-control" id="text" wire:model.defer="text"
                    placeholder="النص الذي سيظهر">
                <label for="text" class="form-label">النص</label>
            </div>
            
            <div class="col-2">
                <input type="text" class="form-control" id="size" wire:model.defer="size" placeholder="مقاس النص">
                <label for="size" class="form-label">المقاس</label>
            </div>
            <div class="col-2">
                <div class="row">
                    <div class="col-9">
                        <input type="text" class="form-control" id="color" wire:model.defer="color"
                            placeholder="لون النص">
                    </div>
                    <div class="col-3">
                        <span id="color-picker-monolith"></span>
                    </div>
                </div>
                <label for="color" class="form-label">اللون</label>
            </div>
            <input type="hidden" wire:model.defer="detail_id" value="">
            <div class="col-3">
                <div class="row">
                    <div class="col-6 text-center">
                        <div class="align-bottom align-text-bottom">
                            <button type="submit" class="btn btn-primary">حفظ</button>
                        </div>
                    </div>
                    @if (!is_null($this->detail_id))
                        <div class="col-6 text-center">
                            <div class="align-bottom align-text-bottom">
                                <button wire:click="add" class="btn btn-primary">جديد</button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </form>

        <div class="row" wire:poll>
            <div class="col-lg-6">
                <div class="p-4 text-center">
                    <img src="{{ $img_url }}" class="img-fluid border rounded" />
                    <div class="my-3 text-start">
                        {!! nl2br($card->text) !!}
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                @if ($card->details->count() > 0)
                    <table class="invoice-list-table table binstance-top">
                        <thead>
                            <tr>
                                {{-- <th class="text-center">
                                <h5 class="my-3">X</h5>
                            </th>
                            <th class="text-center">
                                <h5 class="my-3">Y</h5>
                            </th> --}}
                                <th class="text-center">
                                    <h5 class="my-3">النص</h5>
                                </th>
                                <th class="text-center">
                                    <h5 class="my-3">المقاس</h5>
                                </th>
                                <th class="text-center">
                                    <h5 class="my-3">اللون</h5>
                                </th>
                                <th class="text-center">
                                    <h5 class="my-3">عمليات</h5>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($card->details as $detail)
                                <tr>
                                    {{-- <td class="text-center">{{ $detail->x }} </td>
                                <td class="text-center">{{ $detail->y }}</td> --}}
                                    <td class="text-center">{{ $detail->text }}</td>
                                    <td class="text-center">{{ $detail->size }}</td>
                                    <td class="text-center">{{ $detail->color }}</td>
                                    <td class="text-center">
                                        <div class="d-inline-block text-nowrap">

                                            <a wire:click="edit({{ $detail->id }})"
                                                class="btn btn-sm btn-icon livewireCardDetail" title="تعديل">
                                                <i class='bx bx-edit'></i>
                                            </a>
                                            <a wire:click="delete({{ $detail->id }})"
                                                class="btn btn-sm btn-icon delete-record" title="حذف">
                                                <i class='bx bx-trash'></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>



    </div>

</div>
