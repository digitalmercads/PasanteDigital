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
                <select>
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
                <select>
                    <option value="" disabled selected>Seleccionar</option>
                    <option value="1">Option 1</option>
                    <option value="2">Option 2</option>
                    <option value="3">Option 3</option>
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