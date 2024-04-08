{{-- resources/views/inscripciones/editar.blade.php --}}
@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Editar Inscripción</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        @if ($errors->any())
                        <div class="alert alert-dark alert-dismissible fade show" role="alert">
                            <strong>¡Revise los campos!</strong>
                            @foreach ($errors->all() as $error)
                            <span class="badge badge-danger">{{ $error }}</span>
                            @endforeach
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        <form action="{{ route('inscripciones.update', $inscripcion->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="alumno_numeroDeControl">Número de Control del Estudiante:</label>
                                        <select class="form-control" name="alumno_numeroDeControl" id="alumno_numeroDeControl" required>
                                            @foreach ($estudiantes as $estudiante)
                                            <option value="{{ $estudiante->numeroDeControl }}" data-nombre="{{ $estudiante->nombre }}" {{ $estudiante->numeroDeControl == $inscripcion->alumno_numeroDeControl ? 'selected' : '' }}>{{ $estudiante->numeroDeControl }}</option>
                                            @endforeach
                                        </select>
                                        <!-- Campo adicional para mostrar el nombre del estudiante, solo lectura -->
                                        <input type="text" class="form-control mt-2" id="nombre_estudiante" readonly>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="grupo_clave">Clave del Grupo:</label>
                                        <select class="form-control" name="grupo_clave" id="grupo_clave" required>
                                            @foreach ($grupos as $grupo)
                                            <option value="{{ $grupo->clave }}" data-nombre-materia="{{ optional($grupo->materia)->nombre }}" {{ $grupo->clave == $inscripcion->grupo_clave ? 'selected' : '' }}>{{ $grupo->clave }}</option>
                                            @endforeach
                                        </select>
                                        <!-- Campo adicional para mostrar el nombre de la materia del grupo, solo lectura -->
                                        <input type="text" class="form-control mt-2" id="nombre_materia" readonly>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <br>
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const alumnoSelect = document.getElementById('alumno_numeroDeControl');
    const grupoSelect = document.getElementById('grupo_clave');
    const nombreAlumnoInput = document.getElementById('nombre_estudiante');
    const nombreMateriaInput = document.getElementById('nombre_materia');

    function updateAlumnoNombre() {
        const selectedOption = alumnoSelect.options[alumnoSelect.selectedIndex];
        nombreAlumnoInput.value = selectedOption.getAttribute('data-nombre') || '';
    }

    function updateGrupoNombreMateria() {
        const selectedOption = grupoSelect.options[grupoSelect.selectedIndex];
        nombreMateriaInput.value = selectedOption.getAttribute('data-nombre-materia') || '';
    }

    alumnoSelect.addEventListener('change', updateAlumnoNombre);
    grupoSelect.addEventListener('change', updateGrupoNombreMateria);

    // Actualizar campos al cargar la página
    updateAlumnoNombre();
    updateGrupoNombreMateria();
});
</script>
@endsection
