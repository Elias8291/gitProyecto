@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Crear Inscripción</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
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

                        <form action="{{ route('inscripciones.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
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

                            <div class="form-group">
                                <label for="grupo_clave">Grupo:</label>
                                <select class="form-control @error('grupo_clave') is-invalid @enderror" name="grupo_clave" id="grupo_clave" required>
                                    <option value="">Seleccione un grupo</option>
                                    @foreach ($grupos as $grupo)
                                        <option value="{{ $grupo->clave }}" {{ old('grupo_clave') == $grupo->clave ? 'selected' : '' }}>
                                            {{ $grupo->clave }} - {{ optional($grupo->materia)->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('grupo_clave')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Crear Inscripción</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection