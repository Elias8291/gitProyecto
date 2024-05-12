@extends('layouts.app')
<style>
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

    .dataTables_filter input[type="search"]:focus + ::after {
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

    .dataTables_length select:focus + ::after {
        border-top-color: #333;
    }

    #miTabla2 {
        font-size: 14px;
    }
</style>
@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Logs</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="card-title">Lista de Logs</h4>
                        </div>
                        <div class="table-responsive">
                        <table class="table table-striped mt-2" id="miTabla2">
                            <thead style="background-color:#6777ef">
                                <tr>
                                    <th style="color:#fff;" class="text-center">Id</th>
                                    <th style="color:#fff;" class="text-center">Fecha</th>
                                    <th style="color:#fff;" class="text-center">Accion</th>
                                    <th style="color:#fff;" class="text-center">Tabla</th>
                                    <th style="color:#fff;" class="text-center">Id Afectado</th>
                                    <th style="color:#fff;" class="text-center">Ejecutada</th>
                                    <th style="color:#fff;" class="text-center">Inversa</th>
                                    <th style="color:#fff;" class="text-center">Usuario</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($logs as $log)
                                <tr>
                                    <td class="text-center">{{ $log->id }}</td>
                                    <td class="text-center">{{ $log->created_at }}</td>
                                    <td class="text-center">{{ $log->action }}</td>
                                    <td class="text-center">{{ $log->table }}</td>
                                    <td class="text-center">{{ $log->record_id }}</td>
                                    <td class="text-center">{{ $log->executedSQL }}</td>
                                    <td class="text-center">{{ $log->reverseSQL }}</td>
                                    <td class="text-center">{{ $log->user_name }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<!-- DATATABLES -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<!-- BOOTSTRAP -->
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#miTabla2').DataTable({
            lengthMenu: [
                [2, 5, 10, 20],
                [2, 5, 10, 20]
            ],
            columns: [
                { data: 'id', title: 'Id' },
                { data: 'created_at', title: 'Fecha' },
                { data: 'action', title: 'Accion' },
                { data: 'table', title: 'Tabla' },
                { data: 'record_id', title: 'Id Afectado' },
                { data: 'executedSQL', title: 'Ejecutada' },
                { data: 'reverseSQL', title: 'Inversa' },
                { data: 'user_name', title: 'Usuario' },
            ],
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
                search: "_INPUT_",
                searchPlaceholder: "Buscar...",
                lengthMenu: "Mostrar _MENU_ registros"
            },
            dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>rt<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            pageLength: 10
        });
    });
</script>
@endsection

@section('styles')
<style>
    /* Aquí puedes colocar los estilos CSS */
</style>
@endsection