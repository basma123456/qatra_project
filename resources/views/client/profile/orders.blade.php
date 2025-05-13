@extends('client.app')


@section('content')

<!--Fovarite section-->
<div class="Fovarite">
    <div class="container bg-light mt-5 rounded-3">
        <div class="info row gx-2">
            <!--edit section -->
            @livewire('client.profile.orders')
            
            <!--edit section -->
            <x-client.profile.side-menu />
        </div>
        <!--Menu section-->
    </div>
</div>
<!--Fovarite section-->



@endsection
