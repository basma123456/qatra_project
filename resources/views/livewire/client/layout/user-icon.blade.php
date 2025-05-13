<div>
    @if($user == null)
        <i class="bx bx-user-circle ms-1" onclick="window.location.href='{{route('client.login')}}'"></i>
    @else
        <i class="bx bx-user-circle ms-1" onclick="window.location.href='{{route('client.profile.index')}}'"></i>
        <span>  {{$this->user->name  }} </span>
    @endif


</div>
