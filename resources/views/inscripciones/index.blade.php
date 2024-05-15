@extends('layouts.app')
<style>
    #miTabla2 {
        font-size: 14px;
    }

    /* Estilos para el campo de búsqueda */
    .dataTables_filter {
        position: relative;
    }

    .dataTables_filter input[type="search"] {
        padding: 12px 40px 12px 20px;
        border: none;
        border-radius: 25px;
        background-color: #f2f2f2;
        font-size: 16px;
        width: 300px;
        transition: all 0.3s ease;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .dataTables_filter input[type="search"]:focus {
        outline: none;
        width: 350px;
        background-color: #fff;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    .dataTables_filter::after {
        content: "\f002";
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
        position: absolute;
        top: 50%;
        right: 20px;
        transform: translateY(-50%);
        color: #999;
        transition: color 0.3s ease;
    }

    .dataTables_filter input[type="search"]:focus+::after {
        color: #333;
    }

    /* Estilos para el menú de selección de registros */
    .dataTables_length {
        position: relative;
        display: inline-block;
        margin-bottom: 20px;
    }

    .dataTables_length label {
        font-size: 16px;
        font-weight: bold;
        color: #555;
    }

    .dataTables_length select {
        padding: 10px 40px 10px 20px;
        border: none;
        border-radius: 25px;
        background-color: #f2f2f2;
        font-size: 16px;
        width: 120px;
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%23999'%3E%3Cpath d='M7 10l5 5 5-5z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 15px center;
        background-size: 20px;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .dataTables_length select:focus {
        outline: none;
        background-color: #fff;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    .dataTables_length select:hover {
        background-color: #e6e6e6;
    }

    .dataTables_length::after {
        content: "";
        position: absolute;
        top: 50%;
        right: 30px;
        transform: translateY(-50%);
        width: 0;
        height: 0;
        border-left: 6px solid transparent;
        border-right: 6px solid transparent;
        border-top: 6px solid #999;
        pointer-events: none;
        transition: border-color 0.3s ease;
    }

    .dataTables_length select:focus+::after {
        border-top-color: #333;
    }

    @media (max-width: 992px) {
        #miTabla2 {
            display: none;
        }
        .mobile-table {
            display: block;
        }
        .mobile-card {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 10px;
            padding: 10px;
        }
        .mobile-card label {
            font-weight: bold;
        }
        .mobile-card .row {
            margin-bottom: 5px;
        }
        .action-buttons {
            display: flex;
            justify-content: space-around;
            padding: 10px 0;
        }
        .btn-mobile {
            flex: 1; /* Distribuir equitativamente el espacio */
            margin: 0 2px;
        }
        .btn-mobile i {
            font-size: 18px; /* Tamaño más grande para facilitar la interacción */
        }
        .btn-mobile:hover {
            opacity: 0.8;
        }
    }

    @media (min-width: 993px) {
        .mobile-table {
            display: none;
        }
    }
</style>

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
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                @can('crear-inscripcion')
                                    <a class="btn btn-warning" href="{{ route('inscripciones.create') }}">
                                        <i class="fas fa-plus"></i> Nueva inscripcion
                                    </a>
                                @endcan
                            </div>
                            <table class="table table-striped mt-2" id="miTabla2">
                                <thead style="background-color:#4267F5">
                                    <th style="color:#fff;" class="text-center">Número de Control</th>
                                    <th style="color:#fff;" class="text-center">Nombre del Estudiante</th>
                                    <th style="color:#fff;" class="text-center">Clave del Grupo</th>
                                    <th style="color:#fff;" class="text-center">Nombre de la Materia</th>
                                    <th style="color:#fff;" class="text-center">Acciones</th>
                                </thead>
                                <tbody>
                                    @foreach ($inscripciones as $inscripcion)
                                        <tr>
                                            <td class="text-center">{{ $inscripcion->numeroDeControl }}</td>
                                            <td class="text-center">{{ $inscripcion->nombre_estudiante }}</td>
                                            <td class="text-center">{{ $inscripcion->clave_grupo }}</td>
                                            <td class="text-center">{{ $inscripcion->nombre_materia }}</td>
                                            <td class="text-center">
                                                @can('editar-inscripcion')
                                                <a href="{{ route('inscripciones.edit', $inscripcion->id) }}" class="btn btn-warning mr-1">
                                                    <i class="fas fa-edit"></i>
                                                    Editar
                                                </a>
                                                @endcan
                                                <form action="{{ route('inscripciones.destroy', $inscripcion->id) }}" method="POST" class="d-inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    @can('borrar-inscripcion')
                                                    <button type="submit" class="btn btn-danger btn-icon-text" onclick="return confirm('¿Estás seguro de eliminar esta inscripción?')">
                                                        <i class="fas fa-trash-alt"></i> 
                                                        Eliminar
                                                    </button>
                                                    @endcan
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @foreach ($inscripciones as $inscripcion)
                        <div class="mobile-card d-lg-none">
                            <div class="row">
                                <div class="col-6"><label>Número de Control</label></div>
                                <div class="col-6">{{ $inscripcion->numeroDeControl }}</div>
                            </div>
                            <div class="row">
                                <div class="col-6"><label>Nombre del Estudiante</label></div>
                                <div class="col-6">{{ $inscripcion->nombre_estudiante }}</div>
                            </div>
                            <div class="row">
                                <div class="col-6"><label>Clave del Grupo</label></div>
                                <div class="col-6">{{ $inscripcion->clave_grupo }}</div>
                            </div>
                            <div class="row">
                                <div class="col-6"><label>Nombre de la Materia</label></div>
                                <div class="col-6">{{ $inscripcion->nombre_materia }}</div>
                            </div>
                            
                            <div class="row">
                                <div class="col-6"><label>Acciones:</label></div>
                                < <div class="row action-buttons">
                                    @can('editar-inscripciones')
                                    <a href="{{ route('grupos.edit', $inscripcion->id) }}" class="btn btn-warning btn-mobile">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @endcan
                                    @can('eliminar-inscripciones')
                                    <form action="{{ route('grupos.destroy', $inscripcion->id) }}" method="POST" class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-mobile" onclick="return confirm('¿Estás seguro de eliminar este grupo?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                    @endcan
                                </div>
                            </div>
                        </div>
                        @endforeach

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
                { data: 'NumeroDeControl', title: 'Número de Control' },
                { data: 'nombre_estudiante', title: 'Nombre del alumno' },
                { data: 'clave_grupo', title: 'Clave del grupo' },
                { data: 'nombre_materia', title: 'Nombre de la materia' },
                { data: 'Acciones', title: 'Acciones' }
            ],
            language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
            search: "_INPUT_",
            searchPlaceholder: "Buscar...",
            lengthMenu: "Mostrar registros _MENU_ "
        },
        dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>rt<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
        pageLength: 10
        });
    </script>
@endsection