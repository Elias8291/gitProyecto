@extends('layouts.app')

@section('content')
<section class="section" style="background-image: url('ruta/a/tu/imagen-de-fondo.jpg'); background-size: cover;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header">
                        <h3 class="page__heading"><i class="fas fa-user-graduate mr-2"></i>Crear Estudiantes</h3>
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

                        <form action="{{ route('estudiantes.store') }}" method="POST" class="my-4">
                            @csrf
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <div class="floating-label">
                                            <label for="numeroDeControl">Número de Control</label>
                                            <input type="text" name="numeroDeControl" class="form-control" id="numeroDeControl" maxlength="8" pattern="[0-9]{8}" title="El número de control debe tener 8 dígitos numéricos" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <div class="floating-label">
                                            <label for="nombre">Nombre</label>
                                            <input type="text" name="nombre" class="form-control" id="nombre">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <div class="floating-label">
                                            <label for="apellidoPaterno">Apellido Paterno</label>
                                            <input type="text" name="apellidoPaterno" class="form-control" id="apellidoPaterno">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <div class="floating-label">
                                            <label for="apellidoMaterno">Apellido Materno</label>
                                            <input type="text" name="apellidoMaterno" class="form-control" id="apellidoMaterno">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <div class="floating-label">
                                            <label for="semestre">Semestre</label>
                                            <select name="semestre" class="form-control" id="semestre" required>
                                                <option value="" disabled selected>Seleccione el semestre</option>
                                                @for ($i = 1; $i <= 10; $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
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
    // Agrega la clase 'active' cuando un campo de entrada está enfocado
    $('input').focus(function() {
        $(this).parent().addClass('active');
    }).blur(function() {
        if ($(this).val() === '') {
            $(this).parent().removeClass('active');
        }
    });

    // Validación en tiempo real para "Número de Control"
    $('#numeroDeControl').on('input', function(event) {
        var regex = /[^0-9]/g;
        var newValue = $(this).val().replace(regex, '');
        if (newValue.length > 8) {
            newValue = newValue.substring(0, 8);
        }
        $(this).val(newValue);
    });

    // Validación en tiempo real para los campos de nombre y apellidos
    $('#nombre').on('input', function(event) {
        var regex = /[^a-zA-Z\s]/g;
        var newValue = $(this).val().replace(regex, '');
        $(this).val(newValue);
    });

    $('#apellidoPaterno, #apellidoMaterno').on('input', function(event) {
        var regex = /[^a-zA-Z]/g; // Elimina también los espacios para apellidos
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
    .floating-label input:not(:placeholder-shown) ~ label {
        top: -20px;
        font-size: 12px;
        color: #333;
    }

    .floating-label select:focus ~ label,
    .floating-label select:not(:placeholder-shown) ~ label {
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
