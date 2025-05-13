[
    @foreach ($mosques as $mosque )
    {
        "id": {{ $mosque->id }},
        "jsonurl": "{{ url("mosques/item/json")."/".str_replace("=","",base64_encode($mosque->cid)) }}",
        "lat": {{ $mosque->latitude }},
        "lng": {{ $mosque->longitude }},
        "icon": "@if($mosque->is_full)  {{ url('assets/pic/m_1_orange_s.png') }} @else {{ url('assets/pic/m_1_blue_s.png') }} @endif"
    } @if(!$loop->last) , @endif

    @endforeach
]