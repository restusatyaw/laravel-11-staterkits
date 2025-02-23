@if (isset($status))
    <span class="badge {{$status == 1 ? 'badge-success':'badge-danger'}}">{{$status == 1 ? 'Aktif':'Tidak Aktif'}}</span>
@endif
@if (isset($photo))
    <figure class="avatar mr-2 avatar-sm" data-initial="PH"></figure>
    <span>{{$name}}</span>
@endif