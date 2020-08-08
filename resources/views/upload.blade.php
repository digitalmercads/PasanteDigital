@extends('layouts.app')
@section('title', 'Subir Archivos')
@section('content')

<div class="row">
    <form action="{{ route('add_files') }}" method="post" enctype="multipart/form-data" class="col s12">
        <div class="row">
            <div class="col s12">
                <div class="app-title">{{ __('Subir Archivos') }}</div>
            </div>
        </div>
        @csrf
        <div class="row">
            <div class="file-field input-field col s12">
                <div class="btn blue-grey darken-4">
                    <span><i class="material-icons">search</i></span>
                    <input type="file" multiple name="file" accept="image/png,image/jpeg,.pdf" required
                        value="{{ old('file') }}">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" placeholder="Seleccionar Archivos">
                </div>
                @error('file')
                <div class="valign-wrapper red-text">
                    <i class="material-icons">error</i> <span class="helper-text red-text">{{ $message }}</span>
                </div>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <select id="sel_users">
                    <option value="" disabled selected>Seleccionar usuario</option>
                    @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                <label>Usuario</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <select id="sel_judicials">
                    <option value="" selected disabled>Seleccionar</option>
                </select>
                <label>Expediente</label>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <button class="btn waves-effect waves-light blue darken-1" type="submit" name="action"
                    style="width: 100%">Subir Archivos
                </button>
            </div>
        </div>
    </form>
</div>

@endsection


@section('scripts')
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            $('#sel_users').change(function () {
                if($(this).val() !== ''){
                    var id_user = $(this).val();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{ route('judicials_list') }}",
                        method: "POST",
                        data:{
                            value: id_user
                        },
                        success: function (result) {
                            $('#sel_judicials').empty().append(
                                $('<option selected disabled></option>').val('').html('Seleccionar')
                            );
                            $.each(result.data, function( index, value ) {
                                $('#sel_judicials').append(
                                    $('<option></option>').val(value.judicial.id).html(value.judicial.name)
                                );
                            });
                            $('#sel_judicials').formSelect();
                        }
                    });
                }
            });
        });
    </script>
@endsection
