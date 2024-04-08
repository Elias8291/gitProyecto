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
            
                        <table class="table table-striped mt-2">
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
                                    <form action="{{ route('estudiantes.destroy',$estudiante->numeroDeControl) }}" method="POST">                                        
                                        @can('editar-estudiante')
                                        <a class="btn btn-info" href="{{ route('estudiantes.edit',$estudiante->numeroDeControl) }}">Editar</a>
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
@endsection
