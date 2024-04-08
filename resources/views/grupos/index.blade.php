@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Grupos</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-striped mt-2">
                            <thead style="background-color:#6777ef">
                                <tr>
                                    <th style="color:#fff;">Clave</th>
                                    <th style="color:#fff;">Nombre</th>
                                    <th style="color:#fff;">Materia</th>
                                    <th style="color:#fff;">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($grupos as $grupo)
                                <tr>
                                    <td>{{ $grupo->clave }}</td>
                                    <td>{{ $grupo->nombre }}</td>
                                    <td>{{ $grupo->materia->nombre }}</td>
                                    <td>
                                        <a href="{{ route('grupos.generarPDF', $grupo->clave) }}" class="btn btn-primary">
                                            <i class="fas fa-file-excel"></i> Generar Lista Alumnos
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
