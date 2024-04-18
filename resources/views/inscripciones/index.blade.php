@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Inscripciones</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @can('crear-inscripcion')
                                <a class="btn btn-warning" href="{{ route('inscripciones.create') }}">Nueva Inscripción</a>
                            @endcan

                            <table class="table table-striped mt-2" id="miTabla2">
                                <thead style="background-color:#6777ef">
                                    <th style="color:#fff;">ID</th>
                                    <th style="color:#fff;">Número de Control</th>
                                    <th style="color:#fff;">Nombre del Estudiante</th>
                                    <th style="color:#fff;">Clave del Grupo</th>
                                    <th style="color:#fff;">Nombre de la Materia</th>
                                    <th style="color:#fff;">Acciones</th>
                                </thead>
                                <tbody>
                                    @foreach ($inscripciones as $inscripcion)
                                        <tr>
                                            <td>{{ $inscripcion->id }}</td>
                                            <td>{{ $inscripcion->numeroDeControl }}</td>
                                            <td>{{ $inscripcion->nombre_estudiante }}</td>
                                            <td>{{ $inscripcion->clave_grupo }}</td>
                                            <td>{{ $inscripcion->nombre_materia }}</td>
                                            <td>
                                                <form action="{{ route('inscripciones.destroy', $inscripcion->id) }}" method="POST">
                                                    @can('editar-inscripcion')
                                                        <a class="btn btn-info" href="{{ route('inscripciones.edit', $inscripcion->id) }}">Editar</a>
                                                    @endcan

                                                    @csrf
                                                    @method('DELETE')
                                                    @can('borrar-inscripcion')
                                                        <button type="submit" class="btn btn-danger">Borrar</button>
                                                    @endcan
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="pagination justify-content-end">
                                {!! $inscripciones->links() !!}
                            </div>
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
    <script>
        new DataTable('#miTabla2', {
            lengthMenu: [
                [2, 5, 10,15],
                [2, 5, 10,15]
            ],
            columns: [
                { data: 'ID' },
                { data: 'NumeroDeControl', title: 'Número de Control' },
                { data: 'nombre_estudiante', title: 'Nombre del alumno' },
                { data: 'clave_grupo', title: 'Clave del grupo' },
                { data: 'nombre_materia', title: 'Nombre de la materia' },
                { data: 'Acciones', title: 'Acciones' }
            ],
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
            }
        });
    </script>
@endsection