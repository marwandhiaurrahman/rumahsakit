@extends('adminlte::page')

@section('title', 'Detail Rawat Jalan')

@section('content_header')
    <h1 class="m-0 text-dark">Detail Rawat Jalan</h1>
@stop

@section('content')
    {!! Form::model($perawatan, ['method' => 'PATCH', 'route' => ['pasien.rawat-jalan.update', $perawatan->id], 'files' => true]) !!}
    <div class="row">
        <div class="col-md-6">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Data Rawat Jalan</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <dl>
                                <dt>Kode</dt>
                                <dd>
                                    <h6>{{ $perawatan->kode }}</h6>
                                </dd>
                                <dt>Tanggal</dt>
                                <dd>
                                    <h6>
                                        {{ Carbon\Carbon::parse($perawatan->tanggal)->format('D, d F Y') }}
                                    </h6>
                                </dd>
                            </dl>
                        </div>
                        <div class="col-md-6">
                            <dl>
                                <dt>Poliklinik</dt>
                                <dd>
                                    <h6>{{ $perawatan->poliklinik->name }}</h6>
                                </dd>
                                <dt>Status</dt>
                                <dd>
                                    <h6>
                                        @if ($perawatan->status == 0)
                                            <label class="badge badge-danger">Menunggu antrian</label>
                                        @endif
                                        @if ($perawatan->status == 1)
                                            <label class="badge badge-warning">Pengecekan oleh dokter</label>
                                        @endif
                                        @if ($perawatan->status == 2)
                                            <label class="badge badge-warning">Pembayaran obat</label>
                                        @endif
                                        @if ($perawatan->status == 3)
                                            <label class="badge badge-warning">Penyiapan obat</label>
                                        @endif
                                        @if ($perawatan->status == 4)
                                            <label class="badge badge-success">Pengambilan obat</label>
                                        @endif
                                        @if ($perawatan->status == 5)
                                            <label class="badge badge-success">Selesai</label>
                                        @endif
                                    </h6>
                                </dd>
                            </dl>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="iKeluhan">Keluhan</label>
                                {!! Form::textarea('keluhan', $perawatan->keluhan, ['class' => 'form-control', 'id' => 'iKeluhan', 'rows' => '5']) !!}
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
                        <dd class="col-sm-10">{{ $perawatan->pasien->kode }}</dd>
                        <dt class="col-sm-2">NIK</dt>
                        <dd class="col-sm-10">{{ $perawatan->pasien->user->nik }}</dd>
                        <dt class="col-sm-2">Nama</dt>
                        <dd class="col-sm-10">{{ $perawatan->pasien->user->name }}</dd>
                        <dt class="col-sm-2">TTL</dt>
                        <dd class="col-sm-10">{{ $perawatan->pasien->user->tempat_lahir }},
                            {{ Carbon\Carbon::parse($perawatan->pasien->user->tanggal_lahir)->format('y F Y') }}</dd>
                        <dt class="col-sm-2">Umur</dt>
                        <dd class="col-sm-10">
                            {{ Carbon\Carbon::parse($perawatan->pasien->user->tanggal_lahir)->diffInYears(Carbon\Carbon::now()) }}
                            tahun</dd>
                        <dt class="col-sm-2">Status</dt>
                        <dd class="col-sm-10">{{ $perawatan->pasien->user->status_kawin }}</dd>
                    </dl>
                </div>
            </div>
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Data Dokter</h3>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-2">Nama</dt>
                        <dd class="col-sm-10">{{ $perawatan->dokter->user->name }}</dd>
                        <dt class="col-sm-2">Spesialis</dt>
                        <dd class="col-sm-10">Poli {{ $perawatan->poliklinik->name }}</dd>
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
                                    {!! Form::textarea('analisis', null, ['class' => 'form-control' . ($errors->has('cek') ? ' is-invalid' : ''), 'id' => 'iAnalisis', 'rows' => '3', 'disabled', 'placeholder' => 'Hasil Analisis Dokter']) !!}
                                </div>
                                {{-- </div> --}}
                                @can(['admin-role'])
                                    <a href="#" class="btn btn-primary btn-xs mb-3" data-toggle="modal"
                                        data-target="#createObat">Tambah Obat</a>
                                    <a href="" class="btn btn-success btn-xs mb-3">Konfirmasi Resep Obat</a>
                                @endcan
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
                                        @foreach ($reseps as $item)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $item->obat->name }}</td>
                                                <td>{{ $item->dosis }}</td>
                                                <td>{{ $item->obat->manfaat }}<br>{{ $item->keterangan }}</td>
                                                <td>@ {{ $item->stok }} x {{ money($item->harga, 'IDR') }}</td>
                                                <td>{{ money($item->stok * $item->harga, 'IDR') }}</td>
                                                <td>
                                                    @if ($item->status == 0)
                                                        <label class="badge badge-danger">Menunggu konfirmasi dokter</label>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.resep-obat.destroy', $item->id) }}"
                                                        class="btn btn-xs btn-danger"
                                                        onclick="return confirm('Are you sure you want to delete this item ?')"
                                                        data-toggle="tooltip" title="Hapus {{ $item->name }}"
                                                        data-method="delete">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="5">
                                                Total
                                            </th>
                                            <th>
                                                {{ $reseps->sum('harga') }}
                                            </th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
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
                        <label for="iCek" class="custom-control-label">Dengan ini saya menyatakan data saya sudah
                            sesuai</label>
                    </div>
                    <button type="submit" class="btn btn-success mt-2">Update</button>
                    <a href="{{ route('pasien.rawat-jalan.index') }}" class="btn btn-default mt-2">Kembali</a>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
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
                // "buttons": ["excel", "pdf", "print", "colvis"],
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection
