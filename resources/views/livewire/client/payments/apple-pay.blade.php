<div>
    <form wire:submit.prevent="checkout" class="">
        <div id="applepay" class="content-div">
            <h5 class="my-3">الدفع من خلال ابل باي</h5>
        </div>

        <div class="Btns mb-3 p-3 row">
            <div class="col-md-9 mb-1">
                <button class="btn w-100" @if(@auth()->user()?->id == null) disabled @endif type="submit" >@lang('Pay')</button>
            </div>
            <div class="col-md-3 mb-1">
                <a href="{{ route('client.home') }}" class="btn w-100"> @lang('Cancel') </a>
            </div>
        </div>
    </form>
</div>
