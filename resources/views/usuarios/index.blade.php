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
                    <div class="card-header">
                        <form action="{{ route('usuarios.index') }}" method="GET" class="row">
                            <div class="col">
                                <input type="text" name="search" class="form-control" placeholder="Buscar usuario..." value="{{ request()->query('search') }}">
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-primary" type="submit">Buscar</button>
                            </div>
                            <div class="col-auto">
                              <select name="size" class="form-control" onchange="this.form.submit()">
                                  @for ($i = 1; $i <= $totalUsuarios; $i++)
                                      <option value="{{ $i }}" {{ request()->query('size') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                  @endfor
                              </select>
                          </div>
                                               
                        </form>
                    </div>
                    <div class="card-body">
                        <a class="btn btn-warning" href="{{ route('usuarios.create') }}">Nuevo</a>
                        <table class="table table-striped mt-2">
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
                        <!-- Paginación Personalizada -->
                        @if ($usuarios->total() > 0)
                        <nav>
                            <ul class="pagination">
                                @for ($i = 1; $i <= $usuarios->lastPage(); $i++)
                                    <li class="page-item {{ ($usuarios->currentPage() == $i) ? ' active' : '' }}">
                                        <a class="page-link" href="{{ $usuarios->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor
                            </ul>
                        </nav>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
