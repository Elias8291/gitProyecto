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
                                        <label for="estudiante_id">Estudiante:</label>
                                        <select class="form-control @error('estudiante_id') is-invalid @enderror" name="estudiante_id" id="estudiante_id" required>
                                            <option value="">Seleccione un estudiante</option>
                                            @foreach ($estudiantes as $estudiante)
                                            <option value="{{ $estudiante->id }}" {{ $inscripcion->estudiante_id == $estudiante->id ? 'selected' : '' }}>
                                                {{ $estudiante->numeroDeControl }} - {{ $estudiante->nombre }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('estudiante_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="grupo_id">Grupo:</label>
                                        <select class="form-control @error('grupo_id') is-invalid @enderror" name="grupo_id" id="grupo_id" required>
                                            <option value="">Seleccione un grupo</option>
                                            @foreach ($grupos as $grupo)
                                            <option value="{{ $grupo->id }}" {{ $inscripcion->grupo_id == $grupo->id ? 'selected' : '' }}>
                                                {{ $grupo->clave }} - {{ optional($grupo->materia)->nombre }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('grupo_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
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
