@extends('layouts.app')
<style>
    .welcome-section {
        background-color: #f0f8ff; /* Light azure to make it welcoming */
        color: #2c3e50; /* Darker text color for better readability */
        font-family: 'Arial', sans-serif;
        padding: 40px; /* Increased padding for a better layout */
        border-radius: 10px; /* Slightly larger radius for a softer look */
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15); /* Softer shadow */
        text-align: center;
        margin-top: 30px;
        animation: fadeIn 2s; /* Animation added */
    }

    .welcome-section h1 {
        font-size: 28px; /* Larger font size */
        color: #34495e; /* Slightly different shade for emphasis */
        margin-bottom: 20px; /* Added spacing */
    }

    .welcome-section p {
        font-size: 18px; /* Increased font size for better visibility */
        color: #7f8c8d; /* Softer color */
    }

    @keyframes fadeIn { /* Define the animation */
        from { opacity: 0; transform: translate3d(0, -10%, 0); }
        to { opacity: 1; transform: translate3d(0, 0, 0); }
    }
</style>

@section('content')
@can('ver-dashboard')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Dashboard</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 col-xl-4">
                                <div class="card bg-primary text-white shadow">
                                    <div class="card-body">
                                        <h5 class="card-title"><i class="fa fa-users"></i> Usuarios</h5>
                                        @php
                                        $cant_usuarios = \App\Models\User::count();
                                        @endphp
                                        <h2 class="text-right">
                                            <span>{{$cant_usuarios}}</span>
                                        </h2>
                                        <p class="mb-0 text-right"><a href="/usuarios" class="text-white">Ver más</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-xl-4">
                                <div class="card bg-warning text-white shadow">
                                    <div class="card-body">
                                        <h5 class="card-title"><i class="fa fa-user-lock"></i> Roles</h5>
                                        @php
                                        $cant_roles = \Spatie\Permission\Models\Role::count();
                                        @endphp
                                        <h2 class="text-right">
                                            <span>{{$cant_roles}}</span>
                                        </h2>
                                        <p class="mb-0 text-right"><a href="/roles" class="text-white">Ver más</a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-xl-4">
                                <div class="card bg-danger text-white shadow">
                                    <div class="card-body">
                                        <h5 class="card-title"><i class="fa fa-user-graduate"></i> Estudiantes</h5>
                                        @php
                                        $cant_estudiantes = \App\Models\Estudiante::count();
                                        @endphp
                                        <h2 class="text-right">
                                            <span>{{$cant_estudiantes}}</span>
                                        </h2>
                                        <p class="mb-0 text-right"><a href="/estudiantes" class="text-white">Ver más</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-xl-4">
                                <div class="card bg-success text-white shadow">
                                    <div class="card-body">
                                        <h5 class="card-title"><i class="fa fa-book"></i> Materias</h5>
                                        @php
                                        $cant_materias = \App\Models\Materia::count();
                                        @endphp
                                        <h2 class="text-right">
                                            <span>{{$cant_materias}}</span>
                                        </h2>
                                        <p class="mb-0 text-right"><a href="/materias" class="text-white">Ver más</a>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-xl-4">
                                <div class="card bg-dark text-white shadow">
                                    <div class="card-body">
                                        <h5 class="card-title"><i class="fa fa-users"></i> Grupos</h5>
                                        @php
                                        $cant_grupos = \App\Models\Grupo::count();
                                        @endphp
                                        <h2 class="text-right">
                                            <span>{{$cant_grupos}}</span>
                                        </h2>
                                        <p class="mb-0 text-right"><a href="/grupos" class="text-white">Ver más</a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-xl-4">
                                <div class="card bg-info text-white shadow">
                                    <div class="card-body">
                                        <h5 class="card-title"><i class="fa fa-pencil"></i> Inscripciones</h5>
                                        @php
                                        $cant_inscripciones = \App\Models\Inscripcion::count();
                                        @endphp
                                        <h2 class="text-right">
                                            <span>{{$cant_inscripciones}}</span>
                                        </h2>
                                        <p class="mb-0 text-right"><a href="/inscripciones" class="text-white">Ver
                                                más</a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-xl-4">
                                <div class="card bg-warning text-white shadow">
                                    <div class="card-body">
                                        <h5 class="card-title"><i class="fa fa-pencil"></i>Logs</h5>
                                        @php
                                        $cant_logs = \App\Models\Inscripcion::count();
                                        @endphp
                                        <h2 class="text-right">
                                            <span>{{$cant_logs}}</span>
                                        </h2>
                                        <p class="mb-0 text-right"><a href="/inscripciones" class="text-white">Ver
                                                más</a></p>
                                    </div>
                                </div>
                            </div>
                            <!-- More card blocks -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@else
<div class="welcome-section">
    <h1>Bienvenidos</h1>
    <p>Gracias por visitar nuestro sitio. Explore y descubra más acerca de lo que ofrecemos.</p>
</div>
@endcan
@endsection