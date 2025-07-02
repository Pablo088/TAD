@extends('layouts')

@section('header')
    @vite('resources/css/settings.css')
@stop

@section('content')
    <div class="main-content">
        <form action="{{route('student.addSettings')}}" method="post">
            @csrf
            @method("put")    
            
            <div class="div-group">
                <h4>Dias de Clase</h4>
                <input type="number" name="dias_clases" value="{{$settings->dias_clases}}" class="form-control">
            </div>
            
            <div class="div-group">
                <h4>Promedio de Promoción</h4>
                <input type="number" name="promedio_promocion" value="{{$settings->promedio_promocion}}" class="form-control">
            </div>
            
            <div class="div-group">
                <h4>Promedio de Regularidad</h4>
                <input type="number" name="promedio_regularidad" value="{{$settings->promedio_regularidad}}" class="form-control">
            </div>
            
            <div class="div-group">
                <h4>Edad Minima (Para entrar a la facultad)</h4>
                <input type="number" name="edad_minima" value="{{$settings->edad_minima}}" class="form-control">
            </div>
            
            <div class="div-group">
               <button type="submit" class="btn btn-outline-primary">Enviar</button>
            </div>
        </form>

        @if(session('success'))
            <div class="alert alert-success text-center">{{session('success')}}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-error text-center">{{session('error')}}</div>
        @endif
    </div>
@stop