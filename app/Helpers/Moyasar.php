<?php
namespace App\Helpers;

class Moyasar {

    static function get_from($order,$callback_url){
        $amount = $order->total *100;
        $publishable_api_key = env("MOYASAR_API_PUBLISHABLE_KEY");
        $form = <<<EOF
        
        <div class="mysr-form"></div>
        
        <!-- Moyasar Scripts -->
        <script src="https://polyfill.io/v3/polyfill.min.js?features=fetch"></script>
        <script src="https://cdn.moyasar.com/mpf/1.6.1/moyasar.js"></script>
        <script>
            Moyasar.init({
                element: '.mysr-form',        
                amount: $amount,
                language: 'ar',
        
                // Required
                // Currency of the payment transation
                currency: 'SAR',
        
                // Required
                // A small description of the current payment process
                description: 'Order ID #$order->id',
        
                // Required
                publishable_api_key: '$publishable_api_key',
        
                // Required
                // This URL is used to redirect the user when payment process has completed
                // Payment can be either a success or a failure, which you need to verify on you system (We will show this in a couple of lines)
                callback_url: '$callback_url',
        
                // Optional
                // Required payments methods
                // Default: ['creditcard', 'applepay', 'stcpay']
                methods: [
                    'creditcard',
                ],
            });
        </script>
EOF;
        return $form;
    }

}