<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://tap-sdks.b-cdn.net/card/1.0.0-beta/index.js"></script>

    <title>card demo</title>
</head>

<body>
    <div id="card-sdk-id"></div>
    <button class="w-10 btn btn-dark btn-md mt-4" type="button" onclick="window.CardSDK.tokenize()">Submit Payment</button>
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
            publicKey: 'pk_test_kbUKsSz9NafL1jVTcC47MZqA',
            merchant: {
                id: '18926073'
            },
            transaction: {
                amount: 1,
                currency: Currencies.SAR
            },
            customer: {
                id: '123',
                name: [{
                    lang: Locale.EN,
                    first: 'Test',
                    last: 'Test',
                    middle: 'Test'
                }],
                nameOnCard: 'Test Test',
                editable: true,
                contact: {
                    email: 'test@gmail.com',
                    phone: {
                        countryCode: '20',
                        number: '1000000000'
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
            onSuccess: (data) => console.log('onSuccess', data)
        })
    </script>
</body>

</html>
