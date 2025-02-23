@extends('backoffice.layouts.app')


@section('content')

<div class="row">
    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">
                <form class="mt-4 needs-validation" novalidate
                    action="{{$data == null ? route('backoffice.user.store') : route('backoffice.user.update', $data->id)}}" method="POST">
                    @csrf
                    @if ($data !=null)
                    @method('PUT')
                    @endif
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label class="form-label" for="userpassword">Name</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                                <input type="text" name="name" value="{{$data->name ?? ''}}" required
                                    class="form-control" id="name" placeholder="Masukkan nama">
                            </div>
                        </div>
                        <div class="mb-3 col-md-12">
                            <label class="form-label" for="userpassword">Email</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                <input type="email" name="email" value="{{$data->email ?? ''}}" class="form-control"
                                    required id="name" placeholder="Masukkan email">
                            </div>
                        </div>
                        <div class="mb-3 col-md-12">
                            <label class="form-label" for="userpassword">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                <input type="password" minlength="8" name="password" {{$data != null ? '':'required'}} class="form-control"
                                    id="userpassword" placeholder="Enter password">
                                <button class="btn btn-outline-secondary text-dark" type="button" id="togglePassword">
                                    <i class="fa fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        <div class="mb-3 col-md-12">
                            <label class="form-label" for="confirmpassword">Confirm Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                <input type="password" minlength="8" name="confirm_password" {{$data != null ? '':'required'}} class="form-control"
                                    id="confirmpassword" placeholder="Enter password">
                                <button class="btn btn-outline-secondary text-dark" type="button" id="confirmTogglePassword">
                                    <i class="fa fa-eye"></i>
                                </button>
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

@push('script')
<script src="{{asset('assets/js/pages/form-advanced.init.js')}}"></script>

<script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        var passwordInput = document.getElementById('userpassword');
        var toggleButton = document.getElementById('togglePassword');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleButton.innerHTML = '<i class="fa fa-eye-slash"></i>';
        } else {
            passwordInput.type = 'password';
            toggleButton.innerHTML = '<i class="fa fa-eye"></i>';
        }
    });
    document.getElementById('confirmTogglePassword').addEventListener('click', function () {
        var passwordInput = document.getElementById('confirmpassword');
        var toggleButton = document.getElementById('confirmTogglePassword');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleButton.innerHTML = '<i class="fa fa-eye-slash"></i>';
        } else {
            passwordInput.type = 'password';
            toggleButton.innerHTML = '<i class="fa fa-eye"></i>';
        }
    });

</script>
@endpush
