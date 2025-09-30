@extends("layouts")

@section("head")
    @vite("resources/css/generarReportes.css")
@stop

@section("content_header")
    <h1 class="text-center">Generar Reporte</h1>
@stop

@section("content")
    <form action="{{route('generated.report')}}" method="post" id="report_form">
        <div id="grupoFiltros">
            @csrf
            <h3 class="text-center">Filtros a aplicar</h3>
            
            <div class="filters-group">
                <div class="filter">
                    <label for="porcentajeAsistencia">Porcentaje de Asistencia</label>
                    <select name="porcAsistencia" id="porcentajeAsistencia" class="form-control form-filter">
                        <option value="0">Ninguno</option>
                        <option value="1">Mayor igual al 80%</option>
                        <option value="2">Mayor igual al 60%</option>
                        <option value="3">Menor al 60%</option>
                        <option value="4">Todos</option>
                    </select>
                </div>
                
                <div class="filter">
                    <label for="promedioNotas">Promedio de Notas</label>
                    <select name="promNotas" id="promedioNotas" class="form-control form-filter">
                        <option value="0">Ninguno</option>
                        <option value="1">Mayor igual a 8</option>
                        <option value="2">Mayor igual a 6</option>
                        <option value="3">Menor a 6</option>
                        <option value="4">Todos</option>
                    </select>
                </div>
                
                <div class="filter">
                    <label for="condicionGeneral">Condicion General (Asistencias + Notas)</label>
                    <select name="condGeneral" id="condicionGeneral" class="form-control form-filter">
                        <option value="0">Ninguno</option>
                        <option value="1">Promocionados</option>
                        <option value="2">Regulares</option>
                        <option value="3">Libres</option>
                        <option value="4">Todos</option>
                    </select>
                </div>
            </div>
        </div>

        <div id="grupoAlumnos">
            <h3 class="text-center">Grupo a aplicar</h3>
                
            <div class="campo-container">
                <label for="career">Carrera</label>
                <select name="career" id="career" class="form-control" required>
                    <option value="">Carreras</option>
                    @foreach($careers as $career)
                        <option value="{{$career->name}}">{{$career->name}}</option>
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
        </div>
        <div class="campo-container text-center">
            <button type="submit" class="btn btn-primary" id="formBtn">Generar</button>
        </div>
    </form>
    
    @section("scripts")
        @vite("resources/js/generarReportes");
    @stop
@stop