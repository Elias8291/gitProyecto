@extends('layouts.app')

@section('content')
<section class="section" style="background-image: url('ruta/a/tu/imagen-de-fondo.jpg'); background-size: cover;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <a href="{{ url()->previous() }}" class="btn btn-back" style="color: #2c0197">
                            <i class="fas fa-arrow-left" style="color: #333"></i> Regresar
                        </a>
                        <h3 class="page__heading text-center flex-grow-1 m-0">
                            <i class="fas fa-book mr-2"></i>Editar Grupo
                        </h3>
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
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="activo">Estado del Grupo:</label>
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                            <label class="btn btn-outline-success {{ $grupo->activo ? 'active' : '' }}">
                                                <input type="radio" name="activo" id="activo" value="1" {{ $grupo->activo ? 'checked' : '' }}> Activo
                                            </label>
                                            <label class="btn btn-outline-danger {{ !$grupo->activo ? 'active' : '' }}">
                                                <input type="radio" name="activo" id="inactivo" value="0" {{ !$grupo->activo ? 'checked' : '' }}> Inactivo
                                            </label>
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

    // Validación en tiempo real para el campo "Clave"
    $('#clave').on('input', function(event) {
        var regex = /[^A-Za-z0-9]/g;
        var newValue = $(this).val().replace(regex, '');
        // Limita a una letra y tres números
        if (!/^[A-Za-z]$|^[A-Za-z][0-9]{0,3}$/.test(newValue)) {
            newValue = newValue.substring(0, 1) + newValue.substring(1).replace(/[^0-9]/g, '').substring(0, 3);
        }
        $(this).val(newValue);
    });

    // Validación en tiempo real para el campo "Nombre"
    $('#nombre').on('input', function(event) {
        var regex = /[^a-zA-Z\s]/g;
        var newValue = $(this).val().replace(regex, '');
        $(this).val(newValue);
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
    .btn-outline-success, .btn-outline-danger {
    border-width: 2px; /* Grosor del borde */
}

.btn-outline-success.active, .btn-outline-danger.active {
    color: #fff; /* Color del texto cuando el botón está activo */
}

.btn-outline-success {
    color: #28a745; /* Color del texto del botón activo */
    border-color: #28a745; /* Color del borde del botón activo */
}

.btn-outline-danger {
    color: #dc3545; /* Color del texto del botón inactivo */
    border-color: #dc3545; /* Color del borde del botón inactivo */
}

.btn-outline-success:hover, .btn-outline-danger:hover {
    color: #fff; /* Color del texto al pasar el mouse */
    background-color: #28a745; /* Fondo del botón activo al pasar el mouse */
}

.btn-outline-danger:hover {
    background-color: #dc3545; /* Fondo del botón inactivo al pasar el mouse */
}

</style>
@endsection