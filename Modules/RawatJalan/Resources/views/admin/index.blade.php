@extends('adminlte::page')

@section('title', 'Rawat Jalan')

@section('content_header')
    <h1 class="m-0 text-dark">Rawat Jalan</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $dokters->count() }}</h3>
                            <p>Pasien Rawat Jalan</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        @can('admin-role')
                            <a href="#" class="small-box-footer" data-toggle="modal" data-target="#createModal">
                                Daftar Rawat Jalan <i class="fas fa-plus-circle"></i>
                            </a>
                        @endcan
                    </div>
                </div>
            </div>
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Tabel Data Rawat Jalan</h3>
                </div>
                <div class="card-body">
                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="example1" class="table table-bordered table-striped dataTable dtr-inline"
                                    role="grid" aria-describedby="example1_info">
                                    <thead>
                                        <tr>
                                            <th>No. Regis</th>
                                            <th>Nama Pasien</th>
                                            <th>Umur</th>
                                            <th>Poliklinik</th>
                                            <th>Dokter</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dokters as $item)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $item->user->name }}</td>
                                                <td>{{ $item->spesialis }}</td>
                                                <td>{{ Carbon\Carbon::parse($item->user->tanggal_lahir)->diffInYears(Carbon\Carbon::now()) }}
                                                    tahun</td>
                                                <td>{{ $item->user->gender }}</td>
                                                <td>
                                                    @empty(!$item->desa && !$item->kecamatan && !$item->kabupaten)
                                                        {{ $item->desa->name }} ,
                                                        {{ $item->kecamatan->name }} ,
                                                        {{ $item->kabupaten->name }}
                                                    @endempty
                                                </td>
                                                <td>
                                                    @if ($item->status)
                                                        <label class="badge badge-success">Aktif</label>
                                                    @else
                                                        <label class="badge badge-success">Non-Aktif</label>
                                                    @endif
                                                </td>
                                                <td>
                                                    <form action="{{ route('admin.user.destroy', $item) }}"
                                                        method="POST">
                                                        @can('admin-role')
                                                            <a class="btn btn-xs btn-warning"
                                                                href="{{ route('admin.user.edit', $item) }}"
                                                                data-toggle="tooltip" title="Edit {{ $item->name }}"><i
                                                                    class=" fas fa-edit"></i></a>
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-xs btn-danger"
                                                                data-toggle="tooltip" title="Hapus {{ $item->name }}">
                                                                <i class="fas fa-trash-alt"
                                                                    onclick="return confirm('Are you sure you want to delete this item ?')"></i>
                                                            </button>
                                                        @endcan
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title" id="createModalLabel">Daftar Dokter Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!! Form::open(['route' => 'admin.dokter.store', 'method' => 'POST', 'files' => true]) !!}
                <div class="modal-body">
                    <div class="row">
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
                                        {!! Form::select('agama', $agamas, null, ['class' => 'form-control' . ($errors->has('agama') ? ' is-invalid' : ''), 'id' => 'iAgama', 'placeholder' => 'Pilih Agama']) !!}
                                    </div>
                                    <div class="form-group">
                                        <label for="iKawin">Status Perkawinan</label>
                                        {!! Form::select('status_kawin', $kawin, null, ['class' => 'form-control' . ($errors->has('kawin') ? ' is-invalid' : ''), 'id' => 'iKawin', 'placeholder' => 'Pilih Status Kawin']) !!}
                                    </div>
                                    <div class="form-group">
                                        <label for="iPekerjaan">Dokter Spesialis</label>
                                        {!! Form::select('pekerjaan', $spesialis, null, ['class' => 'form-control' . ($errors->has('pekerjaan') ? ' is-invalid' : ''), 'id' => 'iPekerjaan', 'placeholder' => 'Pilih Dokter Spesialis']) !!}
                                    </div>
                                    <div class="form-group">
                                        <label for="iKewarganegaraan">Kewarganegaraan</label>
                                        {!! Form::text('kewarganegaraan', null, ['class' => 'form-control' . ($errors->has('kewarganegaraan') ? ' is-invalid' : ''), 'id' => 'iKewarganegaraan', 'placeholder' => 'Kewarganegaraan']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Submit</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop

@section('plugins.Datatables', true)

@section('js')
    <script type="text/javascript">
        @if ($errors->any())
            $('#createModal').modal('show');
        @endif
    </script>

    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["excel", "pdf", "print", "colvis"],
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>

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
