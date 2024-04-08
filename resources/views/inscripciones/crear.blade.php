@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Crear Inscripción</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('inscripciones.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="alumno_numeroDeControl">Número de Control del Estudiante:</label>
                                <select class="form-control" name="alumno_numeroDeControl" id="alumno_numeroDeControl" required onchange="updateAlumnoInfo()">
                                    <option value="">Seleccione un estudiante</option>
                                    @foreach ($estudiantes as $estudiante)
                                    <!-- Supongamos que cada estudiante tiene un atributo 'nombre' -->
                                    <option value="{{ $estudiante->numeroDeControl }}" data-nombre="{{ $estudiante->nombre }}">{{ $estudiante->numeroDeControl }}</option>
                                    @endforeach
                                </select>
                                <!-- Input para mostrar el nombre del alumno, solo lectura -->
                                <input type="text" class="form-control mt-2" id="nombre_alumno" readonly>
                            </div>

                            <div class="form-group">
                                <label for="grupo_clave">Clave del Grupo:</label>
                                <select class="form-control" name="grupo_clave" id="grupo_clave" required onchange="updateGrupoInfo()">
                                    <option value="">Seleccione un grupo</option>
                                    @foreach ($grupos as $grupo)
                                    <!-- Supongamos que cada grupo tiene un atributo 'nombre_materia' -->
                                    <option value="{{ $grupo->clave }}" data-nombre-materia="{{ optional($grupo->materia)->nombre }}">{{ $grupo->clave }}</option>

                                    @endforeach
                                </select>
                                <!-- Input para mostrar el nombre de la materia, solo lectura -->
                                <input type="text" class="form-control mt-2" id="nombre_materia" readonly>
                            </div>

                            <button type="submit" class="btn btn-primary">Crear Inscripción</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function updateGrupoInfo() {
    var selectGrupo = document.getElementById('grupo_clave');
    // Asegúrate de que haya una selección válida.
    if (selectGrupo.selectedIndex >= 0) {
        var nombreMateria = selectGrupo.options[selectGrupo.selectedIndex].getAttribute('data-nombre-materia');
        document.getElementById('nombre_materia').value = nombreMateria || 'Nombre de materia no disponible';
    }
}


    document.addEventListener('DOMContentLoaded', function () {
        
        const selectAlumno = document.getElementById('alumno_numeroDeControl');
        const nombreAlumnoInput = document.getElementById('nombre_alumno');
        const selectGrupo = document.getElementById('grupo_clave');
        const nombreMateriaInput = document.getElementById('nombre_materia');
    
        // Actualiza el nombre del alumno basado en la selección actual.
        function updateAlumnoInfo() {
            var nombre = selectAlumno.options[selectAlumno.selectedIndex].getAttribute('data-nombre');
            nombreAlumnoInput.value = nombre;
        }
    
        function updateGrupoInfo() {
    var selectGrupo = document.getElementById('grupo_clave');
    console.log(selectGrupo.selectedIndex); // Verifica qué índice está seleccionado
    if (selectGrupo.selectedIndex >= 0) {
        var optionSeleccionada = selectGrupo.options[selectGrupo.selectedIndex];
        console.log(optionSeleccionada.value); // Verifica el valor de la opción seleccionada
        console.log(optionSeleccionada.getAttribute('data-nombre-materia')); // Verifica el atributo data-nombre-materia
        var nombreMateria = optionSeleccionada.getAttribute('data-nombre-materia');
        document.getElementById('nombre_materia').value = nombreMateria || 'Nombre de materia no disponible';
    }
}

    
        // Agrega los event listeners para cambios.
        selectAlumno.addEventListener('change', updateAlumnoInfo);
        selectGrupo.addEventListener('change', updateGrupoInfo);
    
        // Inicializa los valores de los inputs. Este paso es opcional y depende de tu flujo de usuario.
        // Si tu flujo permite tener un grupo seleccionado por defecto al cargar la página, descomenta las siguientes líneas:
        // updateAlumnoInfo();
        // updateGrupoInfo();
    });
    </script>
    
@endsection
