@extends('adminlte::page')

@section('title', 'Transaksi')

@section('content_header')
    <h1 class="m-0 text-dark">Transaksi</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $transaksis->where('status', 0)->count() }}</h3>
                            <p>Transaksi Belum Tervalidasi</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-money-check-alt"></i>
                        </div>
                        {{-- @can('admin-role') --}}
                        <a href="#" class="small-box-footer">
                            Transaksi Belum Tervalidasi <i class="fas fa-info-circle"></i>
                        </a>
                        {{-- @endcan --}}
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $transaksis->count() }}</h3>
                            <p>Total Transaksi</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-money-check-alt"></i>
                        </div>
                        @can('admin-role')
                            <a href="#" class="small-box-footer" data-toggle="modal" data-target="#createModal">
                                Total Transaksi <i class="fas fa-info-circle"></i>
                            </a>
                        @endcan
                    </div>
                </div>
            </div>
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Tabel Transaksi</h3>
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
                                            <th>Keterangan</th>
                                            <th>Debit</th>
                                            <th>Kredit</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($transaksis as $item)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $item->kode }}</td>
                                                <td>{{ $item->created_at }}</td>
                                                <td>{{ $item->perawatan->pelayanan }} Poli
                                                    {{ $item->perawatan->poliklinik->name }}<br>
                                                    {{ $item->perawatan->pasien->user->name }}
                                                </td>
                                                @if ($item->tipe == 'Debit')
                                                    <td>{{ money($item->harga, 'IDR') }}</td>
                                                    <td></td>
                                                @endif
                                                @if ($item->tipe == 'Kredit')
                                                    <td></td>
                                                    <td>{{ money($item->harga, 'IDR') }}</td>
                                                @endif
                                                <td>
                                                    @if ($item->status == 0)
                                                        <label class="badge badge-danger">Belum valid</label>
                                                    @endif
                                                    @if ($item->status == 1)
                                                        <label class="badge badge-success">Selesai</label>
                                                    @endif
                                                    @if ($item->status == 2)
                                                        <label class="badge badge-danger">Gagal</label>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a class="btn btn-xs btn-warning"
                                                        href="{{ route('admin.transaksi.edit', $item->id) }}"
                                                        data-toggle="tooltip" title="Edit {{ $item->id }}"><i
                                                            class=" fas fa-edit"></i></a>
                                                    {{-- <a href="{{ route('admin.rawat-jalan.destroy', $item->id) }}"
                                                        class="btn btn-xs btn-danger"
                                                        onclick="return confirm('Are you sure you want to delete this item ?')"
                                                        data-toggle="tooltip" title="Hapus {{ $item->name }}"
                                                        data-method="delete">
                                                        <i class="fas fa-trash-alt"></i> --}}
                                                    </a>
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
