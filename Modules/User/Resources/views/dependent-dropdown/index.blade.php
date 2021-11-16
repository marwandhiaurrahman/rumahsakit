@extends('adminlte::page')
@section('title', 'Dependent Dropdowns')
@section('content_header')
    <h1 class="m-0 text-dark">Dependent Dropdowns</h1>
@stop

@section('content')
    <form>
        @csrf
        <div class="form-group">
            <label for="name" class="form-label">Province</label>
            <select name="province" id="province" class="form-control">
                <option value="">== Select Province ==</option>
                @foreach ($provinces as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="name" class="form-label">City</label>
            <select name="city" id="city" class="form-control">
                <option value="">== Select City ==</option>
            </select>
        </div>
        <div class="form-group">
            <select name="district" id="district" class="form-control">
                <option value="">== Select District ==</option>
            </select>
        </div>
        <div class="form-group">
            <select name="village" id="village" class="form-control">
                <option value="">== Select Village ==</option>
            </select>
        </div>
        {{-- <button type="submit">Submit</button> --}}
    @stop

    @section('js')
        <script>
            $(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $('#province').on('change', function() {
                    $.ajax({
                        url: '{{ route('dependent-dropdown.store') }}',
                        method: 'POST',
                        data: {
                            id: $(this).val()
                        },
                        success: function(response) {
                            $('#city').empty();

                            $.each(response, function(id, name) {
                                $('#city').append(new Option(name, id))
                            })
                        }
                    })
                });
                $('#city').on('change', function() {
                    $.ajax({
                        url: '{{ route('dependent-dropdown.kecamatan') }}',
                        method: 'POST',
                        data: {
                            id: $(this).val()
                        },
                        success: function(response) {
                            $('#district').empty();

                            $.each(response, function(id, name) {
                                $('#district').append(new Option(name, id))
                            })
                        }
                    })
                });
                $('#district').on('change', function() {
                    $.ajax({
                        url: '{{ route('dependent-dropdown.desa') }}',
                        method: 'POST',
                        data: {
                            id: $(this).val()
                        },
                        success: function(response) {
                            $('#village').empty();

                            $.each(response, function(id, name) {
                                $('#village').append(new Option(name, id))
                            })
                        }
                    })
                });
            });
        </script>
    @endsection
