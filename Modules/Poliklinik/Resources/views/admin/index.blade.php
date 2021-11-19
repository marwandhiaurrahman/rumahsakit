@extends('adminlte::page')

@section('title', 'Poliklinik')

@section('content_header')
    <h1 class="m-0 text-dark">Poliklinik</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="row">
                {{-- <div class="col-lg-3 col-6">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>{{ $dokters->count() }}</h3>
                            <p>Poliklinik Aktif</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-md"></i>
                        </div>
                        @can('admin-role')
                            <a href="#" class="small-box-footer" data-toggle="modal" data-target="#createModal">
                                Informasi Poliklinik Aktif <i class="fas fa-info-circle"></i>
                            </a>
                        @endcan
                    </div>
                </div> --}}
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $dokters->count() }}</h3>
                            <p>Poliklinik Terdaftar</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        @can('admin-role')
                            <a href="#" class="small-box-footer" data-toggle="modal" data-target="#createModal">
                                Daftarkan Poliklinik Baru <i class="fas fa-plus-circle"></i>
                            </a>
                        @endcan
                    </div>
                </div>
            </div>
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Tabel Data Poliklinik Terdaftar</h3>
                </div>
                <div class="card-body">
                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="example1" class="table table-bordered table-striped dataTable dtr-inline"
                                    role="grid" aria-describedby="example1_info">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Name</th>
                                            <th>Dokter</th>
                                            <th>Status</th>
                                            <th>Antrian</th>
                                            <th>Total Pelayanan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($polikliniks as $item)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $item->kode }} - {{ $item->name }}</td>
                                                <td>{{ $item->dokter->user->name }}</td>
                                                <td>
                                                    @if ($item->status)
                                                        <label class="badge badge-success">Aktif</label>
                                                    @else
                                                        <label class="badge badge-success">Non-Aktif</label>
                                                    @endif
                                                </td>
                                                <td>{{ $item->perawatans }}</td>
                                                <td>{{ $item->status }}</td>
                                                <td>{{ $item->status }}</td>
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
                    <h5 class="modal-title" id="createModalLabel">Daftar Poliklinik Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!! Form::open(['route' => 'admin.poliklinik.store', 'method' => 'POST', 'files' => true]) !!}
                <div class="modal-body">
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
                    <div class="form-group">
                        <label for="iKode">Kode</label>
                        {!! Form::text('kode', null, ['class' => 'form-control' . ($errors->has('kode') ? ' is-invalid' : ''), 'id' => 'iKode', 'placeholder' => 'Kode', 'autofocus', 'required']) !!}
                    </div>
                    <div class="form-group">
                        <label for="iNama">Nama</label>
                        {!! Form::text('name', null, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'id' => 'iNama', 'placeholder' => 'Nama Poliklinik', 'required']) !!}
                    </div>
                    <div class="form-group">
                        <label for="iDokter" class="form-label">Dokter</label>
                        <select name="dokter_id" id="iDokter" class="form-control">
                            <option value="">Pilih Dokter</option>
                            @foreach ($dokters as $item)
                                <option value="{{ $item->id }}">{{ $item->kode }} {{ $item->user->name }}
                                </option>
                            @endforeach
                        </select>
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
