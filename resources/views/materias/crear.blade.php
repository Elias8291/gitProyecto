@extends('layouts.app')

@section('content')
<section class="section" style="background-image: url('ruta/a/tu/imagen-de-fondo.jpg'); background-size: cover;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header">
                        <h3 class="page__heading"><i class="fas fa-book mr-2"></i>Crear Materia</h3>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <form action="{{ route('materias.store') }}" method="POST" class="my-4">
                            @csrf
                            <div class="form-group">
                                <div class="floating-label">
                                    <label for="clave">Clave</label>
                                    <input type="text" name="clave" class="form-control" id="clave" value="{{ old('clave') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="floating-label">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" name="nombre" class="form-control" id="nombre" value="{{ old('nombre') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="floating-label">
                                    <label for="creditos">Créditos</label>
                                    <input type="number" name="creditos" class="form-control" id="creditos" value="{{ old('creditos') }} " min="1">
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-block btn-submit">Crear Materia</button>
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
</style>
@endsection