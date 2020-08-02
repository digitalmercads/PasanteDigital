@extends('layouts.app')
@section('title', 'Iniciar Sesión')
@section('content')

<div class="row center-align" style="padding: 70px 0;">
    <div class="col s12">
        <div class="card login-card">
            <div class="card-content">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="row">
                        <div class="col s12 center-align">
                            <span class="card-title">{{ __('Iniciar Sesión') }}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <div class="input-field">
                                <i class="material-icons prefix">account_circle</i>
                                <input id="email" name="email" type="text" class="validate" value="{{ old('email') }}">
                                <label for="email">Email</label>
                                @error('email')
                                <span class="helper-text red-text">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="input-field">
                        <i class="material-icons prefix">account_circle</i>
                        <input id="password" name="password" type="password" class="validate">
                        <label for="password">Contraseña</label>
                        @error('password')
                        <span class="helper-text red-text">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <button class="btn waves-effect waves-light blue darken-1" style="width: 100%" type="submit"
                                name="action">Iniciar Sesión
                            </button>
                        </div>
                    </div>
                    <div class="center-align">
                        @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">{{ __('¿Olvidaste la contraseña?') }}</a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection