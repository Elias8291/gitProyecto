@extends('layouts.app')

@section('content')
<section class="section" style="background-image: url('ruta/a/tu/imagen-de-fondo.jpg'); background-size: cover;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header d-flex align-items-center justify-content-between bg-primary text-white">
                        <a href="{{ url()->previous() }}" class="btn btn-back text-white">
                            <i class="fas fa-arrow-left mr-2"></i> Regresar
                        </a>
                        <h3 class="page__heading text-center flex-grow-1 m-0">
                            <i class="fas fa-book mr-2"></i>Editar Materia
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

                        <form action="{{ route('materias.update', $materia->id) }}" method="POST" class="my-4">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <div class="floating-label">
                                    <label for="clave">Clave</label>
                                    <input type="text" name="clave" class="form-control" id="clave" value="{{ $materia->clave }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="floating-label">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" name="nombre" class="form-control" id="nombre" value="{{ $materia->nombre }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="floating-label">
                                    <label for="creditos">Créditos</label>
                                    <input type="number" name="creditos" class="form-control" id="creditos" value="{{ $materia->creditos }}">
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-block btn-submit">Actualizar Materia</button>
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
    $(document).ready(function() {
        $('input').focus(function() {
            $(this).parent().addClass('active');
        }).blur(function() {
            if ($(this).val() === '') {
                $(this).parent().removeClass('active');
            }
        });
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

    .btn-submit {
        transition: all 0.3s ease;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .btn-back {
        color: #ffffff;
        font-size: 16px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: background-color 0.3s ease, color 0.3s ease;
        background-color: #8c52ff;
        padding: 8px 12px;
        border-radius: 4px;
    }

    .btn-back i {
        color: #ffffff;
        font-size: 18px;
        margin-right: 5px;
    }

    .btn-back:hover {
        background-color: #5a26dd;
        color: #ffffff;
    }

    .btn-back:hover i {
        color: #ffffff;
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
</style>
@endsection
