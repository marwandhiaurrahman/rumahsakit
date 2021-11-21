@extends('adminlte::page')

@section('title', 'Obat')

@section('content_header')
    <h1>Obat</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $obats->count() }}</h3>
                            <p>Obat Terdaftar</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-tablets"></i>
                        </div>
                        @can('admin-role')
                            <a href="#" class="small-box-footer" data-toggle="modal" data-target="#createModal">
                                Tambah Obat <i class="fas fa-plus-circle"></i>
                            </a>
                        @endcan
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $obats->where('stok', '>', 0)->where('stok', '<=', 10)->count() }}</h3>
                            <p>Stok Obat Terbatas</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-tablets"></i>
                        </div>
                        @can('admin-role')
                            <a href="#" class="small-box-footer">
                                Info Obat Terbatas <i class="fas fa-info-circle"></i>
                            </a>
                        @endcan
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $obats->where('stok', '==', 0)->count() }}</h3>
                            <p>Stok Obat Habis</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-tablets"></i>
                        </div>
                        @can('admin-role')
                            <a href="#" class="small-box-footer">
                                Info Obat Habis <i class="fas fa-info-circle"></i>
                            </a>
                        @endcan
                    </div>
                </div>
            </div>
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Tabel Data Obat Terdaftar</h3>
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
                                            <th>Nama</th>
                                            <th>Harga</th>
                                            <th>Manfaat</th>
                                            <th>Keterangan</th>
                                            <th>Stok</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($obats as $item)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $item->kode }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ money($item->harga, 'IDR') }}</td>
                                                <td>{{ $item->manfaat }}</td>
                                                <td>{{ $item->keterangan }}</td>
                                                <td>{{ $item->stok }} {{ $item->satuan }}</td>
                                                <td>
                                                    @if ($item->stok > 10)
                                                        <label class="badge badge-success">Stok aman</label>
                                                    @endif
                                                    @if ($item->stok <= 10 && $item->stok > 0)
                                                        <label class="badge badge-warning">Stok terbatas</label>
                                                    @endif
                                                    @if ($item->stok == 0)
                                                        <label class="badge badge-danger">Stok habis</label>
                                                    @endif
                                                </td>
                                                <td>
                                                    <form action="{{ route('admin.obat.destroy', $item->id) }}"
                                                        method="POST">
                                                        @can('admin-role')
                                                            <a class="btn btn-xs btn-warning"
                                                                href="{{ route('admin.obat.edit', $item->id) }}"
                                                                data-toggle="tooltip" title="Edit {{ $item->kode }}"><i
                                                                    class=" fas fa-edit"></i></a>
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-xs btn-danger"
                                                                onclick="return confirm('Apakah anda ingin menghapus data dengan kode {{ $item->kode }} ?')"
                                                                data-toggle="tooltip" title="Hapus {{ $item->kode }}">
                                                                <i class="fas fa-trash-alt"></i>
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
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title" id="createModalLabel">Tambah Data Obat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!! Form::open(['route' => 'admin.obat.store', 'method' => 'POST', 'files' => true]) !!}
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
                    <div class="form-group">
                        <label for="iKode">Kode</label>
                        {!! Form::text('kode', null, ['class' => 'form-control' . ($errors->has('kode') ? ' is-invalid' : ''), 'placeholder' => 'Kode*', 'required', 'id' => 'iKode']) !!}
                    </div>
                    <div class="form-group">
                        <label for="iName">Nama</label>
                        {!! Form::text('name', null, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Nama*', 'required', 'id' => 'iName']) !!}
                    </div>
                    <div class="form-group">
                        <label for="iStok">Stok</label>
                        {!! Form::number('stok', null, ['class' => 'form-control' . ($errors->has('stok') ? ' is-invalid' : ''), 'placeholder' => 'Stok*', 'required', 'id' => 'iStok']) !!}
                    </div>
                    <div class="form-group">
                        <label for="iSatuan">Satuan</label>
                        {!! Form::text('satuan', null, ['class' => 'form-control' . ($errors->has('satuan') ? ' is-invalid' : ''), 'placeholder' => 'Satuan*', 'required', 'id' => 'iSatuan']) !!}
                    </div>
                    <div class="form-group">
                        <label for="iHarga">Harga</label>
                        {!! Form::number('harga', null, ['class' => 'form-control' . ($errors->has('harga') ? ' is-invalid' : ''), 'placeholder' => 'Harga*', 'required', 'id' => 'iHarga']) !!}
                    </div>
                    <div class="form-group">
                        <label for="iManfaat">Manfaat</label>
                        {!! Form::textarea('manfaat', null, ['class' => 'form-control' . ($errors->has('manfaat') ? ' is-invalid' : ''), 'placeholder' => 'Manfaat*', 'rows' => 3, 'required', 'id' => 'iManfaat']) !!}
                    </div>
                    <div class="form-group">
                        <label for="iKeterangan">Keterangan</label>
                        {!! Form::textarea('keterangan', null, ['class' => 'form-control' . ($errors->has('keterangan') ? ' is-invalid' : ''), 'placeholder' => 'Keterangan', 'rows' => 3, 'id' => 'iKeterangan']) !!}
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
@endsection
