@extends('layouts.app')

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
                        <a class="btn btn-warning" href="{{ route('usuarios.create') }}">Nuevo</a>
                        <table id="miTabla" class="table table-striped mt-2">
                            <thead style="background-color:#6777ef">
                                <th style="color:#fff;">Nombre</th>
                                <th style="color:#fff;">E-mail</th>
                                <th style="color:#fff;">Rol</th>
                                <th style="color:#fff;">Acciones</th>
                            </thead>
                            <tbody>
                                @foreach ($usuarios as $usuario)
                                <tr>
                                    <td>{{ $usuario->name }}</td>
                                    <td>{{ $usuario->email }}</td>
                                    <td>
                                        @foreach($usuario->getRoleNames() as $rolNombre)
                                        <h5><span class="badge badge-dark">{{ $rolNombre }}</span></h5>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a class="btn btn-info" href="{{ route('usuarios.edit', $usuario->id) }}">Editar</a>
                                        <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" style="display: inline-block;">
                                          @csrf
                                          @method('DELETE')
                                          <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de querer eliminar este usuario?');">
                                              Eliminar
                                          </button>
                                      </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                       <div class="pagination justify-content-end">
                            {!! $usuarios->links() !!}
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
        $(document).ready(function() {
            $('#miTabla').DataTable({
                lengthMenu: [
                    [2, 5, 10],
                    [2, 5, 10]
                ],
                searching: true, // Habilita la búsqueda
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
                },
                columns: [
                    { data: 'name', title: 'Nombre' },
                    { data: 'email', title: 'E-mail' },
                    { data: 'roles', title: 'Rol' },
                    { data: 'actions', title: 'Acciones' }
                ]
            });
        });
    </script>
@endsection
