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
                            <i class="fas fa-book mr-2"></i>Crear Usuario
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

                        {!! Form::open(array('route' => 'usuarios.store','method'=>'POST', 'class' => 'my-4')) !!}
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <div class="floating-label">
                                        <label for="name">Nombre</label>
                                        {!! Form::text('name', null, array('class' => 'form-control', 'placeholder' => 'Nombre', 'oninput' => 'validateName(this)')) !!}
                                    </div>
                                </div>
                            </div>                            
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <div class="floating-label">
                                        <label for="email">E-mail</label>
                                        {!! Form::text('email', null, array('class' => 'form-control', 'placeholder' => 'E-mail')) !!}
                                       
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <div class="floating-label">
                                        <label for="password">Password</label>
                                        {!! Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password')) !!}
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <div class="floating-label">
                                        <label for="confirm-password">Confirmar Password</label>
                                        {!! Form::password('confirm-password', array('class' => 'form-control', 'placeholder' => 'Confirmar Password')) !!}
                                    
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="" class="form-control-label">Roles</label>
                                    {!! Form::select('roles[]', $roles,[], array('class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
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

    // Agrega la clase 'active' cuando un campo de entrada está enfocado
    $('input').focus(function() {
        $(this).parent().addClass('active');
    }).blur(function() {
        if ($(this).val() === '') {
            $(this).parent().removeClass('active');
        }
    });

    // Evita que se ingresen letras o números en tiempo real
    $('input').on('input', function(event) {
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
    top: 50%;
    left: 10px;
    transform: translateY(-50%);
    transition: all 0.2s ease;
    color: #999;
    pointer-events: none;
    background-color: white;
    padding: 0 5px;
    font-size: 14px;
}

.floating-label input:focus ~ label,
.floating-label input:not(:placeholder-shown) ~ label {
    top: -10px;
    font-size: 12px;
    color: #333;
}

.floating-label input {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    width: 100%;
    box-sizing: border-box;
    transition: all 0.2s ease;
}

.floating-label input:focus {
    border-color: #2c0197;
    box-shadow: 0 0 5px rgba(44, 1, 151, 0.3);
}

.card {
    border: none;
    border-radius: 8px;
    overflow: hidden;
}

.card-header {
    background-color: #f8f9fa;
    border-bottom: 1px solid #e9ecef;
    padding: 15px;
}

.card-header .btn-back {
    color: #2c0197;
}

.card-header .page__heading {
    color: #333;
}

.card-body {
    padding: 20px;
}

.alert {
    margin-bottom: 20px;
}

.btn-submit {
    transition: all 0.3s ease;
    background-color: #2c0197;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    font-size: 16px;
}

.btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    background-color: #1e015b;
}

.btn-submit:focus {
    outline: none;
    box-shadow: 0 0 5px rgba(44, 1, 151, 0.3);
}

.section {
    padding: 60px 0;
    background-size: cover;
    background-position: center;
}

.container {
    max-width: 800px;
    margin: auto;
}

@media (max-width: 768px) {
    .container {
        padding: 0 20px;
    }
}

</style>
@endsection