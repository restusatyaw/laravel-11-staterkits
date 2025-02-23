@extends('backoffice.layouts.app')

@section('content')

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">List Data {{$page_title}}</h4>
                <table class="table" id="datatables">
                    <thead>
                            <th scope="col">Kode Pembayaran</th>
                            <th scope="col">Customer</th>
                            <th scope="col">Jenis Zakat</th>
                            <th scope="col">Total Pembayaran</th>
                            <th scope="col">Jenis Pembayaran</th>
                            <th scope="col">Status Pembayaran</th>
                            <th scope="col">Tanggal Pembayaran</th>
                            <th width="10%" class="text-center">Action</th>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- end row -->
@endsection

@push('script')
<script>
    var table = $("#datatables").DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('backoffice.transaction.getdata') }}",
            order: [[6, 'desc']],
            columns: [
                {
                    data: 'code',
                    name: 'code'
                },
                {
                    data: 'user_id',
                    name: 'user_id'
                },
                {
                    data: 'donation_type_id',
                    name: 'donation_type_id'
                },
                {
                    data: 'total_payment',
                    name: 'total_payment'
                },
                {
                    data: 'payment_method',
                    name: 'payment_method'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    className:'text-center'
                },
            ]
        });

</script>
@endpush

