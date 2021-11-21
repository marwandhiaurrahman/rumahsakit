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
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $perawatans->where('status', 0)->count() }}</h3>
                            <p>Antrian Pasien</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-injured"></i>
                        </div>
                        {{-- @can('admin-role') --}}
                        <a href="#" class="small-box-footer">
                            Antrian Pasien Rawat Jalan <i class="fas fa-info-circle"></i>
                        </a>
                        {{-- @endcan --}}
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $perawatans->count() }}</h3>
                            <p>Pasien Rawat Jalan</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        @can('admin-role')
                            <a href="#" class="small-box-footer" data-toggle="modal" data-target="#createModal">
                                Daftarkan Pasien Rawat Jalan <i class="fas fa-plus-circle"></i>
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
                                            <th>No.</th>
                                            <th>Kode Regis</th>
                                            <th>Tanggal</th>
                                            <th>Nama Pasien</th>
                                            <th>Dokter - Poliklinik</th>
                                            <th>Status Resep</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($perawatans as $item)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $item->kode }}</td>
                                                <td>{{ Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
                                                <td>{{ $item->pasien->user->name }}</td>
                                                <td>{{ $item->dokter->user->name }} <br>{{ $item->poliklinik->name }}
                                                </td>
                                                <td>
                                                    @if ($item->reseps->count())
                                                        @if ($item->reseps->first()->status == 0)
                                                            <label class="badge badge-danger">Menunggu konfirmasi
                                                                dokter</label>
                                                        @endif
                                                        @if ($item->reseps->first()->status == 1)
                                                            <label class="badge badge-warning">Menyiapkan obat</label>
                                                        @endif
                                                        @if ($item->reseps->first()->status == 2)
                                                            <label class="badge badge-success">Pengambilan obat</label>
                                                        @endif
                                                        @if ($item->reseps->first()->status == 3)
                                                            <label class="badge badge-success">Selesai</label>
                                                        @endif
                                                        <br>
                                                        @foreach ($item->reseps as $obat)
                                                            -{{ $obat->name }} {{ $obat->stok }}
                                                            {{ $obat->obat->satuan }} <br>
                                                        @endforeach
                                                    @else
                                                        Tanpa obat
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($item->status == 0)
                                                        <label class="badge badge-danger">Menunggu antrian</label>
                                                    @endif
                                                    @if ($item->status == 1)
                                                        <label class="badge badge-warning">Pengecekan oleh dokter</label>
                                                    @endif
                                                    @if ($item->status == 2)
                                                        <label class="badge badge-warning">Pembayaran obat</label>
                                                    @endif
                                                    @if ($item->status == 3)
                                                        <label class="badge badge-warning">Penyiapan obat</label>
                                                    @endif
                                                    @if ($item->status == 4)
                                                        <label class="badge badge-success">Pengambilan obat</label>
                                                    @endif
                                                    @if ($item->status == 5)
                                                        <label class="badge badge-success">Selesai</label>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a class="btn btn-xs btn-warning"
                                                        href="{{ route('admin.apotek.edit', $item->id) }}"
                                                        data-toggle="tooltip" title="Edit {{ $item->kode }}"><i
                                                            class=" fas fa-edit"></i></a>
                                                    {{-- <a href="{{ route('admin.apotek.destroy', $item->id) }}"
                                                        class="btn btn-xs btn-danger"
                                                        onclick="return confirm('Are you sure you want to delete this item ?')"
                                                        data-toggle="tooltip" title="Hapus {{ $item->name }}"
                                                        data-method="delete">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a> --}}
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
    {{-- <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title" id="createModalLabel">Daftar Rawat Jalan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!! Form::open(['route' => 'admin.rawat-jalan.store', 'method' => 'POST', 'files' => true]) !!}
                <div class="modal-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> Ada kesalahan input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card card-warning">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="iTanggal">Tanggal Rawat Jalan</label>
                                        {!! Form::date('tanggal', \Carbon\Carbon::now(), ['class' => 'form-control', 'id' => 'iTanggal']) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="iPoliklinik" class="form-label">Poliklinik</label>
                                        <select name="poliklinik_id" class="form-control" id='iPoliklinik'>
                                            <option value="">Pilih Polikinik</option>
                                            @foreach ($polikliniks as $item)
                                                <option value="{{ $item->id }}">{{ $item->kode }} -
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="pasien_id" class="form-label">Pasien</label>
                                        <select name="pasien_id" id="pasien_id" class="form-control">
                                            <option value="">Pilih Pasien</option>
                                            @foreach ($pasiens as $item)
                                                <option value="{{ $item->id }}">{{ $item->kode }} -
                                                    {{ Carbon\Carbon::parse($item->user->tanggal_lahir)->diffInYears(Carbon\Carbon::now()) }}
                                                    th -
                                                    {{ $item->user->name }} - {{ $item->user->desa->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="iSpesialis">Keluhan</label>
                                        {!! Form::textarea('keluhan', null, ['class' => 'form-control', 'id' => 'iSpesialis', 'rows' => '3']) !!}
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
    </div> --}}
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
@endsection
