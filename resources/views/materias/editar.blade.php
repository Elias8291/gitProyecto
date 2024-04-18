@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Editar Materia</h3>
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
                        <form action="{{ route('materias.update', $materia->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="clave">Clave</label>
                                <input type="text" name="clave" class="form-control" id="clave" value="{{ $materia->clave }}">
                            </div>
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" name="nombre" class="form-control" id="nombre" value="{{ $materia->nombre }}">
                            </div>
                            <div class="form-group">
                                <label for="creditos">Créditos</label>
                                <input type="number" name="creditos" class="form-control" id="creditos" value="{{ $materia->creditos }}">
                            </div>
                            <button type="submit" class="btn btn-primary">Actualizar Materia</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection