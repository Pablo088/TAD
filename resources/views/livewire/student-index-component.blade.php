<div>
    <!--{{var_dump($this->studentAssisted)}}-->
     <div id="filters-container">
        <div class="filter-field">
            <input type="search" name="input-filter" id="input-filter" wire:model.live="search" class="form-control" placeholder="Buscar por nombre">
        </div>        
        
        <div class="filter-field">
            <select name="career-filter" id="career-filter" wire:model.live="careerFilter" wire:change="clearStudents" class="form-control text-center">
                <option value="">Filtro por Carrera</option>
                @foreach($careers as $career)
                    <option value="{{$career->id}}">{{$career->name}}</option>
                @endforeach
            </select>
        </div>    

        <div class="filter-field">
            <select name="year-filter" id="year-filter" wire:model.live="yearFilter" wire:change="clearStudents" class="form-control text-center">
                <option value="">Filtro por Año</option>
                @foreach($filtersYear as $filter)
                    <option value="{{$filter->current_year}}">{{$filter->current_year}}</option>
                @endforeach
            </select>
        </div>

        <div class="filter-field">
            <select name="division-filter" id="division-filter" wire:model.live="divisionFilter" wire:change="clearStudents" class="form-control text-center">
                <option value="">Filtro por Division</option>
                @foreach($filtersDivision as $filter)
                    <option value="{{$filter->division}}">{{$filter->division}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div>
        @if(session("success"))
            <div class="alert alert-success text-center">{{session("success")}}</div>
        @endif
        <table class="table table-primary table-bordered table-hover table-responsive-sm">
            <thead>
                <tr>
                    <th class="text-center">    
                        <button type="button" wire:click="selectAll" onclick="selectAll()" class="btn btn-outline-primary">Marcar todos</button>
                    </th>
                    <th class="text-center">Nombre Completo</th>
                    <th class="text-center">Carrera</th>
                    <th class="text-center">Año</th>
                    <th class="text-center">Division</th>
                </tr>
            </thead>
            <tbody>
                @foreach($student as $students)
                    <tr class="table-success">
                            <td class="text-center">
                                <form action="#" method="post">
                                    @csrf  
                                    <input type="checkbox" name="checkAssist[]" class="check check-round" 
                                    wire:click="giveAssist({{$students->student_id}})"
                                    >
                                </form>
                            </td>
                            <td class="text-center">{{$students->student_name}}</td>
                            <td class="text-center">{{$students->career_name}}</td>
                            <td class="text-center">{{$students->current_year}}</td>
                            <td class="text-center">{{$students->division}}</td>
                        </tr>
                    @endforeach
            </tbody>
        </table>

        <div class="text-center">
            <button type="button" wire:click="sendAssist" class="btn btn-primary">Enviar</button>
        </div>
        
    </div>
    <script>
        function selectAll(){
            let checkboxes = document.querySelectorAll(".check");
            
            for(let i = 0; i < checkboxes.length; i++){
                checkboxes[i].checked = (checkboxes[i].checked == false) ?  true : false;
            }
        }
    </script>
</div>