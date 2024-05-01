@extends('layouts.app')

@section('content')
<section class="section" style="background-image: url('ruta/a/tu/imagen-de-fondo.jpg'); background-size: cover;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header">
                        <h3 class="page__heading"><i class="fas fa-users mr-2"></i>Editar Grupo</h3>
                    </div>
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

                        <form action="{{ route('grupos.update', $grupo->id) }}" method="POST" class="my-4">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <div class="floating-label">
                                            <label for="clave">Clave</label>
                                            <input type="text" name="clave" class="form-control" id="clave" value="{{ $grupo->clave }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <div class="floating-label">
                                            <label for="nombre">Nombre</label>
                                            <input type="text" name="nombre" class="form-control" id="nombre" value="{{ $grupo->nombre }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <div class="floating-label">
                                            <label for="materia_id">Materia</label>
                                            <select name="materia_id" class="form-control" id="materia_id">
                                                <option value="">Selecciona una materia</option>
                                                @foreach ($materias as $materia)
                                                <option value="{{ $materia->id }}" {{ $materia->id == $grupo->materia_id ? 'selected' : '' }}>{{ $materia->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <div class="floating-label">
                                            <label for="rango_alumnos_id">Rango de Alumnos</label>
                                            <select name="rango_alumnos_id" class="form-control" id="rango_alumnos_id">
                                                <option value="">Selecciona un rango de alumnos</option>
                                                @foreach ($rangoAlumnos as $rango)
                                                <option value="{{ $rango->id }}" {{ $rango->id == $grupo->rango_alumnos_id ? 'selected' : '' }}>{{ $rango->min_alumnos }} - {{ $rango->max_alumnos }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <div class="floating-label">
                                            <label for="horario_id">Horario</label>
                                            <select name="horario_id" class="form-control" id="horario_id">
                                                <option value="">Selecciona un horario</option>
                                                @foreach ($horarios as $horario)
                                                <option value="{{ $horario->id }}" {{ $horario->id == $grupo->horario_id ? 'selected' : '' }}>{{ $horario->hora_in }} - {{ $horario->hora_fn }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary btn-block btn-submit">Guardar</button>
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

@section('scripts')
<script>
    // Agrega la clase 'active' cuando un campo de entrada o selección está enfocado
    $('input, select').focus(function() {
        $(this).parent().addClass('active');
    }).blur(function() {
        if ($(this).val() === '') {
            $(this).parent().removeClass('active');
        }
    });
</script>
@endsection

@section('styles')
<style>
    .floating-label {
        position: relative;
        margin-bottom: 20px;
    }

    .floating-label label {
        position: absolute;
        top: 0;
        left: 0;
        pointer-events: none;
        transition: all 0.2s ease;
        color: #999;
    }

    .floating-label input:focus ~ label,
    .floating-label input:not(:placeholder-shown) ~ label,
    .floating-label select:focus ~ label,
    .floating-label select:not([value=""]) ~ label {
        top: -20px;
        font-size: 12px;
        color: #333;
    }

    .btn-submit {
        transition: all 0.3s ease;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
</style>
@endsection