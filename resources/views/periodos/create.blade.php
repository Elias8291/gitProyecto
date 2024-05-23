@extends('layouts.app')

@section('content')
<section class="section">
    <div class="container custom-container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-header d-flex align-items-center justify-content-between bg-primary text-white">
                        <a href="{{ url()->previous() }}" class="btn btn-back text-white">
                            <i class="fas fa-arrow-left mr-2"></i> Regresar
                        </a>
                        <h3 class="page__heading text-center flex-grow-1 m-0">
                            <i class="fas fa-calendar-alt mr-2"></i> Crear Período
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

                        <form action="{{ route('periodos.store') }}" method="POST" class="my-4">
                            @csrf
                            <div class="form-group">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" name="nombre" class="form-control" id="nombre" required>
                            </div>
                            <div class="form-group">
                                <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                                <input type="date" name="fecha_inicio" class="form-control flatpickr-input" id="fecha_inicio" required>
                            </div>
                            <div class="form-group">
                                <label for="fecha_fin" class="form-label">Fecha de Fin</label>
                                <input type="date" name="fecha_fin" class="form-control flatpickr-input" id="fecha_fin" required>
                            </div>
                            <div class="form-group">
                                <label for="estatus_text" class="form-label">Estatus</label>
                                <input type="text" class="form-control" id="estatus_text" readonly>
                            </div>
                            <input type="hidden" name="estatus" id="estatus" value="0">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-block btn-submit">Guardar</button>
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
        $('.select2').select2();

        $('input[type="date"]').focus(function() {
            $(this).parent().addClass('active');
        }).blur(function() {
            if ($(this).val() === '') {
                $(this).parent().removeClass('active');
            }
        });

        flatpickr(".flatpickr-input", {
            dateFormat: "Y-m-d",
            locale: "es",
            altInput: true,
            altFormat: "F j, Y",
            onChange: function(selectedDates, dateStr, instance) {
                checkStatus();
            }
        });

        function checkStatus() {
            var fechaInicio = document.getElementById('fecha_inicio').value;
            var fechaFin = document.getElementById('fecha_fin').value;
            var estatus = document.getElementById('estatus');
            var estatusText = document.getElementById('estatus_text');
            var today = new Date().toISOString().split('T')[0];

            if (fechaInicio && fechaFin) {
                if (today >= fechaInicio && today <= fechaFin) {
                    estatus.value = 1; // Activo
                    estatusText.value = "Activo";
                } else {
                    estatus.value = 0; // Inactivo
                    estatusText.value = "Inactivo";
                }
            } else {
                estatus.value = 0; // Inactivo
                estatusText.value = "Inactivo";
            }
        }

        $('#fecha_inicio, #fecha_fin').on('change', checkStatus);
        checkStatus(); // Llamar al cargar la página para configurar el estado inicial
    });
</script>
@endsection

@section('styles')
<style>
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

    .flatpickr-input {
        padding: 12px 15px;
        border: 1px solid #ccc;
        border-radius: 8px;
        width: 100%;
        box-sizing: border-box;
        font-size: 16px;
        background-color: #f9f9f9;
        transition: all 0.2s ease;
    }

    .flatpickr-input:focus {
        border-color: #4b479c;
        box-shadow: 0 0 8px rgba(75, 71, 156, 0.3);
        background-color: #fff;
    }

    .flatpickr-calendar {
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .flatpickr-month {
        background-color: #4b479c;
        color: #fff;
        border-radius: 8px 8px 0 0;
    }

    .flatpickr-day.today {
        background-color: #4b479c;
        color: #fff;
    }

    .flatpickr-day:hover {
        background-color: #4b479c;
        color: #fff;
    }

    .flatpickr-day.selected {
        background-color: #4b479c;
        color: #fff;
    }

    .flatpickr-months, .flatpickr-weekdays {
        border-radius: 8px 8px 0 0;
    }
</style>
@endsection
