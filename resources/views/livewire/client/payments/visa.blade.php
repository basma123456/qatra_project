<div>

    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    @if ($error_message != "")
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ $error_message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div id="card-sdk-id"></div>
    <div class="Btns mb-3 p-3 row">
        <div class="col-md-8 mb-1">
            <button class="btn w-100" type="button" onclick="window.CardSDK.tokenize()"> @lang('Pay') </button>
        </div>
        <div class="col-md-4 mb-1">
            <a href="{{ route('client.home') }}" class="btn w-100"> @lang('Cancel') </a>
        </div>
    </div>
    <script>
        const {
            renderTapCard,
            Theme,
            Currencies,
            Direction,
            Edges,
            Locale
        } = window.CardSDK
        const {
            unmount
        } = renderTapCard('card-sdk-id', {
            // publicKey: '{{ app()->isLocal() ? config('tap.public_test_key') : config('tap.public_key') }}',
            publicKey: 'pk_test_kbUKsSz9NafL1jVTcC47MZqA',
            merchant: {
                id: '18926073'
            },
            transaction: {
                amount: {{ $cart->total }},
                currency: Currencies.SAR
            },
            customer: {
                // id: '123',
                name: [{
                    lang: Locale.EN,
                    first: '{{ Auth::user()->name }}',
                    last: '',
                    middle: ''
                }],
                nameOnCard: '{{ Auth::user()->name }}',
                editable: true,
                contact: {
                    email: '{{ Auth::user()->mobile }}@qatra.sa',
                    phone: {
                        countryCode: '',
                        number: '{{ Auth::user()->mobile }}'
                    }
                }
            },
            acceptance: {
                supportedBrands: ['AMERICAN_EXPRESS', 'VISA', 'MASTERCARD', 'MADA'],
                supportedCards: "ALL"
            },
            fields: {
                cardHolder: true
            },
            addons: {
                displayPaymentBrands: true,
                loader: true,
                saveCard: true
            },
            interface: {
                locale: Locale.EN,
                theme: Theme.LIGHT,
                edges: Edges.CURVED,
                direction: Direction.LTR
            },
            onReady: () => console.log('onReady'),
            onFocus: () => console.log('onFocus'),
            onBinIdentification: (data) => console.log('onBinIdentification', data),
            onValidInput: (data) => console.log('onValidInputChange', data),
            onInvalidInput: (data) => console.log('onInvalidInput', data),
            onChangeSaveCardLater: (isSaveCardSelected) => console.log(isSaveCardSelected, " :onChangeSaveCardLater"), // isSaveCardSelected:boolean
            onError: (data) => console.log('onError', data),
            onSuccess: (data) => @this.visaInit()
        })
    </script>

</div>
