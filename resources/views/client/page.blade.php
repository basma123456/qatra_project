@extends('client.app')


@section('content')

    <div class="container " style="overflow-x: hidden">
        <h2 class="text-center p-5" style="color: #0a6aa1 ">{{@$singlePage->title}}</h2>
        <div class="row px-5">

            <div class="col-12">
                <p>{!! @$singlePage->content !!}</p>
            </div>
{{--            @if($singlePage->image)--}}
{{--                <div class="col text-center w-100">--}}
{{--                    <img src="{{asset($singlePage->pathInView())}}">--}}
{{--                </div>--}}
{{--            @endif--}}


        </div>
    </div>



@endsection
