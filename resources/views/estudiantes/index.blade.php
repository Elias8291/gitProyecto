@extends('layouts.app')

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
                
            
                        @can('crear-estudiante')
                        <a class="btn btn-warning" href="{{ route('estudiantes.create') }}">Nuevo</a>
                        @endcan
            
                        <table class="table table-striped mt-2" id="miTabla2">
                                <thead style="background-color:#6777ef">                                     
                                    <th style="color:#fff;">Número de Control</th>
                                    <th style="color:#fff;">Nombre</th>
                                    <th style="color:#fff;">Apellido Paterno</th>
                                    <th style="color:#fff;">Apellido Materno</th>
                                    <th style="color:#fff;">Semestre</th>
                                    <th style="color:#fff;">Acciones</th>                                                                 
                              </thead>
                              <tbody>
                            @foreach ($estudiantes as $estudiante)
                            <tr>                            
                                <td>{{ $estudiante->numeroDeControl }}</td>
                                <td>{{ $estudiante->nombre }}</td>
                                <td>{{ $estudiante->apellidoPaterno }}</td>
                                <td>{{ $estudiante->apellidoMaterno }}</td>
                                <td>{{ $estudiante->semestre }}</td>
                                
                                <td>
                                    <form action="{{ route('estudiantes.destroy',$estudiante->id) }}" method="POST">                                        
                                        @can('editar-estudiante')
                                        <a class="btn btn-info" href="{{ route('estudiantes.edit',$estudiante->id) }}">Editar</a>
                                        @endcan

                                        @csrf
                                        @method('DELETE')
                                        @can('borrar-estudiante')
                                        <button type="submit" class="btn btn-danger">Borrar</button>
                                        @endcan
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <!-- Ubicamos la paginacion a la derecha -->
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
        { numeroDeControl: 'Número de Control' },
        { nombre: 'Nombre' },
        { apellidoMaterno: 'Apellido Paterno' },
        { apellidoMaterno: 'Apellido Paterno' },
        { semestre: 'Semestre' },
        // { Guard_name: 'Guard_name'},
        { Acciones: 'Acciones' }
    ],

    language: {
        url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
    }
});
    </script>
@endsection