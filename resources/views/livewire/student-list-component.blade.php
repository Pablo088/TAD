<div>
    <div id="filters-container">
        <div class="filter-field">
            <input type="search" name="input-filter" id="input-filter" wire:model.live="search" class="form-control" placeholder="Buscar por nombre o DNI">
        </div>   
        
        <div class="filter-field">
            <select name="career-filter" id="career-filter" wire:model.live="careerFilter" class="form-control text-center">
                <option value="">Filtro por Carrera</option>
                @foreach($careers as $career)
                    <option value="{{$career->id}}">{{$career->name}}</option>
                @endforeach
            </select>
        </div>      

        <div class="filter-field">
            <select name="year-filter" id="year-filter" wire:model.live="yearFilter" class="form-control text-center">
                <option value="">Filtro por Año</option>
                @foreach($filtersYear as $years)
                    <option value="{{$years->current_year}}">{{$years->current_year}}</option>
                @endforeach
            </select>
        </div>

        <div class="filter-field">
            <select name="division-filter" id="division-filter" wire:model.live="divisionFilter" class="form-control text-center">
                <option value="">Filtro por Division</option>
                @foreach($filtersDivision as $divisions)
                    <option value="{{$divisions->division}}">{{$divisions->division}}</option>
                @endforeach
            </select>
        </div>
    </div>

    @if($student !== null)
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
                        <td class="text-center">{{$students->student_name}}</td>
                        <td class="text-center">{{$students->birthDate}}</td>
                        <td class="text-center">{{$students->current_year}}</td>
                        <td class="text-center">{{$students->division}}</td>
                        <td class="text-center">{{$students->career_name}}</td>
                        <td class="text-center">
                            <a href="{{route('student.edit',$students->id)}}"><button class="btn btn-warning my-1">Modificar</button></a>
                            <a href="{{route('student.notas',$students->id)}}"><button class="btn btn-warning my-1">Agregar Nota</button></a>
                            <a href="{{route('student.info',$students->id)}}"><button class="btn btn-info my-1">Condicion General</button></a>
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
    @else
        <div>No hay resultados para mostrar</div>
    @endif
    
    <footer style="display: flex;justify-content: space-between;" class="table-footer">
        Resultados: {{$student->firstItem()}} - {{$student->lastItem()}}. Total: {{$student->total()}}
        {{$student->links("pagination::bootstrap-4")}}
    </footer>

    <script>
        function confirmar(){
            let respuesta = confirm("¿Estás seguro? Esta acción no se puede deshacer");
    
            if(respuesta == true){
                return true;
            } else {
                return false;
            }
        }
    </script>
</div>