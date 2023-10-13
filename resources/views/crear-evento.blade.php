@extends('layouts.app')

@section('title', 'Crear Evento')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="wrapper">
    @include('layouts/toggle')
    @include('layouts/sidebar')
    <div id="content">
        @include('layouts/navbar')

        <div class="contenedor-flex">
            <div class="formulario">
                <div class="container">
                    <h1>Crear Evento</h1>

                    <form method="POST" action="{{ route('crear-evento') }}">
                        @csrf

                        <div class="form-group">
                            <label for="nombre_evento">Nombre del Evento</label>
                            <input type="text" name="nombre_evento" class="form-control" id="nombre_evento" required>
                            @if($errors->has('nombre_evento'))
                            <span class="text-danger">{{ $errors->first('nombre_evento') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="descripcion_evento">Descripción del Evento</label>
                            <textarea name="descripcion_evento" class="form-control" id="descripcion_evento" required></textarea>
                            @if($errors->has('descripcion_evento'))
                            <span class="text-danger">{{ $errors->first('descripcion_evento') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="categoria">Categoría</label>
                            <select name="categoria" class="form-control" id="categoria" required>
                                <option value="Diseño">Diseño</option>
                                <option value="QA">QA</option>
                                <option value="Desarrollo">Desarrollo</option>
                                <option value="Ciencia de datos">Ciencia de datos</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="fecha_inicio">Fecha de inicio</label>
                            <input type="date" name="fecha_inicio" class="form-control" id="fecha_inicio" required>
                            @if($errors->has('fecha_inicio'))
                            <span class="text-danger">{{ $errors->first('fecha_inicio') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="fecha_fin">Fecha de finalización</label>
                            <input type="date" name="fecha_fin" class="form-control" id="fecha_fin" required>
                            @if($errors->has('fecha_fin'))
                            <span class="text-danger">{{ $errors->first('fecha_fin') }}</span>
                            @endif
                        </div>
                        <script>
                            function confirmarCancelacion() {
                                if (confirm("¿Estás seguro de que deseas cancelar el evento?")) {
                                    window.location.href = "{{ route('index') }}";
                                }
                            }
                        </script>
                        <div class="form-group text-center botones-juntos">
                            <a href="#" class="btn btn-cancelar" style="width: 45%;" onclick="confirmarCancelacion()">Cancelar</a>
                            <button type="submit" class="btn btn-info" style="width: 45%;">Crear Evento</button>
                        </div>   
                    </form>
                </div>
            </div>
            <a href="{{ route('editar-evento') }}" class="editar-color">
                <i class="fas fa-pencil-alt"></i>
                <span>Editar Evento</span>
            </a>        
        </div>
    </div>
</div>
