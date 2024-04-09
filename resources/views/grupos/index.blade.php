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
                        <table class="table table-striped mt-2" id="miTabla2">
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
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<!-- DATATABLES -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<!-- BOOTSTRAP -->
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script>
    new DataTable('#miTabla2', {
lengthMenu: [
    [2, 5, 10],
    [2, 5, 10]
],

columns: [
    { data: 'clave', title: 'Clave' },
    { data: 'nombre', title: 'Nombre' },
    { data: 'materia.nombre', title: 'Materia' },
    { data: 'Acciones', title: 'Acciones', orderable: false }
],

language: {
    url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
}
});
</script>
@endsection
