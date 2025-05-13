@extends('admin.layout')

@section('title', "اضافة وسيلة دفع")
@section('title_page',"اضافة وسيلة دفع")

@section('content')

<div class="container-fluid">

    <div class="row">
        <div class="row">
            <div class="col-12 m-3">
                <div class="row mb-3 text-end">
                    <div>
                        <a href="{{ route('admin.payment_methods.index') }}" class="btn btn-outline-primary waves-effect waves-light ml-3 btn-sm">رجوع</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">

{{--                        <form action="{{ route('admin.payment_methods.store') }}" method="post" enctype="multipart/form-data">--}}
                            @csrf


                                @livewire('admin.payment-method-live-wire')


                            {{-- Butoooons ------------------------------------------------------------------------- --}}


{{--                        </form>--}}

                    </div>

                </div>
            </div> <!-- end col -->
        </div>
    </div> <!-- end row-->
    <a href="{{ route('admin.payment_methods.index') }}" class="btn btn-outline-primary waves-effect waves-light ml-3 btn-sm">رجوع</a>


</div> <!-- container-fluid -->

@endsection


@section('style')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
{{-- <script src="https://cdn.ckeditor.com/4.5.6/full/ckeditor.js"></script> --}}
<script src="{{ asset('client/js/ckeditor/ckeditor.js') }}"></script>
@endsection
