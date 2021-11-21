@extends('adminlte::page')

@section('title', 'Edit Poliklinik')

@section('content_header')
    <h1 class="m-0 text-dark">Edit Poliklinik</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Detail Poliklinik</h3>
                </div>
                {!! Form::model($poliklinik, ['method' => 'PATCH', 'route' => ['admin.poliklinik.update', $poliklinik->id], 'files' => true]) !!}
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
                                <option value="{{ $item->id }}"
                                    {{ $poliklinik->dokter_id == $item->id ? ' selected' : null }}>
                                    {{ $item->kode }} {{ $item->user->name }}
                                </option>
                            @endforeach
                        </select>
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
