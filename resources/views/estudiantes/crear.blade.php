@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Crear Blog</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
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

                        <form action="{{ route('estudiantes.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="numeroDeControl">Número de Control</label>
                                        <input type="text" name="numeroDeControl" class="form-control" id="numeroDeControl">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="nombre">Nombre</label>
                                        <input type="text" name="nombre" class="form-control" id="nombre">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="apellidoPaterno">Apellido Paterno</label>
                                        <input type="text" name="apellidoPaterno" class="form-control" id="apellidoPaterno">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="apellidoMaterno">Apellido Materno</label>
                                        <input type="text" name="apellidoMaterno" class="form-control" id="apellidoMaterno">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="semestre">Semestre</label>
                                        <input type="number" name="semestre" class="form-control" id="semestre">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">Guardar</button>                            
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
