<div>
    <form wire:submit.prevent="checkout" class="">
        <div class="">
            <h5 class="my-3"> @lang('Pay From Bank Transfer') </h5>

            @include('livewire.client.payments.message')
            <div class="mb-3">
                <label class="form-label">
                    @lang('Bank name')
                </label>
                <select wire:model="bank_id" class="form-control" id="">
                    <option value="" selected disabled></option>
                    @forelse (@$bank_accounts as $account)
                        <option value="{{ $account->id }}" selected=""> {{ $account->name_ar }} </option>
                    @empty
                    @endforelse
                </select>
                @error('bank_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label"> @lang('Account Holder Name') </label>
                <input type="text" class="form-control" wire:model="bank_name" readonly />
            </div>

            <div class="mb-3">
                <label class="form-label"> @lang('Account number') </label>
                <input type="text" class="form-control mb-3" wire:model="account_no" />
                <input type="text" class="form-control" wire:model="iban" />
            </div>

            <div class="mb-3">
                <label class="form-label">
                    @lang('Attach the payment receipt/transfer copy')
                </label>

                <input class="form-control" type="file" id="formFile" wire:model="transfer_img" />
                <small class="d-block">@lang('jpg-jpeg-png-pdf')</small>
                <small class="d-block text-danger text-start">
                    @lang('Maximum file size is 2MB')
                </small>
                @error('transfer_img')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="Btns mb-3 p-3 row">
            <div class="col-md-8 mb-1">
                <button class="btn w-100" @if (@auth()->user()?->id == null) disabled @endif type="submit">@lang('Pay')</button>
            </div>
            <div class="col-md-4 mb-1">
                <a href="{{ route('client.home') }}" class="btn w-100"> @lang('Cancel') </a>
            </div>
        </div>
    </form>
</div>
