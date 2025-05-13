@extends('client.app')


@section('content')


  <!--Fovarite section-->
  <div class="Mosqat">
    <div class="container bg-light mt-5 rounded-3">
      <div class="info row gx-2">
        <!--edit section -->
        <div class="col-12 order-2 col-lg-9 mx-auto">
          <div class="info row px-lg-5 bg-white m-md-5">
            <h1 class="col-12 fs-2 text-center mt-5">المساجد المفضلة</h1>
            <div class="SingleMosqat">
              <div class="row">
                @forelse ($favorites as $favorite)
                <div class="col-12">
                    <div class="SingleRow mt-3 p-3 rounded-3 d-flex align-content-center">
                      <div class="RowImg">
                        <img src="{{ asset('client/img/location.jpg') }}" class="img-fluid" alt="" />
                      </div>
                      <div class="bar mx-3"></div>
                      <div class="text mt-3">
                        <h5> {{ @$favorite->mosque?->name }} </h5>
                        <p> {{ @$favorite->mosque?->city?->name }} -  {{ @$favorite->mosque?->district?->name }} </p>
                      </div>
                    </div>
                  </div>
                @empty
                    
                @endforelse
               
              </div>
            </div>
          </div>
        </div>
        <!--edit section -->

        <!--Menu section-->
        <x-client.profile.side-menu />
        <!--Menu section-->
      </div>
    </div>
  </div>
  <!--Fovarite section-->

@endsection
