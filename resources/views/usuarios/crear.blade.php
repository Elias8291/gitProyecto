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
                            <i class="fas fa-user-plus mr-2"></i> Crear Usuario
                        </h3>
                    </div>
                    <div class="card-body p-4 bg-white">
                        @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>¡Revise los campos!</strong>
                            @foreach ($errors->all() as $error)
                            <span class="badge badge-danger">{{ $error }}</span>
                            @endforeach
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        <!-- Aquí añadimos el atributo enctype -->
                        {!! Form::open(['route' => 'usuarios.store', 'method' => 'POST', 'class' => 'my-4', 'enctype' => 'multipart/form-data']) !!}

                        <!-- Primera Parte: Datos Básicos -->
                        <h5 class="text-center mb-4">Datos Básicos</h5>
                        <div class="form-group">
                            <label for="name" class="form-label">Nombre</label>
                            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nombre', 'oninput' => 'validateName(this)']) !!}
                        </div>
                        <div class="form-group">
                            <label for="apellido_paterno" class="form-label">Apellido Paterno</label>
                            {!! Form::text('apellido_paterno', null, ['class' => 'form-control', 'placeholder' => 'Apellido Paterno', 'oninput' => 'validateName(this)']) !!}
                        </div>
                        <div class="form-group">
                            <label for="apellido_materno" class="form-label">Apellido Materno</label>
                            {!! Form::text('apellido_materno', null, ['class' => 'form-control', 'placeholder' => 'Apellido Materno', 'oninput' => 'validateName(this)']) !!}
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-label">E-mail</label>
                            {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'E-mail']) !!}
                        </div>

                        <!-- Botón para continuar a la segunda parte -->
                        <div class="text-center">
                            <button type="button" class="btn btn-primary btn-block" id="nextButton">Continuar</button>
                        </div>

                        <!-- Segunda Parte: Datos Adicionales (oculta por defecto) -->
                        <div id="additionalFields" style="display: none;">
                            <h5 class="text-center mb-4">Datos Adicionales</h5>
                            <div class="form-group">
                                <label for="telefono" class="form-label">Teléfono</label>
                                {!! Form::tel('telefono', null, ['class' => 'form-control', 'placeholder' => 'Teléfono']) !!}
                            </div>
                            
                            <div class="form-group">
                                <label for="image" class="form-label">Imagen</label>
                                <!-- Este es el campo correcto para la subida de archivos -->
                                {!! Form::file('image', ['class' => 'form-control']) !!}
                            </div>
                            
                            <div class="form-group">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password', 'id' => 'password']) !!}
                                    <div class="input-group-append">
                                        <span class="input-group-text" onclick="togglePasswordVisibility('password')">
                                            <i class="fas fa-eye" id="togglePasswordIcon-password"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="password_confirmation" class="form-label">Confirmar Password</label>
                                <div class="input-group">
                                    {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Confirmar Password', 'id' => 'password_confirmation']) !!}
                                    <div class="input-group-append">
                                        <span class="input-group-text" onclick="togglePasswordVisibility('password_confirmation')">
                                            <i class="fas fa-eye" id="togglePasswordIcon-password_confirmation"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="roles" class="form-control-label">Roles</label>
                                {!! Form::select('roles[]', $roles, [], [
                                    'class' => 'form-control select2', 
                                    'multiple' => 'multiple', 
                                    'style' => 'width: 100%;'
                                ]) !!}
                            </div>
                            <div class="text-center" >
                                <button type="submit" class="btn btn-primary btn-block btn-submit">Guardar</button>
                            </div>
                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    function validateName(input) {
        var regex = /^[a-zA-Z\s]*$/;
        if (!regex.test(input.value)) {
            input.setCustomValidity('El nombre solo debe contener letras y espacios.');
        } else {
            input.setCustomValidity('');
        }
    }

    function togglePasswordVisibility(fieldId) {
        var field = document.getElementById(fieldId);
        var icon = document.getElementById('togglePasswordIcon-' + fieldId);
        if (field.type === 'password') {
            field.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            field.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }

    $(document).ready(function() {
        $('.select2').select2({
            width: '100%',
            dropdownAutoWidth: true
        });

        $('#nextButton').on('click', function() {
            $('#additionalFields').show();
            $(this).hide(); // Oculta el botón de continuar
        });
    });
</script>
@endsection

@section('styles')
<style>
    /* Asegura que el contenedor de Select2 ocupe el 100% del ancho */
    .select2-container {
        width: 100% !important;
    }

    /* Ajusta el ancho del desplegable */
    .select2-dropdown {
        width: auto !important;
        min-width: 100% !important;
        box-sizing: border-box;
    }

    /* Ajusta el ancho de las opciones seleccionadas */
    .select2-selection__rendered {
        max-width: 100% !important;
        word-wrap: break-word !important;
    }

    /* Ajusta la altura del select para múltiples selecciones */
    .select2-selection--multiple {
        min-height: 38px;
    }

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
        transition: background-color 0.2s ease;
    }

    .card-header .btn-back:hover {
        background-color: rgba(255, 255, 255, 0.2);
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
</style>
@endsection
