@extends('layouts.app')

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