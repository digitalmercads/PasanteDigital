@extends('layouts.app')
@section('title', 'Crear Cuenta')
@section('content')
<div class="row center-align" style="padding: 70px 0;">
    <div class="col s12">
        <div class="card login-card">
            <div class="card-content">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="row">
                        <div class="col s12 center-align">
                            <span class="card-title">{{ __('Crear cuenta') }}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <div class="input-field">
                                <i class="material-icons prefix">account_circle</i>
                                <input id="name" name="name" type="text" value="{{ old('name') }}">
                                <label for="name">Nombre</label>
                                @error('name')
                                <span class="helper-text red-text" data-error="Formato no válido"
                                    data-success="Correo válido">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <div class="input-field">
                                <i class="material-icons prefix">email</i>
                                <input id="email" name="email" type="email" value="{{ old('email') }}">
                                <label for="email">Email</label>
                                @error('email')
                                <span class="helper-text red-text" data-error="Formato no válido"
                                    data-success="Correo válido">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <div class="input-field">
                                <i class="material-icons prefix">lock</i>
                                <input id="password" name="password" type="password" value="{{ old('password') }}"
                                    autocomplete="new-password">
                                <label for="password">Contraseña</label>
                                @error('password')
                                <span class="helper-text red-text" data-error="Formato no válido"
                                    data-success="Correo válido">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <div class="input-field">
                                <i class="material-icons prefix">lock</i>
                                <input id="password-confirm" name="password_confirmation" type="password"
                                    value="{{ old('password-confirm') }}" autocomplete="new-password">
                                <label for="password-confirm">Confirmar Contraseña</label>
                                @error('password-confirm')
                                <span class="helper-text red-text" data-error="Formato no válido"
                                    data-success="Correo válido">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <button class="btn waves-effect waves-light blue darken-1" style="width: 100%" type="submit"
                                name="action">Crear Cuenta
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection