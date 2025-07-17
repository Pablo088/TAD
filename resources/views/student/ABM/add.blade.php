@extends('layouts')

@section("head")
    @vite("resources/css/student/abm/add.css")
@stop

@section("content_header")
    <h1>Alta de alumno</h1>
@stop

@section('content')
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
    
    <form action="{{route('student.add')}}" method="post" id="add-form">
        @csrf

        <div class="campo-container">
            <label for="dni">DNI</label>
            <input type="number" name="dni" id="dni" class="form-control" placeholder="ejemplo: 45000000" value="{{old('dni')}}">
        </div>

        <div class="campo-container">
            <label for="name">Nombre Completo</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Ejemplo: Roberto Almada" value="{{old('name')}}">
            @if($errors->has("birthDate"))
                @foreach($errors->get("name") as $message)    
                    <li class="text-danger">{{$message}}</li>
                @endforeach
            @endif
        </div>

        <div class="campo-container">
            <label for="birthDate">Fecha de Nacimiento</label>
            <input type="date" name="birthDate" id="birthDate" class="form-control" value="{{old('birthDate')}}">
            @if($errors->has("birthDate"))
                @foreach($errors->get("birthDate") as $message)    
                    <li class="text-danger">{{$message}}</li>
                @endforeach
            @endif
        </div>

        <div class="campo-container">
                <label for="career">Carrera</label>
                <select name="career" id="career" class="form-control" required>
                    @foreach($careers as $career)
                        <option value="{{$career->id}}">{{$career->name}}</option>
                    @endforeach
                </select>
                @if($errors->has("career"))
                    @foreach($errors->get("career") as $message)    
                        <li class="text-danger">{{$message}}</li>
                    @endforeach
                @endif
            </div>

            <div class="campo-container">
                <label for="current_year">Año</label>
                <input type="number" name="current_year" id="current_year" value="{{old('current_year')}}" class="form-control" maxlength="1" required placeholder="Ejemplo: 1">
                @if($errors->has("current_year"))
                    @foreach($errors->get("current_year") as $message)    
                        <li class="text-danger">{{$message}}</li>
                    @endforeach
                @endif
            </div>

            <div class="campo-container">
                <label for="division">Division</label>
                <input type="text" name="division" id="division" value="{{old('division')}}" class="form-control" maxlength="1" required placeholder="Ejemplo: A">
                @if($errors->has("division"))
                    @foreach($errors->get("division") as $message)    
                        <li class="text-danger">{{$message}}</li>
                    @endforeach
                @endif
            </div>

        
        <div class="campo-container">
            <button type="submit" class="btn btn-primary">Agregar</button>
        </div>
    </form>
@stop

<footer>
    <a href="{{route('student.list')}}"><button class="btn btn-secondary">Volver</button></a>
</footer>