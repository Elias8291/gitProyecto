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
                            <i class="fas fa-book mr-2"></i>Crear Inscribcion
                        </h3>
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

                        <form action="{{ route('inscripciones.store') }}" method="POST" class="my-4">
                            @csrf
                            <div class="form-group">
                                <div class="floating-label">
                                    <label for="estudiante_id">Estudiante:</label>
                                    <select class="form-control @error('estudiante_id') is-invalid @enderror" name="estudiante_id" id="estudiante_id" required>
                                        <option value="">Seleccione un estudiante</option>
                                        @foreach ($estudiantes as $estudiante)
                                        <option value="{{ $estudiante->id }}" {{ old('estudiante_id') == $estudiante->id ? 'selected' : '' }}>
                                            {{ $estudiante->numeroDeControl }} - {{ $estudiante->nombre }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('estudiante_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="floating-label">
                                    <label for="grupo_id">Grupo:</label>
                                    <select class="form-control @error('grupo_id') is-invalid @enderror" name="grupo_id" id="grupo_id" required>
                                        <option value="">Seleccione un grupo</option>
                                        @foreach ($grupos as $grupo)
                                        <option value="{{ $grupo->id }}" {{ old('grupo_id') == $grupo->id ? 'selected' : '' }}>
                                            {{ $grupo->clave }} - {{ optional($grupo->materia)->nombre }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('grupo_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-block btn-submit">Crear Inscripción</button>
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
    // Agrega la clase 'active' cuando un campo de selección está enfocado
    $('select').focus(function() {
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