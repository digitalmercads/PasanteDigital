@extends('layouts.app')
@section('title', 'Detalles')
@section('content')


<div class="row">
    <div class="col s12">
        <div class="app-title center-align">{{ __('Exp.') }} {{$data->judicial->name}}</div>
    </div>
</div>

@if($files->isEmpty())
<div class="row" style="margin-top: 16px;">
    <div class="col s12">
        <div class="card  light-blue accent-4">
            <div class="card-content white-text">
                <span class="card-title">¡Hola! Bienvenido.</span>
                <p>Lo sentimos, aún no hay actualizaciones.</p>
            </div>
        </div>
    </div>
</div>
@endif

@isset($files)
<div class="row">
    @foreach ($files as $file)

    <div class="col s12 m3">
        <div class="card">
            <div class="card-image">
                @if ($file->format === 'PDF')
                <img src="{{asset('storage/pdf_default.svg')}}" max-height="150px">
                @else
                <img src="{{url($file->url)}}" max-height="150px">
                @endif

            </div>
            <div class="card-content">
                <p><small><strong>Agente:</strong> {{$file->agent->name}}</small></p>
                <p><small><strong>Se subió:</strong> {{$file->created_at->format('Y-m-d')}}</small></p>
            </div>
            <div class="card-action">
                <a href="{{url($file->url)}}" download>Descargar</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endisset
@endsection