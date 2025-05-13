<div class="media">
    <span><i data-feather="send"></i></span>
    <div class="media-body">
        <h2 class="font-md title-color">نتائج البحث</h2>
    </div>
</div>

<div class="location mb-5">
    @if ($mosques->count() > 0)
        @foreach ($mosques as $mosque)
            <div class="location-box">
                <a href="{{ route('front.products', $mosque->id) }}">
                    <h3 class="title-color font-sm"><i class="iconly-Location icli"></i>{{ $mosque->name }}
                    </h3>
                </a>
                <p class="content-color font-sm">{{ $mosque->city->name }} - {{ $mosque->district->name }}
                </p>
            </div>
        @endforeach
    @else
        <div class="row">
            <div class="col-12 text-center my-3">
                <img src="{{ url('/assets/images/empty.png') }}" class="" style="width: 50px" />
            </div>
            <div class="col-12 text-center">
                <p class="content-color">لم نجد أي مسجد يطابق البحث المدخل
                </p>
            </div>
        </div>
    @endif
</div>