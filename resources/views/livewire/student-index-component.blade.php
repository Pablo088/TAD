<div>
     <div id="filters-container">
        <div class="filter-field">
            <input type="search" name="input-filter" id="input-filter" wire:model.live="search" class="form-control" placeholder="Buscar por nombre">
        </div>        
        
        <div class="filter-field">
            <select name="career-filter" id="career-filter" wire:model.live="careerFilter" class="form-control text-center">
                <option value="">Filtro por Carrera</option>
                @foreach($careers as $career)
                    <option value="{{$career->name}}">{{$career->name}}</option>
                @endforeach
            </select>
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
                <th class="text-center">Nombre Completo</th>
                <th class="text-center">Año</th>
                <th class="text-center">Division</th>
                <th class="text-center">Carrera</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @if($student !== null)
                @foreach($student as $students)
                    <tr class="table-success">
                        <td class="text-center">{{$students->student_name}}</td>
                        <td class="text-center">{{$students->current_year}}</td>
                        <td class="text-center">{{$students->division}}</td>
                        <td class="text-center">{{$students->career_name}}</td>
                        <td class="text-center">
                            <form action="{{route('student.destroy',$students->id)}}" method="post">
                                @csrf  
                                <input type="checkbox" name="checkAssist" id="checkAssist" onclick="return confirmar()" class="check check-round" value="{{$students->id}}">Asistencia
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <div>No hay resultados para mostrar</div>
            @endif
        </tbody>
    </table>
    
    <footer style="display: flex;justify-content: space-between;">
        Resultados: {{$student->firstItem()}} - {{$student->lastItem()}}. Total: {{$student->total()}}
        {{$student->links("pagination::bootstrap-4")}}
    </footer>
</div>
