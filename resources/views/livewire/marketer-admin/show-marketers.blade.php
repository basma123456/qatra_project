<div>
    <a class="btn btn-outline-orange" wire:click="ShowMarketers({{$marketer_admin->id}})">  اظهار المسوقين </a>
    {{-- In work, do what you enjoy. --}}
    <div class="container  {{$closeOrOpen}} card">
        <br>
        <div  class="row">
        @forelse($marketers as $marketer)
            <span class="badge bg-indigo  mx-1 my-1 col-3"> {{$marketer->name}} </span>

        @empty
            <span class="badge bg-indigo  col-3 my-1">  لا يوجد </span>
        @endforelse
        </div>
    </div>
</div>
