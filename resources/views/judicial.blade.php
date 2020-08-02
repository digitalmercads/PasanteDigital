@extends('layouts.app')
@section('title', 'Solicitar Expediente')
@section('content')

@if (session('status')=="success")
<div class="row" style="margin-top: 16px;">
    <div class="col s12">
        <div class="card  light-blue accent-4">
            <div class="card-content white-text">
                <span class="card-title">¡Excelente!</span>
                <p>Tu solicitud está en proceso de validación.</p>
            </div>
        </div>
    </div>
</div>
@elseif(session('status')=="fail")
<div class="row" style="margin-top: 16px;">
    <div class="col s12">
        <div class="card  red">
            <div class="card-content white-text">
                <span class="card-title">¡Error!</span>
                <p>Revisa nuevamente los datos de tu formulario.</p>
            </div>
        </div>
    </div>
</div>
@endif

<div class="fixed-action-btn">
    <a class="btn-floating btn-large blue darken-1 modal-trigger" href="#modal1">
        <i class="large material-icons">add</i>
    </a>
</div>

<div class="title-container">
    <div class="app-title center-align">{{ __('Expedientes') }}</div>
</div>

@isset($judicials)
<div class="row">
    @foreach ($judicials as $judicial)
    <div class="col s12 m3">
        <div class="card">
            <div class="card-content">
                <span class="card-title"><strong>Nº de Exp:</strong> {{ $judicial->name }}</span>
                <p><strong>Actor:</strong> {{ $judicial->actor }}</p>
                <p><strong>Juzgado:</strong> {{ $judicial->court }}</p>
                <p><strong>Materia:</strong> {{ $judicial->type->name }}</p>
            </div>
            <div class="card-action">
                <a href="#">Ver detalles</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endisset



<!-- Modal Structure -->
<div id="modal1" class="modal">
    <div class="modal-content">
        <div class="title-container">
            <div class="app-title">{{ __('Solicitar Expediente') }}</div>
        </div>
        <div class="row">
            <form method="POST" action="{{ route('add_judicial') }}" class="col s12">
                @csrf
                <div class="row">
                    <div class="input-field col s12 m6">
                        <input id="name" name="name" type="text" value="{{ old('name') }}" required>
                        <label for="name">Nº Expediente</label>
                        @error('name')
                        <span class="helper-text red-text">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-field col s12 m6">
                        <input id="actor" name="actor" type="text" value="{{ old('actor') }}" required>
                        <label for="actor">Nombre del Actor</label>
                        @error('actor')
                        <span class="helper-text red-text">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-field col s12">
                        <input id="court" name="court" type="text" value="{{ old('court') }}" required>
                        <label for="court">Nº Juzgado</label>
                        @error('court')
                        <span class="helper-text red-text">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-field col s12">
                        <select id="type" name="type">
                            <option value="" selected>Selecciona una opción</option>
                            @isset($judicialTypes)
                            @foreach ($judicialTypes as $judicialType)
                            <option value="{{ $judicialType->id }}">{{ $judicialType->name }}</option>
                            @endforeach
                            @endisset
                        </select>
                        <label for="type">Materia</label>
                        @error('type')
                        <span class="helper-text red-text">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div>
                    <button class="btn waves-effect waves-light blue darken-1 btn-width" type="submit"
                        name="action">Solicitar
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancelar</a>
    </div>
</div>

@endsection
@section('scripts')

@endsection
