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

    <livewire:create-general-component/>
    
    <footer>
        <a href="{{route('student.list')}}"><button class="btn btn-secondary">Volver</button></a>
    </footer>
@stop