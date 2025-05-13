<div class="card-body p-3">
    <div class="loading position-absolute start-50" dir="ltr" wire:loading><i class='bx bx-loader-circle bx-spin'></i> loading ..</div>
    <script src="https://tap-sdks.b-cdn.net/card/1.0.0-beta/index.js"></script>
    @if (@auth()->user()?->id == null)
        <span class="text-danger">من فضلك قم بتسجيل الدخول لاستكمال عملية الدفع</span>
    @else
        <div class="paymetMethods px-3">
            <div class="Banks">
                <h5 class="my-3">وسيلة الدفع</h5>
                <ul class="imgs d-flex justify-content-center align-items-center">
                    <li class="flex-grow-1">
                        <button wire:click="SelectPayment('bankTransfer')" id="bank" class="button @if ($paymentMethod == 'bankTransfer') active @endif">
                            <span>
                                <img src="{{ asset('client/img/bank-transfer.png') }}" alt="" />
                            </span>
                        </button>
                    </li>
                    <li class="flex-grow-1">
                        <button wire:click="SelectPayment('visa')" id="visa" class="button @if ($paymentMethod == 'visa') active @endif">
                            <span>
                                <img src="{{ asset('client/img/visa-mada.png') }}" alt="" />
                            </span>
                        </button>
                    </li>
                    @if ($iphone || $safari)
                        <li class="flex-grow-1">
                            <button wire:click="SelectPayment('applePay')" id="apple-pay" class="button @if ($paymentMethod == 'applePay') active @endif">
                                <span>
                                    <img src="{{ asset('client/img/apple-pay.png') }}" alt="" />
                                </span>
                            </button>
                        </li>
                    @endif
                </ul>

                <!-- visa-pay-tab -->
                @if ($paymentMethod == 'visa')
                    @livewire('client.payments.visa', ['taxes' => $taxes, 'note' => $note, 'cart' => $cart])

                    <!-- apple-pay-tab -->
                @elseif($paymentMethod == 'applePay')
                    @livewire('client.payments.apple-pay', ['taxes' => $taxes, 'note' => $note, 'cart' => $cart])

                    <!-- transfer-pay-tab -->
                @elseif($paymentMethod == 'bankTransfer')
                    @livewire('client.payments.bank-transfer', ['taxes' => $taxes, 'note' => $note, 'cart' => $cart])
                @endif

            </div>
        </div>

    @endif
</div>
