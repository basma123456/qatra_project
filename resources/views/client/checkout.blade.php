@extends('client.app')


@section('content')

<!---Checkout-->
<div class="checkout">
    <div class="container">
        @livewire('client.checkout')
    </div>
</div>
<!---Checkout-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


@endsection
