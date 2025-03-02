@if (isset($status))
    <span class="badge {{$status && $status == 1 ? 'badge-success':'badge-danger'}}">{{$status && $status == 1 ? 'Aktif':'Tidak Aktif'}}</span>
@endif
@if (isset($payment_method))
    <span class="badge {{$payment_method == 'bank_transfer' ? 'badge-dark':'badge-primary'}}">{{$payment_method == 'bank_transfer' ? 'Bank Transfer':'Manual'}}</span>
@endif
@if (isset($payment_status))
    @if ($payment_status == 'pending')
    <span class="badge badge-warning">Pending</span>
    @elseif ($payment_status == 'expired')
    <span class="badge badge-danger">Expired</span>
    @elseif ($payment_status == 'cenceled')
    <span class="badge badge-secondary">Canceled</span>
    @elseif ($payment_status == 'completed')
    <span class="badge badge-success">Completed</span>
    @elseif ($payment_status == 'proccessing')
    <span class="badge badge-info">Processing</span>
    @endif
@endif
@if (isset($photo))
    <figure class="avatar mr-2 avatar-sm" data-initial="PH"></figure>
    <span>{{$name}}</span>
@endif
@if (isset($currency))
    <span>Rp. {{ number_format($currency, 2, ',', '.') }}</span>
@endif