@extends('layouts.app')
<style>
   #miTabla2 {
    font-family: 'Open Sans', sans-serif;
    border-collapse: collapse;
    width: 100%;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}

#miTabla2 thead {
    background-color: #8c52ff; /* Nuevo color combinado con #6a11cb */
    color: #fff;
}

#miTabla2 thead th {
    padding: 15px;
    text-align: left;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

#miTabla2 tbody tr {
    border-bottom: 1px solid #ddd;
    transition: background-color 0.3s ease;
}

#miTabla2 tbody tr:hover {
    background-color: #f5f5f5;
}

#miTabla2 tbody td {
    padding: 12px 15px;
}

#miTabla2 tbody td .custom-badge {
    background-color: #6a11cb;
    color: #fff;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

#miTabla2 tbody td .btn {
    padding: 6px 12px;
    font-size: 14px;
    border-radius: 4px;
    transition: background-color 0.3s ease;
}

#miTabla2 tbody td .btn-warning {
    background-color: #ffc107;
    color: #212529;
}

#miTabla2 tbody td .btn-warning:hover {
    background-color: #e0a800;
}

#miTabla2 tbody td .btn-danger {
    background-color: #dc3545;
    color: #fff;
}

#miTabla2 tbody td .btn-danger:hover {
    background-color: #c82333;
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

    /* Estilos para las tarjetas en modo móvil */
    .mobile-card {
        background: #fff;
        border: none;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        margin-bottom: 16px;
        padding: 16px;
    }

    .mobile-card .row {
        margin-bottom: 8px;
    }

    .mobile-card label {
        font-weight: bold;
        color: #333;
    }

    .mobile-card .data {
        font-size: 14px;
        color: #666;
    }

    /* Estilos para los botones de acción en modo móvil */
    .action-buttons {
        display: flex;
        justify-content: space-between;
        padding: 12px 0;
    }

    .btn-mobile {
        flex: 0 1 48%;
        margin: 0;
        padding: 10px;
        border-radius: 4px;
        font-size: 14px;
        text-align: center;
        transition: all 0.3s ease;
    }

    .btn-mobile i {
        font-size: 16px;
        margin-right: 5px;
    }

    .btn-mobile:hover {
        opacity: 0.8;
    }

    /* Colores de los botones */
    .btn-warning.btn-mobile {
        background-color: #ffc107;
        color: #212529;
    }

    .btn-danger.btn-mobile {
        background-color: #dc3545;
        color: #fff;
    }

    .btn-mobile-action {
        flex: 0 1 48%;
        margin: 0;
        padding: 10px;
        border-radius: 4px;
        font-size: 14px;
        text-align: center;
        transition: all 0.3s ease;
    }

    .btn-mobile-action i {
        font-size: 16px;
        margin-right: 5px;
    }

    .btn-mobile-action:hover {
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
        <h3 class="page__heading">Grupos</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            @can('crear-grupos')
                            <a class="btn btn-warning btn-icon-text" href="{{ route('grupos.create') }}">
                                <i class="fas fa-plus"></i> <!-- Icono -->
                                <span>Nuevo Alumno</span> <!-- Texto -->
                            </a>
                            @endcan
                        </div>
                        <table class="table table-striped mt-2" id="miTabla2">
                            <thead style="background-color:#5f42d4">
                                <tr>
                                    <th style="color:#fff;" class="text-center">Clave</th>
                                    <th style="color:#fff;" class="text-center">Nombre</th>
                                    <th style="color:#fff;" class="text-center">Materia</th>
                                    <th style="color:#fff;" class="text-center">Rango Alumnos Mínimo</th>
                                    <th style="color:#fff;" class="text-center">Rango Alumnos Máximo</th>
                                    <th style="color:#fff;" class="text-center">Horario inicio</th>
                                    <th style="color:#fff;" class="text-center">Horario fin</th>
                                    <th style="color:#fff;" class="text-center">Alumnos inscritos</th>
                                    <th style="color:#fff;" class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($grupos as $grupo)
                                <tr>
                                    <td class="text-center">{{ $grupo->clave }}</td>
                                    <td class="text-center">{{ $grupo->nombre }}</td>
                                    <td class="text-center">{{ $grupo->materia_nombre }}</td>
                                    <td class="text-center">{{ $grupo->min_alumnos }}</td>
                                    <td class="text-center">{{ $grupo->max_alumnos }}</td>
                                    <td class="text-center">{{ $grupo->hora_in }}</td>
                                    <td class="text-center">{{ $grupo->hora_fn }}</td>
                                    <td class="text-center">{{ $grupo->inscripcionesCount }}</td>
                                    <td class="text-center">
                                        @can('editar-grupos')
                                        <a href="{{ route('grupos.edit', $grupo->id) }}" class="btn btn-warning btn-icon-text mr-1">
                                            <i class="fas fa-edit"></i> <!-- Icono -->
                                            <span>Editar</span> <!-- Texto -->
                                        </a>
                                        @endcan
                                        <form action="{{ route('grupos.destroy', $grupo->id) }}" method="POST"
                                            class="d-inline-block">
                                            @csrf <!-- Token CSRF -->
                                            @method('DELETE') <!-- Método DELETE -->
                                            @can('eliminar-grupos')
                                            <button type="submit" class="btn btn-danger btn-icon-text"
                                                onclick="return confirm('¿Estás seguro de eliminar este grupo?')">
                                                <i class="fas fa-trash-alt"></i> <!-- Icono -->
                                                <span>Eliminar</span> <!-- Texto -->
                                            </button>
                                            @endcan
                                        </form>
                                        @can('ver_excel_grupo')
                                        <a href="{{ route('grupos.generarPDF', $grupo->id) }}" class="btn btn-primary btn-icon-text ml-1">
                                            <i class="fas fa-file-excel"></i> <!-- Icono -->
                                            <span>Generar Lista Alumnos</span> <!-- Texto -->
                                        </a>
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        @foreach ($grupos as $grupo)
                        <div class="mobile-card d-lg-none">
                            <div class="row">
                                <div class="col-6"><label>Clave:</label></div>
                                <div class="col-6">{{ $grupo->clave }}</div>
                            </div>
                            <div class="row">
                                <div class="col-6"><label>Nombre:</label></div>
                                <div class="col-6">{{ $grupo->nombre }}</div>
                            </div>
                            <div class="row">
                                <div class="col-6"><label>Materia:</label></div>
                                <div class="col-6">{{ $grupo->materia_nombre }}</div>
                            </div>
                            <div class="row">
                                <div class="col-6"><label>Rango Alumnos Mínimo:</label></div>
                                <div class="col-6">{{ $grupo->min_alumnos }}</div>
                            </div>
                            <div class="row">
                                <div class="col-6"><label>Rango Alumnos Máximo:</label></div>
                                <div class="col-6">{{ $grupo->max_alumnos }}</div>
                            </div>
                            <div class="row">
                                <div class="col-6"><label>Horario inicio:</label></div>
                                <div class="col-6">{{ $grupo->hora_in }}</div>
                            </div>
                            <div class="row">
                                <div class="col-6"><label>Horario fin:</label></div>
                                <div class="col-6">{{ $grupo->hora_fn }}</div>
                            </div>
                            <div class="row">
                                <div class="col-6"><label>Alumnos inscritos:</label></div>
                                <div class="col-6">{{ $grupo->inscripcionesCount }}</div>
                            </div>
                            <div class="row">
                                <div class="col-6"><label>Acciones:</label></div>
                                < <div class="row action-buttons">
                                    @can('editar-grupos')
                                    <a href="{{ route('grupos.edit', $grupo->id) }}" class="btn btn-warning btn-mobile">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @endcan
                                    @can('eliminar-grupos')
                                    <form action="{{ route('grupos.destroy', $grupo->id) }}" method="POST" class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-mobile" onclick="return confirm('¿Estás seguro de eliminar este grupo?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                    @endcan
                                    <a href="{{ route('grupos.generarPDF', $grupo->id) }}" class="btn btn-primary btn-mobile">
                                        <i class="fas fa-file-excel"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
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
            [2, 5, 10, 20],
            [2, 5, 10, 20]
        ],
        columns: [
            { data: 'clave', title: 'Clave' },
            { data: 'nombre', title: 'Nombre' },
            { data: 'materia_nombre', title: 'Materia' },
            { data: 'min_alumnos', title: 'Rango Alumnos Mínimo' },
            { data: 'max_alumnos', title: 'Rango Alumnos Máximo' },
            { data: 'hora_in', title: 'Horario inicio' },
            { data: 'hora_fn', title: 'Horario fin' },
            { data: 'inscripcionesCount', title: 'Alumnos inscritos' },
            { data: 'Acciones', title: 'Acciones', orderable: false }
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
