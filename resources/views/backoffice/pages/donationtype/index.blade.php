@extends('backoffice.layouts.app')

@section('content')

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">List Data {{$page_title}}</h4>
                <table class="table" id="datatables">
                    <thead>
                            <th scope="col">Title</th>
                            <th scope="col">Is Active</th>
                            <th scope="col">Created At</th>
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
            ajax: "{{ route('backoffice.donationtype.getdata') }}",
            columns: [
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'is_active',
                    name: 'is_active'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

</script>
@endpush

