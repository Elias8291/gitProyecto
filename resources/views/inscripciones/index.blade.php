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

                        <table class="table table-striped mt-2">
                                <thead style="background-color:#6777ef">
                                    <th style="color:#fff;">ID</th>
                                    <th style="color:#fff;">Número de Control</th>
                                    <th style="color:#fff;">Nombre del Alumno</th>
                                    <th style="color:#fff;">Clave del Grupo</th>
                                    <th style="color:#fff;">Nombre de la Materia</th>
                                    <th style="color:#fff;">Acciones</th>
                                </thead>
                                <tbody>
                                @foreach ($inscripciones as $inscripcion)
                                <tr>
                                    <td>{{ $inscripcion->id }}</td>
                                    <td>{{ optional($inscripcion->alumno)->numeroDeControl }}</td>
                                    <td>{{ optional($inscripcion->alumno)->nombre }}</td>
                                    <td>{{ optional($inscripcion->grupo)->clave }}</td>
                                    <td>{{ optional(optional($inscripcion->grupo)->materia)->nombre }}</td>
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
@endsection
