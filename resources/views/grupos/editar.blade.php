@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Editar Grupo</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-dark alert-dismissible fade show" role="alert">
                                    <strong>¡Revise los campos!</strong>
                                    @foreach ($errors->all() as $error)
                                        <span class="badge badge-danger">{{ $error }}</span>
                                    @endforeach
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <form action="{{ route('grupos.update', $grupo->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="clave">Clave</label>
                                            <input type="text" name="clave" class="form-control" id="clave" value="{{ $grupo->clave }}">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="nombre">Nombre</label>
                                            <input type="text" name="nombre" class="form-control" id="nombre" value="{{ $grupo->nombre }}">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="materia_id">Materia</label>
                                            <select name="materia_id" class="form-control" id="materia_id">
                                                <option value="">Selecciona una materia</option>
                                                @foreach ($materias as $materia)
                                                    <option value="{{ $materia->id }}" {{ $materia->id == $grupo->materia_id ? 'selected' : '' }}>{{ $materia->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="rango_alumnos_id">Rango de Alumnos</label>
                                            <select name="rango_alumnos_id" class="form-control" id="rango_alumnos_id">
                                                <option value="">Selecciona un rango de alumnos</option>
                                                @foreach ($rangoAlumnos as $rango)
                                                    <option value="{{ $rango->id }}" {{ $rango->id == $grupo->rango_alumnos_id ? 'selected' : '' }}>{{ $rango->min_alumnos }} - {{ $rango->max_alumnos }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="horario_id">Horario</label>
                                            <select name="horario_id" class="form-control" id="horario_id">
                                                <option value="">Selecciona un horario</option>
                                                @foreach ($horarios as $horario)
                                                    <option value="{{ $horario->id }}" {{ $horario->id == $grupo->horario_id ? 'selected' : '' }}>{{ $horario->hora_in }} - {{ $horario->hora_fn }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                        <br>
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection