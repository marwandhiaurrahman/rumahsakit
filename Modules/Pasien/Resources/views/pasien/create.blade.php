@extends('adminlte::auth.auth-page', ['auth_type' => 'register'])

@php($login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login'))
@php($register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register'))

@if (config('adminlte.use_route_url', false))
    @php($login_url = $login_url ? route($login_url) : '')
    @php($register_url = $register_url ? route($register_url) : '')
@else
    @php($login_url = $login_url ? url($login_url) : '')
    @php($register_url = $register_url ? url($register_url) : '')
@endif

@section('auth_header', __('adminlte::adminlte.register_message'))
@section('auth_body')
    <form action="{{ route('pasien.store') }}" method="post">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-6">
                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title">Identitas Diri</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="iNIK">NIK</label>
                            {!! Form::text('nik', null, ['class' => 'form-control' . ($errors->has('nik') ? ' is-invalid' : ''), 'id' => 'iNIK', 'placeholder' => 'NIK', 'autofocus', 'required']) !!}
                        </div>
                        <div class="form-group">
                            <label for="iNama">Nama</label>
                            {!! Form::text('name', null, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'id' => 'iNama', 'placeholder' => 'Nama', 'required']) !!}
                        </div>
                        <div class="form-group">
                            <label for="iTempatLahir">Tempat Tanggal Lahir</label>
                            <div class="row m-0">
                                {!! Form::text('tempat_lahir', null, ['class' => 'form-control  col-md-6 ' . ($errors->has('tempat_lahir') ? ' is-invalid' : ''), 'id' => 'iTempatLahir', 'placeholder' => 'Tempat Lahir', 'required']) !!}
                                {!! Form::date('tanggal_lahir', \Carbon\Carbon::now(), ['class' => 'form-control col-md-6']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="iGender">Jenis Kelamin</label>
                            <div class="custom-control custom-radio">
                                {!! Form::radio('gender', 'Laki-laki', null, ['class' => 'custom-control-input', 'id' => 'gender1']) !!}
                                <label for="gender1" class="custom-control-label">Laki-Laki</label>
                            </div>
                            <div class="custom-control custom-radio">
                                {!! Form::radio('gender', 'Perempuan', null, ['class' => 'custom-control-input', 'id' => 'gender2']) !!}
                                <label for="gender2" class="custom-control-label">Perempuan</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title">Alamat</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="province_id" class="form-label">Provinsi</label>
                            <select name="province_id" id="province_id" class="form-control">
                                <option value="">Pilih Provinsi</option>
                                @foreach ($provinces as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="city_id" class="form-label">Kabupaten / Kota</label>
                            <select name="city_id" id="city_id" class="form-control">
                                <option value="">Pilih Kabupaten / Kota</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="district_id" class="form-label">Kecamatan</label>
                            <select name="district_id" id="district_id" class="form-control">
                                <option value="">Pilih Kecamatan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="village_id" class="form-label">Desa / Kelurahan</label>
                            <select name="village_id" id="village_id" class="form-control">
                                <option value="">Pilih Desa / Kelurahan</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title">Informasi Akun</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputPhone">Nomor Telephone</label>
                            {!! Form::text('phone', null, ['class' => 'form-control' . ($errors->has('phone') ? ' is-invalid' : ''), 'id' => 'inputPhone', 'placeholder' => 'Nomor Telephone', 'required']) !!}
                        </div>
                        <div class="form-group">
                            <label for="inputEmail">Email</label>
                            {!! Form::email('email', null, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'id' => 'inputEmail', 'placeholder' => 'Email', 'required']) !!}
                        </div>
                        <div class="form-group">
                            <label for="inputUsername">Username</label>
                            {!! Form::text('username', null, ['class' => 'form-control' . ($errors->has('username') ? ' is-invalid' : ''), 'id' => 'inputUsername', 'placeholder' => 'Username', 'required']) !!}
                        </div>
                        <div class="form-group">
                            <label for="inputPassword">Password</label>
                            {!! Form::password('password', ['class' => 'form-control' . ($errors->has('password') ? ' is-invalid' : ''), 'id' => 'inputPassword', 'placeholder' => 'Password', 'required']) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title">Informasi Status</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="iAgama">Agama</label>
                            {!! Form::select('agama', $agamas, null, ['class' => 'form-control' . ($errors->has('agama') ? ' is-invalid' : ''), 'id' => 'iAgama', 'placeholder' => 'Pilih Agama', 'required']) !!}
                        </div>
                        <div class="form-group">
                            <label for="iKawin">Status Perkawinan</label>
                            {!! Form::select('status_kawin', $kawin, null, ['class' => 'form-control' . ($errors->has('kawin') ? ' is-invalid' : ''), 'id' => 'iKawin', 'placeholder' => 'Pilih Status Kawin', 'required']) !!}
                        </div>
                        <div class="form-group">
                            <label for="iPekerjaan">Pekerjaan</label>
                            {!! Form::text('pekerjaan', null, ['class' => 'form-control' . ($errors->has('pekerjaan') ? ' is-invalid' : ''), 'id' => 'iPekerjaan', 'placeholder' => 'Pekerjaan', 'required']) !!}
                        </div>
                        <div class="form-group">
                            <label for="iKewarganegaraan">Kewarganegaraan</label>
                            {!! Form::text('kewarganegaraan', null, ['class' => 'form-control' . ($errors->has('kewarganegaraan') ? ' is-invalid' : ''), 'id' => 'iKewarganegaraan', 'placeholder' => 'Kewarganegaraan', 'required']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Register button --}}
        <button type="submit" class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
            <span class="fas fa-user-plus"></span>
            {{ __('adminlte::adminlte.register') }}
        </button>
    </form>
@stop


@section('auth_footer')
    <p class="my-0">
        <a href="{{ $login_url }}">
            {{ __('adminlte::adminlte.i_already_have_a_membership') }}
        </a>
    </p>
@stop

@section('js')
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#province_id').on('change', function() {
                $.ajax({
                    url: '{{ route('dependent-dropdown.store') }}',
                    method: 'POST',
                    data: {
                        id: $(this).val()
                    },
                    success: function(response) {
                        $('#city_id').empty();

                        $.each(response, function(id, name) {
                            $('#city_id').append(new Option(name, id))
                        })
                    }
                })
            });
            $('#city_id').on('change', function() {
                $.ajax({
                    url: '{{ route('dependent-dropdown.kecamatan') }}',
                    method: 'POST',
                    data: {
                        id: $(this).val()
                    },
                    success: function(response) {
                        $('#district_id').empty();

                        $.each(response, function(id, name) {
                            $('#district_id').append(new Option(name, id))
                        })
                    }
                })
            });
            $('#district_id').on('change', function() {
                $.ajax({
                    url: '{{ route('dependent-dropdown.desa') }}',
                    method: 'POST',
                    data: {
                        id: $(this).val()
                    },
                    success: function(response) {
                        $('#village_id').empty();

                        $.each(response, function(id, name) {
                            $('#village_id').append(new Option(name, id))
                        })
                    }
                })
            });
        });
    </script>
@endsection
