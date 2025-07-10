<div>
    <div id="filters-container">
        <div class="filter-field">
            <input type="search" name="input-filter" id="input-filter" wire:model.live="search" class="form-control" placeholder="Buscar por nombre y apellido">
        </div>        

        <div class="filter-field">
            <select name="year-filter" id="year-filter" wire:model.live="yearFilter" class="form-control text-center">
                <option value="">Filtro por Año</option>
                <option value="1">Primer Año</option>
                <option value="2">Segundo Año</option>
                <option value="3">Tercer Año</option>
                <option value="4">Cuarto Año</option>
                <option value="5">Quinto Año</option>
                <option value="6">Sexto Año</option>
            </select>
        </div>

        <div class="filter-field">
            <select name="division-filter" id="division-filter" wire:model.live="divisionFilter" class="form-control text-center">
                <option value="">Filtro por Division</option>
                <option value="A">A</option>
                <option value="B">B</option>
            </select>
        </div>    
    </div>

    <table class="table table-primary table-bordered table-hover table-responsive-sm">
        <thead>
            <tr>
                <th class="text-end">DNI</th>
                <th class="text-center">Nombre Completo</th>
                <th class="text-center">Fecha de Nacimiento</th>
                <th class="text-center">Año</th>
                <th class="text-center">Division</th>
                <th class="text-center">Carrera</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($student as $students)
                <tr class="table-success">
                    <td class="text-end">{{$students->dni}}</td>
                    <td class="text-center">{{$students->name}}</td>
                    <td class="text-center">{{$students->birthDate}}</td>
                    <td class="text-center">{{$students->year}}</td>
                    <td class="text-center">{{$students->division}}</td>
                    <td class="text-center">{{$students->career}}</td>
                    <td class="text-center" style="display: grid;">
                        <a href="{{route('student.edit',$students->id)}}"><button class="btn btn-warning my-1">Modificar</button></a>
                        
                        <a href="{{route('student.info',$students->id)}}"><button class="btn btn-info my-1">Condicion General</button></a>
                        
                        <a href="{{route('student.notas',$students->id)}}"><button class="btn btn-warning my-1">Agregar Nota</button></a>
                        
                        <form action="{{route('student.destroy',$students->id)}}" method="post">
                            @csrf  
                            @method("delete")
                            <button type="submit" id="botonEliminar" onclick="return confirmar()" class="btn btn-danger th-btn" value="{{$students->id}}">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@section("content_footer")
    <div style="display: flex;justify-content: space-between;">
        Resultados: {{$student->firstItem()}} - {{$student->lastItem()}}. Total: {{$student->total()}}
        {{$student->links("pagination::bootstrap-4")}}
    </div>
@stop
