@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Alumnos del Grupo</h3>
    </div>
    <div class="section-body">
        <div class="row mb-3">
            <div class="col-lg-12">
                <a href="{{ url()->previous() }}" class="btn btn-primary">Regresar</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        @if ($alumnos->isEmpty())
                            <div class="alert alert-info" role="alert">
                                No hay alumnos inscritos en este grupo.
                            </div>
                        @else
                            <table class="table table-striped mt-2" id="alumnosTable">
                                <thead style="background-color:#6777ef">
                                    <tr>
                                        <th style="color:#fff;">Número de Control</th>
                                        <th style="color:#fff;">Nombre del Estudiante</th>
                                        <th style="color:#fff;">Clave del Grupo</th>
                                        <th style="color:#fff;">Nombre de la Materia</th>
                                        <th style="color:#fff;">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($alumnos as $alumno)
                                    <tr>
                                        <td>{{ $alumno->numeroDeControl }}</td>
                                        <td>{{ $alumno->nombre_estudiante }}</td>
                                        <td>{{ $alumno->clave_grupo }}</td>
                                        <td>{{ $alumno->nombre_materia }}</td>
                                        <td>
                                            @if ($grupo->activo)
                                                @can('editar-inscripcion')
                                                <a href="{{ route('inscripciones.edit', $alumno->id) }}" class="btn btn-warning mr-1 css-button-sliding-to-left--yellow">
                                                    <i class="fas fa-edit"></i> Editar
                                                </a>
                                                @endcan

                                                @can('borrar-inscripcion')
                                                <button type="button" class="btn btn-danger css-button-sliding-to-left--red" onclick="confirmarEliminacion({{ $alumno->id }})">
                                                    <i class="fas fa-trash-alt"></i> Eliminar
                                                </button>
                                                <form id="eliminar-form-{{ $alumno->id }}" action="{{ route('inscripciones.destroy', $alumno->id) }}" method="POST" class="d-none">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                @endcan
                                            @else
                                                <span class="badge badge-secondary">Inactivo</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="pagination justify-content-end">
                                {!! $alumnos->links() !!}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<!-- DATATABLES -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<!-- BOOTSTRAP -->
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    new DataTable('#alumnosTable', {
        lengthMenu: [
            [2, 5, 10, 15, 50],
            [2, 5, 10, 15, 50]
        ],
        columns: [
            { data: 'numeroDeControl', title: 'Número de Control' },
            { data: 'nombre_estudiante', title: 'Nombre del Estudiante' },
            { data: 'clave_grupo', title: 'Clave del Grupo' },
            { data: 'nombre_materia', title: 'Nombre de la Materia' },
            { data: 'acciones', title: 'Acciones' },
        ],
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
            search: "_INPUT_",
            searchPlaceholder: "Buscar...",
            lengthMenu: "Mostrar registros _MENU_"
        },
        dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>rt<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
        pageLength: 10
    });

    function confirmarEliminacion(estudianteId) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminarlo'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('eliminar-form-' + estudianteId).submit();
                Swal.fire({
                    title: 'Eliminado!',
                    text: 'El estudiante ha sido eliminado correctamente.',
                    icon: 'success',
                    timer: 4000,
                    showConfirmButton: false
                });
            }
        });
    }
</script>
@endsection
