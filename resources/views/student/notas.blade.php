@extends('layouts')

@section("head")
    @vite("resources/css/student/notas.css")
@stop

@section("content_header")
    <h1 class="text-center">Ingresa las notas del alumno</h1>
@stop

@section("content_messages")
        @if(session("success"))
            <div class="alert alert-success">
                {{session("success")}}            
            </div>
        @endif
        
        @if(session("error"))
            <div class="alert alert-danger">
                {{session("error")}}            
            </div>
        @endif
@stop

@section("content")
    <form action="{{route('subirNotas')}}" method="post" id="the-form">
        @csrf

        <input type="hidden" name="id" value="{{$id}}" class="form-control">
       
        <div class="campo-container">
            <label for="">Nombre Unidad</label>
            <input type="text" name="nombreUnidad" maxlength="30" class="form-control">
            @if($errors->has("nombreUnidad"))
                @foreach($errors->get("nombreUnidad") as $message)    
                    <li class="text-danger">{{$message}}</li>
                @endforeach
            @endif
        </div>

        <div class="campo-container">
            <label for="">Nombre Parcial</label>
            <input type="text" name="nombreParcial" maxlength="64" class="form-control">
            @if($errors->has("nombreParcial"))
                @foreach($errors->get("nombreParcial") as $message)    
                    <li class="text-danger">{{$message}}</li>
                @endforeach
            @endif
        </div>

        <div class="campo-container">
            <label for="">Nota</label>
            <input type="number" name="nota" min="1" max="10" class="form-control">
            @if($errors->has("nota"))
                @foreach($errors->get("nota") as $message)    
                    <li class="text-danger">{{$message}}</li>
                @endforeach
            @endif
        </div>

        <div class="campo-container">
            <button type="submit" class="btn btn-outline-primary">Enviar</button>
        </div>
    </form>

    <div>
        <a href="{{route('student.list')}}"><button class="btn btn-secondary">Volver</button></a>
    </div>
@stop