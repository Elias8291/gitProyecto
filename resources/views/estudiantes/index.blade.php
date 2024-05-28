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
        background-color: #483eff;
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
        text-align: center; /* Center text in table cells */
    }

    #miTabla2 tbody td .custom-badge {
        background-color: #000000;
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
        display: inline-block;
        margin: 5px 0; /* Add margin to buttons for spacing */
    }

    #miTabla2 tbody td .btn-warning {
        background-color: #fff;
        color: #212529;
    }

    #miTabla2 tbody td .btn-warning:hover {
        background-color: #e0a800;
    }

    #miTabla2 tbody td .btn-danger {
        background-color: #fff;
        color: #041014;
    }

    #miTabla2 tbody td .btn-danger:hover {
        background-color: #c82333;
    }

    .css-button-sliding-to-left--red {
        min-width: 130px;
        height: 40px;
        color: #fff;
        padding: 5px 10px;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        display: inline-block;
        outline: none;
        border-radius: 5px;
        z-index: 0;
        background: #fff;
        overflow: hidden;
        border: 2px solid #d90429;
        color: #d90429;
    }

    .css-button-sliding-to-left--red:hover {
        color: #fff;
    }

    .css-button-sliding-to-left--red:hover:after {
        width: 100%;
    }

    .css-button-sliding-to-left--red:after {
        content: "";
        position: absolute;
        z-index: -1;
        transition: all 0.3s ease;
        left: 0;
        top: 0;
        width: 0;
        height: 100%;
        background: #d90429;
    }

    .css-button-sliding-to-left--yellow {
        min-width: 130px;
        height: 40px;
        color: #fff;
        padding: 5px 10px;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        display: inline-block;
        outline: none;
        border-radius: 5px;
        z-index: 0;
        background: #fff;
        overflow: hidden;
        border: 2px solid #ffd819;
        color: #ffd819;
    }

    .css-button-sliding-to-left--yellow:hover {
        color: #fff;
    }

    .css-button-sliding-to-left--yellow:hover:after {
        width: 100%;
    }

    .css-button-sliding-to-left--yellow:after {
        content: "";
        position: absolute;
        z-index: -1;
        transition: all 0.3s ease;
        left: 0;
        top: 0;
        width: 0;
        height: 100%;
        background: #ffd819;
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

        @media (max-width: 992px) {
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

    .custom-badge {
        background-color: #483eff;
        color: white;
    }
</style>

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Estudiantes</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            @can('crear-estudiante')
                            <a class="btn btn-warning css-button-sliding-to-left--yellow" href="{{ route('estudiantes.create') }}">
                                <i class="fas fa-plus"></i> Nuevo Alumno
                            </a>
                            @endcan
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped mt-2" id="miTabla2">
                                <thead style="background-color:#5f42d4">
                                    <tr>
                                        <th style="color:#fff;" class="text-center">Número de Control</th>
                                        <th style="color:#fff;" class="text-center">Nombre</th>
                                        <th style="color:#fff;" class="text-center">Apellido Paterno</th>
                                        <th style="color:#fff;" class="text-center">Apellido Materno</th>
                                        <th style="color:#fff;" class="text-center">Semestre</th>
                                        <th style="color:#fff;" class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($estudiantes as $estudiante)
                                    <tr>
                                        <td class="text-center">{{ $estudiante->numeroDeControl }}</td>
                                        <td class="text-center">{{ $estudiante->nombre }}</td>
                                        <td class="text-center">{{ $estudiante->apellidoPaterno }}</td>
                                        <td class="text-center">{{ $estudiante->apellidoMaterno }}</td>
                                        <td class="text-center">{{ $estudiante->semestre }}</td>
                                        <td class="text-center">
                                            @can('editar-estudiante')
                                            <a href="{{ route('estudiantes.edit', $estudiante->id) }}" class="btn btn-warning css-button-sliding-to-left--yellow">
                                                <i class="fas fa-edit"></i> Editar
                                            </a>
                                            @endcan
                                            @can('eliminar-estudiante')
                                            <button type="button" class="btn btn-danger css-button-sliding-to-left--red" onclick="confirmarEliminacion({{ $estudiante->id }})">
                                                <i class="fas fa-trash-alt"></i> Eliminar
                                            </button>
                                            <form id="eliminar-form-{{ $estudiante->id }}" action="{{ route('estudiantes.destroy', $estudiante->id) }}" method="POST" class="d-none">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            @endcan
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @foreach ($estudiantes as $estudiante)
                            <div class="mobile-card d-lg-none">
                                <div class="row">
                                    <div class="col-6"><label>Número de Control:</label></div>
                                    <div class="col-6">{{ $estudiante->numeroDeControl }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-6"><label>Nombre:</label></div>
                                    <div class="col-6">{{ $estudiante->nombre }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-6"><label>Apellido Paterno:</label></div>
                                    <div class="col-6">{{ $estudiante->apellidoPaterno }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-6"><label>Apellido Materno:</label></div>
                                    <div class="col-6">{{ $estudiante->apellidoMaterno }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-6"><label>Semestre:</label></div>
                                    <div class="col-6">{{ $estudiante->semestre }}</div>
                                </div>
                                <div class="row action-buttons">
                                    @can('editar-estudiante')
                                    <a href="{{ route('estudiantes.edit', $estudiante->id) }}"
                                        class="btn btn-warning btn-mobile">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                    @endcan
                                    @can('eliminar-estudiante')
                                    <button type="button" class="btn btn-danger btn-mobile"
                                        onclick="confirmarEliminacion({{ $estudiante->id }})">
                                        <i class="fas fa-trash-alt"></i> Eliminar
                                    </button>
                                    <form id="eliminar-form-{{ $estudiante->id }}"
                                        action="{{ route('estudiantes.destroy', $estudiante->id) }}" method="POST"
                                        class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    @endcan
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="pagination justify-content-end">
                            {!! $estudiantes->links() !!}
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
            [2, 5, 10, 15, 50],
            [2, 5, 10, 15, 50]
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
