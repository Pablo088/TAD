@extends('layouts')

@section("head")
    @vite("resources/css/student/abm/createGeneral.css")
@stop

@section("content_header")
    <h1 class="text-center">Alta General</h1>
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

    <div id="carrera">
        <h3 class="text-center">Sección Carrera</h3>

        <form action="" method="post" class="general-form">
            <div class="campo-container">
                <label for="inputCarrera">Nombre de la Carrera</label>
                <input type="text" name="nombreCarrera" id="inputCarrera" class="form-control" maxlength="64">
            </div>

            <div class="campo-container">
                <label for="inputAnios">Cantidad de Años de la Carrera</label>
                <input type="number" name="cantidadAnios" id="inputAnios" class="form-control" max="10">
            </div>

            <div class="campo-container">
                <label for="inputDivisiones">Divisiones de la carrera</label>
                <input type="text" name="divisiones" id="inputDivisiones" class="form-control" max="10" placeholder="Ej: A,B,C...">
            </div>

            <div class="campo-container">
                <button type="submit" class="btn btn-outline-primary">Agregar</button>
            </div>
        </form>
    </div>

    <div id="alumnos">
        <h3 class="text-center">Sección Alumnos</h3>

        <form action="{{route('student.add')}}" method="post" id="add-form">
            @csrf

            <div class="campo-container">
                <label for="dni">DNI</label>
                <input type="number" name="dni" id="dni" class="form-control" placeholder="ejemplo: 45000000" value="{{old('dni')}}" maxlength="8">
            </div>

            <div class="campo-container">
                <label for="name">Nombre Completo</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Ejemplo: Roberto Almada" value="{{old('name')}}" maxlength="64">
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
                            <option value=""></option>
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
                <button type="submit" class="btn btn-outline-primary">Agregar</button>
            </div>
        </form>
    </div>
    <footer>
        <a href="{{route('student.list')}}"><button class="btn btn-secondary">Volver</button></a>
    </footer>
@stop