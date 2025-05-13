<div>

@if(!empty($ads))
@foreach($ads as  $key => $ad)

    @if($key % 2 == 0)

        <!--Ads-->
            <div class="container">
                <div class="Ads row mt-5 p-0" style="background-color: {{$ad->bg_color == 'transparent' ? '' : $ad->bg_color}} !important">
                    <div class="col-12 col-lg-6 p-0">
                        <img src="{{asset($ad->pathInView())}}" class="img-fluid p-0 w-100" alt=""/>
                    </div>
                    <div class="col-12 col-lg-6 Banner text-center p-5">
                        <div class="Logo text-center">
                            @if($ad->show_logo_status == 1)
                            <img src="{{asset($ad->getLogo())}}" class="img-fluid" alt=""/>
                            @endif
                            <h4>{{$ad->title}}</h4>
                        </div>
                        <p class="my-3">
                            {!! $ad->description !!}
                        </p>
                        <a class="btn btn-order px-5 rounded-pill" target="_blank" href="{{$ad->link??'#'}}" >اطلب الان</a>
                    </div>
                </div>
            </div>

        @else
            <div class="container">
                <div class="Ads-green row mt-5 p-0"   style="background-color: {{$ad->bg_color == 'transparent' ? '' : $ad->bg_color}} !important;">
                    <div class="col-12 col-lg-6 px-0">
                        <img src="{{asset($ad->pathInView())}}" class="img-fluid p-0 w-100" alt=""/>
                    </div>
                    <div class="col-12 col-lg-6 Banner text-center p-5">
                        <div class="Logo text-center">
                            @if($ad->show_logo_status == 1)
                            <img src="{{asset($ad->getLogo())}}" class="img-fluid" alt=""/>
                            @endif
                            <h4>{{$ad->title}}</h4>
                        </div>
                        <p class="my-3">
                            {!! $ad->description !!}
                        </p>
                        <a class="btn btn-order px-5 rounded-pill" target="_blank" href="{{$ad->link??'#'}}" >اطلب الان</a>
                    </div>
                </div>
            </div>

        @endif

    @endforeach
@endif


    <!--Ads-->
        <div class="Botton text-center">
            <button class="btn-more px-5 my-3 mx-auto rounded-pill" wire:click="addTwoMore()">المزيـــد</button>
        </div>

</div>
