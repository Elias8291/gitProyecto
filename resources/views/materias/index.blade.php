@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Materias</h3>
        <div class="section-header-button">
            @can('crear-materias')
            <a href="{{ route('materias.create') }}" class="btn btn-primary">
                Crear Nueva Materia
            </a>
            @endcan
        </div>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-striped mt-2" id="miTabla2">
                            <thead style="background-color:#6777ef">
                                <tr>
                                    <th style="color:#fff;">ID</th>
                                    <th style="color:#fff;">Clave</th>
                                    <th style="color:#fff;">Nombre</th>
                                    <th style="color:#fff;">Créditos</th>
                                    <th style="color:#fff;">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($materias as $materia)
                                <tr>
                                    <td>{{ $materia->id }}</td>
                                    <td>{{ $materia->clave }}</td>
                                    <td>{{ $materia->nombre }}</td>
                                    <td>{{ $materia->creditos }}</td>
                                    <td>
                                        @can('editar-materias')
                                        <a href="{{ route('materias.edit', $materia->id) }}" class="btn btn-warning">
                                            Editar
                                        </a>
                                        @endcan
                        
                                        <form action="{{ route('materias.destroy', $materia->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @can('eliminar-materias')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta materia?')">
                                                Eliminar
                                            </button>
                                            @endcan
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="pagination justify-content-end">
                            {!! $materias->links() !!}
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
            [2, 5, 10,15,50],
            [2, 5, 10,15,50]
        ],
        columns: [
            { data: 'id', title: 'ID' },
            { data: 'clave', title: 'Clave' },
            { data: 'nombre', title: 'Nombre' },
            { data: 'creditos', title: 'Créditos' },
            { data: 'Acciones', title: 'Acciones', orderable: false }
        ],
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
        }
    });
</script>
@endsection