@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Crear Materia</h3>
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
                        <form action="{{ route('materias.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="clave">Clave</label>
                                <input type="text" name="clave" class="form-control" id="clave" value="{{ old('clave') }}">
                            </div>
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" name="nombre" class="form-control" id="nombre" value="{{ old('nombre') }}">
                            </div>
                            <div class="form-group">
                                <label for="creditos">Créditos</label>
                                <input type="number" name="creditos" class="form-control" id="creditos" value="{{ old('creditos') }}">
                            </div>
                            <button type="submit" class="btn btn-primary">Crear Materia</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection