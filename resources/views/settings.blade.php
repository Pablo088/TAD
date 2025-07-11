@extends('layouts')

@section('head')
    @vite('resources/css/settings.css')
@stop

@section('content')
    @section("content_header")
        <h1>Configuración</h1>
    @stop

    @section("content_messages")
        @if(session('success'))
            <div class="alert alert-success text-center">{{session('success')}}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-error text-center">{{session('error')}}</div>
        @endif
    @stop

    <form action="{{route('student.addSettings')}}" method="post">
        @csrf
        @method("put")    
        
        <div class="div-group">
            <h4>Dias de Clase</h4>
            <input type="number" name="dias_clases" value="{{($settings !== null) ? $settings->dias_clases : ''}}" class="form-control">
        </div>
        
        <div class="div-group">
            <h4>Promedio de Promoción</h4>
            <input type="number" name="promedio_promocion" value="{{($settings !== null) ? $settings->promedio_promocion : ''}}" class="form-control">
        </div>
        
        <div class="div-group">
            <h4>Promedio de Regularidad</h4>
            <input type="number" name="promedio_regularidad" value="{{($settings !== null) ? $settings->promedio_regularidad : ''}}" class="form-control">
        </div>
        
        <div class="div-group">
            <h4>Edad Minima (Para entrar a la facultad)</h4>
            <input type="number" name="edad_minima" value="{{($settings !== null) ? $settings->edad_minima : ''}}" class="form-control">
        </div>
        
        <div class="div-group">
           <button type="submit" class="btn btn-outline-primary">Enviar</button>
        </div>
    </form>
@stop