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
            <div class="alert alert-danger">
                {{session("error")}}            
            </div>
        @endif
    @stop

    <div id="form-content">
        <form action="{{route('student.update',$students[0]['student_id'])}}" method="post" id="the-form">
            @csrf
            @method("put")
            
            <div class="input-container">
                <label for="dni">DNI</label>
                <input type="number" name="dni" id="dni" class="form-control" value='{{$students[0]["dni"]}}' maxlength="8" required>
                @if($errors->has("dni"))
                    @foreach($errors->get("dni") as $message)    
                        <li class="text-danger">{{$message}}</li>
                    @endforeach
                @endif
            </div>

            <div class="input-container">
                <label for="name">Nombre Completo</label>
                <input type="text" name="name" id="name" class="form-control" value="{{$students[0]['student_name']}}" maxlength="64" required>
                @if($errors->has("name"))
                    @foreach($errors->get("name") as $message)    
                        <li class="text-danger">{{$message}}</li>
                    @endforeach
                @endif
            </div>

            <div class="input-container">
                <label for="birthDate">Fecha de Nacimiento</label>
                <input type="date" name="birthDate" id="birthDate" class="form-control" value="{{$students[0]['birthDate']}}" required>
                @if($errors->has("birthDate"))
                    @foreach($errors->get("birthDate") as $message)    
                        <li class="text-danger">{{$message}}</li>
                    @endforeach
                @endif
            </div>

            <div class="input-container">
                <label for="career">Carrera</label>
                <select name="career" id="career" class="form-control" required>
                    <option default value="{{$students[0]['career_id']}}">{{$students[0]['career_name']}}</option>
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

            <div class="input-container">
                <label for="current_year">Año</label>
                <input type="number" name="current_year" id="current_year" value="{{$students[0]['current_year']}}" class="form-control" maxlength="1" required>
                @if($errors->has("current_year"))
                    @foreach($errors->get("current_year") as $message)    
                        <li class="text-danger">{{$message}}</li>
                    @endforeach
                @endif
            </div>

            <div class="input-container">
                <label for="division">Division</label>
                <input type="text" name="division" id="division" value="{{$students[0]['division']}}" class="form-control" maxlength="1" required>
                @if($errors->has("division"))
                    @foreach($errors->get("division") as $message)    
                        <li class="text-danger">{{$message}}</li>
                    @endforeach
                @endif
            </div>

            <div class="input-container">
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </form>
    </div>
    
    <footer>
        <a href="{{route('student.list')}}"><button class="btn btn-secondary">Volver</button></a>
    </footer>
@endsection    