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

    /* Estilos para los botones de acción en modo móvil */
    .action-buttons {
        display: flex;
        justify-content: space-between;
        padding: 12px 0;
    }

    .btn-mobile {
        flex: 0 1 48%;
        /* Cada botón ocupa el 48% del espacio */
        margin: 0;
        padding: 8px;
        border-radius: 4px;
        font-size: 0;
        /* Eliminar el texto */
        text-align: center;
        transition: all 0.3s ease;
    }

    .btn-mobile i {
        font-size: 20px;
        /* Aumentar el tamaño del icono */
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

        /* Estilos para los botones de acción en modo móvil */
        .action-buttons {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
        }

        .btn-mobile {
            flex: 0 1 48%;
            /* Cada botón ocupa el 48% del espacio */
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
    .custom-badge {
    background-color: #483eff;
    color: white; /* Cambia el color del texto a blanco para mejorar la legibilidad */
}

</style>

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Usuarios</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            @can('crear-materias')
                            <a class="btn btn-warning" href="{{ route('usuarios.create') }}">
                                <i class="fas fa-plus"></i> Nuevo Usuario
                            </a>
                            @endcan
                        </div>


                        <div class="table-responsive mt-3">
                            <table class="table table-striped mt-2" id="miTabla2">
                                <thead style="background-color:#4267F5">
                                    <tr>
                                        <th style="color:#fff;" class="text-center">Nombre</th>
                                        <th style="color:#fff;" class="text-center" >E-mail</th>
                                        <th style="color:#fff;" class="text-center">Rol</th>
                                        <th style="color:#fff;" class="text-center">Acciones</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($usuarios as $usuario)
                                    <tr>
                                        <td class="text-center">{{ $usuario->name }}</td>
                                        <td class="text-center">{{ $usuario->email }}</td>
                                        <td class="text-center">
                                            @foreach($usuario->getRoleNames() as $rolNombre)
                                            <h5><span class="badge custom-badge">{{ $rolNombre }}</span></h5>
                                            @endforeach
                                        </td>
                                        <td class="text-center">
                                            @can('editar-usuarios')
                                            <a href="{{ route('usuarios.edit', $usuario->id) }}"
                                                class="btn btn-warning mr-1">
                                                <i class="fas fa-edit"></i>Editar
                                            </a>
                                            @endcan

                                            <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <!-- Método DELETE -->
                                                @can('eliminar-usuarios')
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('¿Estás seguro de eliminar esta materia?')">
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
                            @foreach ($usuarios as $usuario)
                            <div class="mobile-card d-lg-none">
                                <div class="row">
                                    <div class="col-6"><label>Número de Control:</label></div>
                                    <div class="col-6">{{ $usuario->name }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-6"><label>Nombre:</label></div>
                                    <div class="col-6">{{ $usuario->email}}</div>
                                </div>

                                <div class="row">
                                    <div class="col-6"><label>Acciones:</label></div>
                                    <div class="row action-buttons">
                                        @can('editar-usuarios')
                                        <a href="{{ route('usuarios.edit', $usuario->id) }}"
                                            class="btn btn-warning btn-mobile">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @endcan
                                        @can('borrar-usuarios')
                                        <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST"
                                            class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-mobile"
                                                onclick="return confirm('¿Estás seguro de eliminar este estudiante?')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="pagination justify-content-end">
                            {!! $usuarios->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</section>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<!-- DATATABLES -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<!-- BOOTSTRAP -->
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script>
    new DataTable('#miTabla2', {
        lengthMenu: [
            [2, 5, 10, 15, 50],
            [2, 5, 10, 15, 50]
        ],
        columns: [
                { data: 'name', title: 'Nombre' },
                { data: 'email', title: 'E-mail' },
                { data: 'roles', title: 'Rol' },
                { data: 'actions', title: 'Acciones' }
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