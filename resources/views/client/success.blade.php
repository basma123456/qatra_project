@extends('client.app')

@section('content')
    <!--Thank You secation-->
    <div class="ThankYou mt-1">
        <div class="container">
            <div class="row mt-3 mx-3 mx-md-0">
                <div class="col-12 mx-auto shadow-lg py-5">
                    <div class="icon m-auto text-center">
                        <i class='bx bx-check bx-tada h1 display-1 text-success' style="font-size: 100px"></i>
                    </div>
                    <div class="col-12 text-center pt-1">
                        <i class="icofont-star star-icon text-secound fs-1 my-1"></i>
                        <div class="text py-5">
                            <h1 class="text-success display-3" dir="ltr">@lang('Thank you')</h1>
                            @include('client.layouts.message')
                            <a href="{{ route('client.home') }}" class="btn btn-success mt-5 m-3">
                                @lang('Back to website')
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
