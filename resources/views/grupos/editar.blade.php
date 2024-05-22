@extends('layouts.app')

@section('content')
<section class="section" style="background-color: #e0e0eb; min-height: 100vh; display: flex; align-items: center;">
    <div class="container custom-container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-header d-flex align-items-center justify-content-between bg-primary text-white">
                        <a href="{{ url()->previous() }}" class="btn btn-back text-white">
                            <i class="fas fa-arrow-left mr-2"></i> Regresar
                        </a>
                        <h3 class="page__heading text-center flex-grow-1 m-0">
                            <i class="fas fa-book mr-2"></i> Editar Grupo
                        </h3>
                    </div>
                    <div class="card-body p-4 bg-white">
                        @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>¡Revise los campos!</strong>
                            @foreach ($errors->all() as $error)
                            <ul class="list-unstyled">
                                <li>{{ $error }}</li>
                            </ul>
                            @endforeach
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        <form action="{{ route('grupos.update', $grupo->id) }}" method="POST" class="my-4">
                            @csrf
                            @method('PUT')
                            <div class="form-group floating-label">
                                <label for="clave">Clave</label>
                                <input type="text" name="clave" class="form-control" id="clave" value="{{ $grupo->clave }}">
                            </div>

                            <div class="form-group floating-label">
                                <label for="nombre">Nombre</label>
                                <input type="text" name="nombre" class="form-control" id="nombre" value="{{ $grupo->nombre }}">
                            </div>

                            <div class="form-group floating-label">
                                <label for="materia_id">Materia</label>
                                <select name="materia_id" class="form-control select2" id="materia_id">
                                    <option value="">Selecciona una materia</option>
                                    @foreach ($materias as $materia)
                                    <option value="{{ $materia->id }}" {{ $materia->id == $grupo->materia_id ? 'selected' : '' }}>{{ $materia->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group floating-label">
                                <label for="rango_alumnos_id">Rango de Alumnos</label>
                                <select name="rango_alumnos_id" class="form-control select2" id="rango_alumnos_id">
                                    <option value="">Selecciona un rango de alumnos</option>
                                    @foreach ($rangoAlumnos as $rango)
                                    <option value="{{ $rango->id }}" {{ $rango->id == $grupo->rango_alumnos_id ? 'selected' : '' }}>{{ $rango->min_alumnos }} - {{ $rango->max_alumnos }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group floating-label">
                                <label for="horario_id">Horario</label>
                                <select name="horario_id" class="form-control select2" id="horario_id">
                                    <option value="">Selecciona un horario</option>
                                    @foreach ($horarios as $horario)
                                    <option value="{{ $horario->id }}" {{ $horario->id == $grupo->horario_id ? 'selected' : '' }}>{{ $horario->hora_in }} - {{ $horario->hora_fn }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="activo">Estado del Grupo:</label>
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-outline-success btn-custom {{ $grupo->activo ? 'active' : '' }}">
                                        <input type="radio" name="activo" id="activo" value="1" {{ $grupo->activo ? 'checked' : '' }}> Activo
                                    </label>
                                    <label class="btn btn-outline-danger btn-custom {{ !$grupo->activo ? 'active' : '' }}">
                                        <input type="radio" name="activo" id="inactivo" value="0" {{ !$grupo->activo ? 'checked' : '' }}> Inactivo
                                    </label>
                                </div>
                            </div>
                            
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-block btn-submit">Guardar</button>
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
    document.addEventListener('DOMContentLoaded', function () {
        $('.select2').select2();

        $('input, select').focus(function() {
            $(this).parent().addClass('active');
        }).blur(function() {
            if ($(this).val() === '') {
                $(this).parent().removeClass('active');
            }
        });

        $('#clave').on('input', function(event) {
            var regex = /[^A-Za-z0-9]/g;
            var newValue = $(this).val().replace(regex, '');
            if (!/^[A-Za-z]$|^[A-Za-z][0-9]{0,3}$/.test(newValue)) {
                newValue = newValue.substring(0, 1) + newValue.substring(1).replace(/[^0-9]/g, '').substring(0, 3);
            }
            $(this).val(newValue);
        });

        $('#nombre').on('input', function(event) {
            var regex = /[^a-zA-Z\s]/g;
            var newValue = $(this).val().replace(regex, '');
            $(this).val(newValue);
        });
    });
</script>
@endsection

@section('styles')
<style>
    .bg-primary {
        background-color: #4b479c;
    }

    .form-label {
        font-weight: bold;
        color: #4b479c;
        margin-bottom: 5px;
        font-size: 16px;
    }

    .form-control {
        padding: 12px 15px;
        border: 1px solid #ccc;
        border-radius: 8px;
        width: 100%;
        box-sizing: border-box;
        transition: all 0.2s ease;
        font-size: 16px;
        background-color: #f9f9f9;
    }

    .form-control:focus {
        border-color: #4b479c;
        box-shadow: 0 0 8px rgba(75, 71, 156, 0.3);
        background-color: #fff;
    }

    .input-group-text {
        cursor: pointer;
    }

    .card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
    }

    .card-header {
        padding: 20px;
        background-color: #4b479c;
        border-bottom: none;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .card-header .btn-back {
        display: flex;
        align-items: center;
        font-size: 14px;
        padding: 8px 12px;
        border-radius: 8px;
        background-color: rgba(255, 255, 255, 0.1);
        transition: background-color 0.2s ease, color 0.2s ease;
    }

    .card-header .btn-back:hover {
        background-color: #fff;
        color: #4b479c;
    }

    .card-header .btn-back:hover .fa-arrow-left {
        color: #4b479c;
    }

    .card-header .page__heading {
        color: #ffffff;
    }

    .card-body {
        padding: 30px;
        background-color: #ffffff;
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .alert {
        margin-bottom: 20px;
    }

    .btn-submit {
        transition: all 0.3s ease;
        background-color: #4b479c;
        color: #fff;
        padding: 12px 20px;
        border: none;
        border-radius: 8px;
        font-size: 18px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
        background-color: #3a2c70;
    }

    .btn-submit:focus {
        outline: none;
        box-shadow: 0 0 10px rgba(75, 71, 156, 0.3);
    }

    .section {
        padding: 60px 0;
        background-color: #e0e0eb;
        min-height: 100vh;
        display: flex;
        align-items: center;
    }

    .custom-container {
        max-width: 800px;
        margin: auto;
        border: 3px solid #4b479c;
        border-radius: 15px;
        padding: 20px;
        background-color: #ffffff;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
    }

    .custom-container:hover {
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.3);
        transform: translateY(-2px);
    }

    @media (max-width: 768px) {
        .custom-container {
            padding: 0 20px;
        }
    }

    .select2-container .select2-selection--single {
        height: 45px;
        border-radius: 8px;
        padding: 8px;
        font-size: 16px;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 24px;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 34px;
    }

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

    .btn-custom {
        transition: all 0.3s ease;
        padding: 12px 20px;
        border: none;
        border-radius: 8px;
        font-size: 18px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .btn-outline-success {
        color: #28a745;
        border: 2px solid #28a745;
    }

    .btn-outline-danger {
        color: #dc3545;
        border: 2px solid #dc3545;
    }

    .btn-outline-success.active,
    .btn-outline-danger.active {
        color: #fff;
    }

    .btn-outline-success:hover,
    .btn-outline-danger:hover {
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
    }

    .btn-outline-success.active {
        background-color: #28a745;
    }

    .btn-outline-danger.active {
        background-color: #dc3545;
    }
</style>
@endsection
