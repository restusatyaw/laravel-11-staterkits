@extends('backoffice.layouts.app')


@section('content')

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <form class="mt-4 needs-validation" novalidate
                    action="{{$data == null ? route('backoffice.donationtype.store') : route('backoffice.donationtype.update', $data->id)}}" method="POST">
                    @csrf
                    @if ($data !=null)
                    @method('PUT')
                    @endif
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label class="form-label" for="userpassword">Nama Zakat</label>
                                <div class="input-group">
                                    <input type="text" name="name" value="{{$data->name ?? ''}}" required
                                        class="form-control" id="name" placeholder="Masukkan nama">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="userpassword">Description</label>
                                <div class="input-group">
                                    <textarea name="description" class="form-control" id="" cols="20" rows="10">{{$data->description ?? ''}}</textarea>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="userpassword">Status</label>
                                <div class="input-group">
                                    <select name="is_active" id="" class="form-control">
                                        <option value="1" {{$data && $data->is_active == 1 ? 'selected':''}}>Aktif</option>
                                        <option value="0" {{$data && $data->is_active == 0 ? 'selected':''}}>Tidak Aktif</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label" for="userpassword">Photo</label>
                                <div class="input-group">
                                    <input type="file" name="photo" class="dropify" data-default-file="url_of_your_file" />
                                </div>
                            </div>
                        </div>
                        
                    </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary" type="submit"><i class="ti ti-save"></i> Save Data</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- end row -->
@endsection

@push('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css"/>
    
@endpush

@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script>
    $('.dropify').dropify();
</script>
@endpush
