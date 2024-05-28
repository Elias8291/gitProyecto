@extends('layouts.app')
<style>
    /* Estilos para la tabla y otros elementos */
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
                                <i class="fas fa-plus"></i>
                                <span>Nuevo Grupo</span>
                            </a>
                            @endcan
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped mt-2" id="miTabla2">
                                <thead style="background-color:#5f42d4">
                                    <tr>
                                        <th style="color:#fff;" class="text-center">Clave</th>
                                        <th style="color:#fff;" class="text-center">Nombre</th>
                                        <th style="color:#fff;" class="text-center">Materia</th>
                                        <th style="color:#fff;" class="text-center">Rango de Alumnos</th>
                                        <th style="color:#fff;" class="text-center">Horario</th>
                                        <th style="color:#fff;" class="text-center">Alumnos inscritos</th>
                                        <th style="color:#fff;" class="text-center">Estado</th>
                                        <th style="color:#fff;" class="text-center">Periodo</th>
                                        <th style="color:#fff;" class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($grupos as $grupo)
                                    <tr>
                                        <td class="text-center">{{ $grupo->clave }}</td>
                                        <td class="text-center">{{ $grupo->nombre }}</td>
                                        <td class="text-center">{{ $grupo->materia_nombre }}</td>
                                        <td class="text-center">{{ $grupo->rango_alumnos }}</td>
                                        <td class="text-center">{{ $grupo->hora_in }} - {{ $grupo->hora_fn }}</td>
                                        <td class="text-center">{{ $grupo->inscripcionesCount }}</td>
                                        <td class="text-center">
                                            @if($grupo->activo)
                                            <button class="btn btn-estado btn-activo" style="color: #06b423">
                                                <i class="fas fa-check"></i> Activo
                                            </button>
                                            @else
                                            <button class="btn btn-estado btn-inactivo" style="color: #f5270c">
                                                <i class="fas fa-times"></i> Inactivo
                                            </button>
                                            @endif
                                        </td>
                                        <td class="text-center">{{ $grupo->periodo_nombre }}</td>
                                        <td>
                                            <div class="action-buttons">
                                                @can('editar-grupos')
                                                <a href="{{ route('grupos.edit', $grupo->id) }}" class="edit-btn" style="text-decoration: none;">
                                                    <span class="icon">✏️</span> Editar
                                                </a>
                                                @endcan

                                                @can('ver_excel_grupo')
                                                <button class="btn-excel btn" onclick="window.location.href='{{ route('grupos.generarPDF', $grupo->id) }}'" title="Generar PDF">
                                                    <i class="fas fa-file-excel" style="margin-right: 8px; color:#06b423"></i> Generar Excel
                                                </button>
                                                @endcan
                                                @can('eliminar-grupos')
                                                @if ($grupo->inscripcionesCount == 0)
                                                <form id="eliminar-form-{{ $grupo->id }}" action="{{ route('grupos.destroy', $grupo->id) }}" method="POST" class="d-inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="delete-btn btn" onclick="confirmarEliminacion({{ $grupo->id }})">
                                                        <i class="fas fa-trash-alt" style="margin-right: 8px; color:#ef0404"></i> Eliminar
                                                    </button>
                                                </form>
                                                @else
                                                <button class="delete-btn" disabled style="cursor: not-allowed;">
                                                    <span class="icon"><i class="fas fa-trash-alt "></i></span> Eliminar
                                                </button>
                                                @endif
                                                @endcan
                                            </div>
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
                                    <div class="col-6"><label>Rango de Alumnos:</label></div>
                                    <div class="col-6">{{ $grupo->rango_alumnos }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-6"><label>Horario:</label></div>
                                    <div class="col-6">{{ $grupo->hora_in }} - {{ $grupo->hora_fn }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-6"><label>Alumnos inscritos:</label></div>
                                    <div class="col-6">{{ $grupo->inscripcionesCount }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-6"><label>Estado:</label></div>
                                    <div class="col-6">
                                        @if($grupo->activo)
                                        <button class="btn btn-estado btn-activo" style="color: #06b423">
                                            <i class="fas fa-check"></i> Activo
                                        </button>
                                        @else
                                        <button class="btn btn-estado btn-inactivo" style="color: #f5270c">
                                            <i class="fas fa-times"></i> Inactivo
                                        </button>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6"><label>Periodo:</label></div> <!-- Mostrar el periodo -->
                                    <div class="col-6">{{ $grupo->periodo_nombre }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-6"><label>Acciones:</label></div>
                                    <div class="col-6">
                                        <div class="row action-buttons">
                                            @can('editar-grupos')
                                            <div class="col-6 mb-2">
                                                <a href="{{ route('grupos.edit', $grupo->id) }}" class="edit-btn" style="text-decoration: none;">
                                                    <span class="icon">✏️</span> Editar
                                                </a>
                                            </div>
                                            @endcan

                                            @can('ver_excel_grupo')
                                            <div class="col-6 mb-2">
                                                <button class="btn-excel btn" onclick="window.location.href='{{ route('grupos.generarPDF', $grupo->id) }}'" title="Generar PDF">
                                                    <i class="fas fa-file-excel" style="margin-right: 8px; color:#06b423"></i> Generar Excel
                                                </button>
                                            </div>
                                            @endcan

                                            @if ($grupo->inscripcionesCount == 0)
                                            <div class="col-6 mb-2">
                                                <form id="eliminar-form-{{ $grupo->id }}" action="{{ route('grupos.destroy', $grupo->id) }}" method="POST" class="d-inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="delete-btn btn" onclick="confirmarEliminacion({{ $grupo->id }})">
                                                        <i class="fas fa-trash-alt" style="margin-right: 8px; color:#ef0404"></i> Eliminar
                                                    </button>
                                                </form>
                                            </div>
                                            @else
                                            <div class="col-6 mb-2">
                                                @can('eliminar-grupos')
                                                <button class="delete-btn" disabled style="cursor: not-allowed;">
                                                    <span class="icon"><i class="fas fa-trash-alt"></i></span> Eliminar
                                                </button>
                                                @endcan
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        @endforeach
                        
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
            { data: 'rango_alumnos', title: 'Rango de Alumnos' },
            { data: 'horario', title: 'Horario' },
            { data: 'inscripcionesCount', title: 'Alumnos inscritos' },
            { data: 'activo', title: 'Estado' },
            { data: 'periodo_nombre', title: 'Periodo' },
            { data: 'acciones', title: 'Acciones' },
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

    function confirmarEliminacion(grupoId) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminarlo',
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('eliminar-form-' + grupoId).submit();
                Swal.fire({
                    title: 'Eliminado!',
                    text: 'El grupo ha sido eliminado correctamente.',
                    icon: 'success',
                    timer: 4000, // Duración en milisegundos
                    showConfirmButton: false,
                    customClass: {
                        confirmButton: 'btn btn-success'
                    },
                    buttonsStyling: false
                });
            }
        });
    }
</script>
<style>
    .custom-popup {
        background-color: #f9f9f9;
        border: 1px solid #ddd;
        border-radius: 8px;
    }
    .custom-title {
        color: #333;
        font-weight: bold;
    }
    .custom-content {
        color: #666;
    }
    .custom-confirm-button {
        background-color: #3085d6 !important;
        color: #fff !important;
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


    @media (max-width: 992px) {
        #miTabla2 {
            display: none;
        }

        .mobile-table {
            display: block;
        }

        .mobile-card {
        background: #fff;
        border: 1px solid #ddd; /* Añadir borde */
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

    .btn-warning.btn-mobile {
        background-color: #ffc107;
        color: #212529;
    }

    .btn-danger.btn-mobile {
        background-color: #dc3545;
        color: #fff;
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

        .mobile-table {
            display: none;
        }

        .dataTables_length,
        .dataTables_filter,
        .dataTables_paginate {
            display: none !important;
        }
    }

    @media (min-width: 993px) {
        .mobile-table {
            display: none;
        }
    }
</style>
@endsection
