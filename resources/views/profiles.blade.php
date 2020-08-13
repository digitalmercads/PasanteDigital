@extends('layouts.app')
@section('title', 'Editar Perfiles')
@section('content')

<!-- Alertas -->
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
<!-- Fin Alertas -->

<div class="row">
    <div class="col-s12">
        <div class="title-container">
            <div class="app-title center-align">{{ __('Editar Perfiles de Usuario') }}</div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col s12">
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Perfil</th>
                </tr>
            </thead>

            <tbody>
                @isset($profiles)
                @foreach ($profiles as $profile)
                <tr>
                    <td>{{ $profile->name }}</td>
                    <td>{{ $profile->email }}</td>
                    <td>
                        <select class="profile-select" id="{{ $profile->id }}">
                            <option value="" disabled selected>Selecciona una opción</option>
                            @foreach ($roles as $role)
                            <option value="{{ $role->id }}"
                                {{ $role->id === $profile->roles[0]->id ? "selected" : "" }}>{{ $role->description }}
                            </option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                @endforeach
                @endisset
            </tbody>
        </table>
    </div>
</div>


@endsection

@section('scripts')
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
            $('.profile-select').change(function () {
                if($(this).val() != ''){
                    var select = $(this).attr("id");
                    var value = $(this).val();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{ route('profile_update') }}",
                        method: "POST",
                        data:{
                            user_id: select,
                            role_id: value
                        },
                        success: function (result) {
                            M.toast({html: 'Datos actualizados correctamente.'})
                        }
                    });
                }
                
            });
        });
</script>
@endsection