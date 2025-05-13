<p>{{ $message->message }}</p>
<p class="small">{{ $message->created_at }}</p>

<div id="carouselExample" class="carousel carousel-dark slide carousel-fade" data-bs-ride="carousel">
    <ol class="carousel-indicators">
        @foreach ($imgs as $img)
            <li data-bs-target="#carouselExample" data-bs-slide-to="{{ $loop->index }}"
                class="@if ($loop->index == 0) active @endif"></li>
        @endforeach
    </ol>
    <div class="carousel-inner">
        @foreach ($imgs as $img)
        <div class="carousel-item @if ($loop->index == 0) active @endif">
            {{-- <pre>{{ print_r($img) }}</pre> --}}
            <img class="d-block w-100" src="{{ url("storage/" . $img->img) }}" alt=""  width="150" />
        </div>
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#carouselExample" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">السابق</span>
    </a>
    <a class="carousel-control-next" href="#carouselExample" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">التالي</span>
    </a>
</div>
