@extends('layouts.app')
@section('title')
@endsection
@section('css')
@endsection
@section('skeleton')
@endsection
@section('content')
    <main class="main-wrap login-page mb-xxl">

        <!-- Login Section Start -->
        <section class="login-section p-0">
            <!-- Login Form Start -->
            <form action="#" class="custom-form">
                <h1 class="font-md title-color fw-600">Choose Langague </h1>

                <div class="d-flex flex-row border rounded my-2">
                    <div class="p-2 bd-highlight"><img src="{{ url('') }}/assets/images/saudi-arabia-flag.png" style="width: 30px;"/></div>
                    <div class="p-2 bd-highlight"><a href="#" class="">العربية</a></div>
                </div>
                <div class="d-flex flex-row border rounded my-2">
                    <div class="p-2 bd-highlight"><img src="{{ url('') }}/assets/images/united-kingdom-flag.png" style="width: 30px;"/></div>
                    <div class="p-2 bd-highlight">English (soon)</div>
                </div>

            </form>
            <!-- Login Form End -->

        </section>
        <!-- Login Section End -->
    </main>
@endsection
@section('js')
@endsection
