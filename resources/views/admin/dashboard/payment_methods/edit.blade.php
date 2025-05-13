@extends('admin.layout')

@section('title', " تعديل وسيلة دفع " . @$payment_method->title)
@section('title_page', " تعديل وسيلة دفع " . @$payment_method->title )


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
                            @livewire('admin.payment-method-update' , ['payment_method' => $payment_method])
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
        </div> <!-- end row-->
        <a href="{{ route('admin.payment_methods.index') }}" class="btn btn-outline-primary waves-effect waves-light ml-3 btn-sm">رجوع</a>

        <script>
            window.addEventListener('redirect', event => {
                window.location.href = event.detail.url;
            })
        </script>

    </div> <!-- container-fluid -->

@endsection


@section('style')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('client/js/ckeditor/ckeditor.js') }}"></script>
@endsection
