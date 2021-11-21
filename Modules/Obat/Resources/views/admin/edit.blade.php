@extends('adminlte::page')

@section('title', 'Edit Obat')

@section('content_header')
    <h1 class="m-0 text-dark">Edit Obat</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Detail Obat</h3>
                </div>
                {!! Form::model($obat, ['method' => 'PATCH', 'route' => ['admin.obat.update', $obat->id], 'files' => true]) !!}
                <div class="card-body">
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
