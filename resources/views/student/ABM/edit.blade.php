@extends('layouts')

@section("head")
    @vite("resources/css/student/abm/edit.css")
@stop 

@section('content')
    @section("content_header")
        <h1>Editar Alumno</h1>
    @stop

    @section("content_messages")
        @if(session("success"))
            <div class="alert alert-success">
                {{session("success")}}            
            </div>
        @endif
        
        @if(session("error"))
            <div class="alert alert-success">
                {{session("error")}}            
            </div>
        @endif

        @foreach($errors->all() as $error)
            <div class="alert alert-error">
                {{$error}}
            </div>
        @endforeach
    @stop
    
    <div id="form-content">
        <form action="{{route('student.update',$student)}}" method="post" id="the-form">
            @csrf
            @method("put")

            <div class="input-container">
                <label for="dni">DNI</label>
                <input type="number" name="dni" id="dni" class="form-control" value='{{$student->dni}}' max="9">
            </div>

            <div class="input-container">
                <label for="name">Nombre Completo</label>
                <input type="text" name="name" id="name" class="form-control" value="{{$student->name}}" maxlength="64">
            </div>

            <div class="input-container">
                <label for="birthDate">Fecha de Nacimiento</label>
                <input type="date" name="birthDate" id="birthDate" class="form-control" value="{{$student->birthDate}}">
            </div>

            <div class="input-container">
                <label for="year">Año</label>
                <select type="text" name="year" id="year" value="{{old('year')}}" class="form-control">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                    <option>6</option>
                </select>
            </div>

            <div class="input-container">
                <label for="division">Division</label>
                <select type="text" name="division" id="division" value="{{old('group')}}" class="form-control">
                    <option>A</option>
                    <option>B</option>
                </select>
            </div>

            <div class="input-container">
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </form>
    </div>
    
    @section("content_footer")
        <a href="{{route('student.list')}}"><button class="btn btn-secondary">Volver</button></a>
    @stop
@endsection    