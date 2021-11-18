@extends('adminlte::page')

@section('title', 'Detail Rawat Jalan')

@section('content_header')
    <h1 class="m-0 text-dark">Detail Rawat Jalan</h1>
@stop

@section('content')
    {!! Form::model($perawatan, ['method' => 'PATCH', 'route' => ['admin.rawat-jalan.update', $perawatan->kode], 'files' => true]) !!}
    <div class="row">
        <div class="col-md-12">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Data Rawat Jalan</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="iKode">Kode Registrasi</label>
                                {!! Form::text('kode', $perawatan->kode, ['class' => 'form-control', 'id' => 'iKode', 'disabled', 'placeholder' => 'Masukan Kode']) !!}
                            </div>
                            <div class="form-group">
                                <label for="iTanggal">Tanggal</label>
                                {!! Form::date('tanggal', $perawatan->tanggal, ['class' => 'form-control', 'id' => 'iTanggal']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="iSpesialis">Poliklinik</label>
                                {!! Form::select('spesialis', $spesialis, $perawatan->spesialis, ['class' => 'form-control', 'id' => 'iSpesialis']) !!}
                            </div>
                            <div class="form-group">
                                <label for="iStatus">Status</label>
                                {!! Form::select('status', $status, $perawatan->status, ['class' => 'form-control', 'id' => 'iStatus']) !!}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="iKeluhan">Keluhan</label>
                                {!! Form::textarea('keluhan', $perawatan->keluhan, ['class' => 'form-control', 'id' => 'iKeluhan', 'rows' => '3']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Data Pasien</h3>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-2">Kode</dt>
                        <dd class="col-sm-10">123123123</dd>
                        <dt class="col-sm-2">NIK</dt>
                        <dd class="col-sm-10">1234123412341234</dd>
                        <dt class="col-sm-2">Nama</dt>
                        <dd class="col-sm-10">Marwan Dhiaur Rahman</dd>
                        <dt class="col-sm-2">TTL</dt>
                        <dd class="col-sm-10">Cirebon, 9 Mei 1998</dd>
                        <dt class="col-sm-2">Umur</dt>
                        <dd class="col-sm-10">23 Tahun</dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Data Dokter</h3>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-2">Kode</dt>
                        <dd class="col-sm-10">123123123</dd>
                        <dt class="col-sm-2">NIK</dt>
                        <dd class="col-sm-10">1234123412341234</dd>
                        <dt class="col-sm-2">Nama</dt>
                        <dd class="col-sm-10">Marwan Dhiaur Rahman</dd>
                        <dt class="col-sm-2">TTL</dt>
                        <dd class="col-sm-10">Cirebon, 9 Mei 1998</dd>
                        <dt class="col-sm-2">Umur</dt>
                        <dd class="col-sm-10">23 Tahun</dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Tabel Resep Dokter</h3>
                </div>
                <div class="card-body">
                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
                                {{-- <div class="col-md-12"> --}}
                                <div class="form-group">
                                    <label for="iAnalisis">Analisis Dokter</label>
                                    {!! Form::textarea('analisis', null, ['class' => 'form-control' . ($errors->has('cek') ? ' is-invalid' : ''), 'id' => 'iAnalisis', 'rows' => '3', 'required', 'placeholder' => 'Masukan Hasil Analisis Dokter']) !!}
                                </div>
                                {{-- </div> --}}
                                <a href="#" class="btn btn-primary btn-xs mb-3" data-toggle="modal"
                                    data-target="#createObat">Tambah Obat</a>
                                <table id="example1" class="table table-bordered table-striped dataTable dtr-inline"
                                    role="grid" aria-describedby="example1_info">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Obat</th>
                                            <th>Dosis</th>
                                            <th>Keterangan</th>
                                            <th>Satuan x Harga</th>
                                            <th>Jumlah</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($reseps->getContent() as $item)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->attributes->dosis }}</td>
                                                <td>{{ $item->attributes->keterangan }}</td>
                                                <td>@ {{ $item->quantity }} x {{ money($item->price, 'IDR') }}</td>
                                                <td>{{ money($item->quantity * $item->price, 'IDR') }}</td>
                                                <td>
                                                    @if ($item->attributes->status == 0)
                                                    <label class="badge badge-danger">Menunggu Konfirmasi</label>
                                                    @endif
                                                </td>
                                                <td>delelte</td>
                                            </tr>
                                        @endforeach
                                        {{-- @foreach ($perawatans as $item)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $item->kode }}</td>
                                                <td>{{ Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
                                                <td>{{ $item->pasien->user->name }}</td>
                                                <td>{{ Carbon\Carbon::parse($item->pasien->user->tanggal_lahir)->diffInYears(Carbon\Carbon::now()) }}
                                                    tahun</td>
                                                <td>{{ $item->spesialis }}</td>
                                                <td>{{ $item->dokter->user->name }}</td>
                                                <td>
                                                    @if ($item->status == 'Menunggu antrian')
                                                        <label class="badge badge-danger">Menunggu antrian</label>
                                                    @else
                                                        <label class="badge badge-success">Non-Aktif</label>
                                                    @endif
                                                </td>
                                                <td>
                                                    <form action="{{ route('admin.user.destroy', $item) }}" method="POST">
                                                        @can('admin-role')
                                                            <a class="btn btn-xs btn-warning"
                                                                href="{{ route('admin.rawat-jalan.edit', $item->kode) }}"
                                                                data-toggle="tooltip" title="Edit {{ $item->kode }}"><i
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
                                        @endforeach --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card card-secondary">
                <div class="card-body">
                    <div class="custom-control custom-checkbox">
                        {!! Form::checkbox('cek', 1, null, ['class' => 'custom-control-input' . ($errors->has('cek') ? ' is-invalid' : ''), 'required', 'id' => 'iCek']) !!}
                        <label for="iCek" class="custom-control-label">Perawatan pasien ini telah dicek oleh Dokter</label>
                    </div>
                    <button type="submit" class="btn btn-success mt-2">Update</button>
                    <a href="{{ route('admin.rawat-jalan.index') }}" class="btn btn-default mt-2">Kembali</a>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
    <div class="modal fade" id="createObat" tabindex="-1" role="dialog" aria-labelledby="createObat" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title" id="createModalLabel">Daftar Rawat Jalan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!! Form::open(['route' => 'admin.resep-obat.store', 'method' => 'POST', 'files' => true]) !!}
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
                    {!! Form::hidden('kode', $perawatan->kode) !!}
                    <div class="form-group">
                        <label for="iObat" class="form-label">Obat</label>
                        <select name="obat_id" id="obat_id" class="form-control">
                            <option value="">Pilih Obat</option>
                            @foreach ($obats as $item)
                                <option value="{{ $item->id }}"> {{ $item->name }} ( tersedia {{ $item->stok }}
                                    {{ $item->satuan }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="iSatuan" class="form-label">Jumlah Pembelian</label>
                        {!! Form::number('stok', null, ['class' => 'form-control' . ($errors->has('stok') ? ' is-invalid' : ''), 'id' => 'iSatuan', 'required', 'placeholder' => 'Jumlah Pembelian']) !!}
                    </div>
                    <div class="form-group">
                        <label for="iDosis" class="form-label">Dosis</label>
                        {!! Form::text('dosis', null, ['class' => 'form-control' . ($errors->has('dosis') ? ' is-invalid' : ''), 'id' => 'iDosis', 'required', 'placeholder' => 'Keterangan Dosis Penggunaan']) !!}
                    </div>
                    <div class="form-group">
                        <label for="iKeterangan" class="form-label">Keterangan</label>
                        {!! Form::text('keterangan', null, ['class' => 'form-control' . ($errors->has('keterangan') ? ' is-invalid' : ''), 'id' => 'iKeterangan', 'required', 'placeholder' => 'Keterangan Dosis Penggunaan']) !!}
                    </div>
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Data Detail Obat</h3>
                        </div>
                        <div class="card-body">
                            <dl class="row">
                                <dt class="col-sm-2">Kode</dt>
                                <dd class="col-sm-10">123123123</dd>
                                <dt class="col-sm-2">NIK</dt>
                                <dd class="col-sm-10">1234123412341234</dd>
                                <dt class="col-sm-2">Nama</dt>
                                <dd class="col-sm-10">Marwan Dhiaur Rahman</dd>
                                <dt class="col-sm-2">TTL</dt>
                                <dd class="col-sm-10">Cirebon, 9 Mei 1998</dd>
                                <dt class="col-sm-2">Umur</dt>
                                <dd class="col-sm-10">23 Tahun</dd>
                            </dl>
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
            $('#createObat').modal('show');
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
