@extends('adminlte::page')

@section('title', 'Edit Dokter')

@section('content_header')
    <h1 class="m-0 text-dark">Edit Dokter</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Identitas Dokter</h3>
                </div>
                {!! Form::model($dokter, ['method' => 'PATCH', 'route' => ['admin.dokter.update', $dokter->id], 'files' => true]) !!}
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger col-md-12">
                            <strong>Whoops!</strong> Ada kesalahan input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="iNIK">NIK</label>
                                {!! Form::text('nik', $dokter->user->nik, ['class' => 'form-control' . ($errors->has('nik') ? ' is-invalid' : ''), 'id' => 'iNIK', 'placeholder' => 'NIK', 'autofocus', 'required']) !!}
                            </div>
                            <div class="form-group">
                                <label for="iNama">Nama</label>
                                {!! Form::text('name', $dokter->user->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'id' => 'iNama', 'placeholder' => 'Nama', 'required']) !!}
                            </div>
                            <div class="form-group">
                                <label for="iTempatLahir">Tempat Tanggal Lahir</label>
                                <div class="row m-0">
                                    {!! Form::text('tempat_lahir', $dokter->user->tempat_lahir, ['class' => 'form-control  col-md-6 ' . ($errors->has('tempat_lahir') ? ' is-invalid' : ''), 'id' => 'iTempatLahir', 'placeholder' => 'Tempat Lahir', 'required']) !!}
                                    {!! Form::date('tanggal_lahir', \Carbon\Carbon::parse($dokter->user->tanggal_lahir), ['class' => 'form-control col-md-6']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="iGender">Jenis Kelamin</label>
                                <div class="custom-control custom-radio">
                                    {!! Form::radio('gender', 'Laki-laki', $dokter->user->gender == 'Laki-laki', ['class' => 'custom-control-input', 'id' => 'gender1']) !!}
                                    <label for="gender1" class="custom-control-label">Laki-Laki</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    {!! Form::radio('gender', 'Perempuan', $dokter->user->gender == 'Perempuan', ['class' => 'custom-control-input', 'id' => 'gender2']) !!}
                                    <label for="gender2" class="custom-control-label">Perempuan</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="province_id" class="form-label">Provinsi</label>
                                {!! Form::select('province_id', $provinces, $dokter->user->province_id, ['id' => 'province_id', 'class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                <label for="city_id" class="form-label">Kabupaten / Kota</label>
                                {!! Form::select('city_id', $cities, $dokter->user->city_id, ['id' => 'city_id', 'class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                <label for="district_id" class="form-label">Kecamatan</label>
                                {!! Form::select('district_id', $districts, $dokter->user->district_id, ['id' => 'district_id', 'class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                <label for="village_id" class="form-label">Desa / Kelurahan</label>
                                {!! Form::select('village_id', $villages, $dokter->user->village_id, ['id' => 'village_id', 'class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputPhone">Nomor Telephone</label>
                                {!! Form::text('phone', $dokter->user->phone, ['class' => 'form-control' . ($errors->has('phone') ? ' is-invalid' : ''), 'id' => 'inputPhone', 'placeholder' => 'Nomor Telephone', 'required']) !!}
                            </div>
                            <div class="form-group">
                                <label for="inputEmail">Email</label>
                                {!! Form::email('email', $dokter->user->email, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'id' => 'inputEmail', 'placeholder' => 'Email', 'required']) !!}
                            </div>
                            <div class="form-group">
                                <label for="inputUsername">Username</label>
                                {!! Form::text('username', $dokter->user->username, ['class' => 'form-control' . ($errors->has('username') ? ' is-invalid' : ''), 'id' => 'inputUsername', 'placeholder' => 'Username', 'required']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="iAgama">Agama</label>
                                {!! Form::select('agama', $agamas, $dokter->user->agama, ['class' => 'form-control' . ($errors->has('agama') ? ' is-invalid' : ''), 'id' => 'iAgama', 'placeholder' => 'Pilih Agama', 'required']) !!}
                            </div>
                            <div class="form-group">
                                <label for="iKawin">Status Perkawinan</label>
                                {!! Form::select('status_kawin', $kawin, $dokter->user->status_kawin, ['class' => 'form-control' . ($errors->has('kawin') ? ' is-invalid' : ''), 'id' => 'iKawin', 'placeholder' => 'Pilih Status Kawin', 'required']) !!}
                            </div>
                            <div class="form-group">
                                <label for="iPekerjaan">Pekerjaan</label>
                                {!! Form::text('pekerjaan', $dokter->user->pekerjaan, ['class' => 'form-control' . ($errors->has('pekerjaan') ? ' is-invalid' : ''), 'id' => 'iPekerjaan', 'placeholder' => 'Pekerjaan', 'required']) !!}
                            </div>
                            <div class="form-group">
                                <label for="iKewarganegaraan">Kewarganegaraan</label>
                                {!! Form::text('kewarganegaraan', $dokter->user->kewarganegaraan, ['class' => 'form-control' . ($errors->has('kewarganegaraan') ? ' is-invalid' : ''), 'id' => 'iKewarganegaraan', 'placeholder' => 'Kewarganegaraan', 'required']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-check">
                        {{-- <input type="checkbox"> --}}
                        {!! Form::checkbox('cek', 1, null, ['class' => 'form-check-input', 'required', 'id' => 'exampleCheck1']) !!}
                        <label class="form-check-label" for="exampleCheck1">Dengan ini menyatakan data telah sesuai</label>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
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
