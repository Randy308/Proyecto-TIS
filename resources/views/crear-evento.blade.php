
@extends('layouts.app')


<div class="wrapper">
    @include('layouts/sidebar')
    <div id="content">
         @include('layouts/navbar')
        <h1>Crear Evento</h1>

        <div class="formulario">
            <form method="POST" action="{{ route('crear-evento') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group etiqueta-celeste">
                    <label for="nombre_evento">Nombre del Evento:</label>
                    <input type="text" name="nombre_evento" class="form-control" id="nombre_evento" required>
                </div>
                <div class="form-group etiqueta-celeste">
                    <label for="descripcion_evento">Descripción del Evento:</label>
                    <textarea name="descripcion_evento" class="form-control" id="descripcion_evento" required></textarea>
                </div>
                <div class="form-group etiqueta-celeste">
                    <label for="estado">Estado:</label>
                    <select name="estado" class="form-control" id="estado" required>
                        <option value="activo">Activo</option>
                        <option value="finalizado">Finalizado</option>
                        <option value="cancelado">Cancelado</option>
                    </select>
                </div>
                <div class="form-group etiqueta-celeste">
                    <label for="categoria">Categoría:</label>
                    <input type="text" name="categoria" class="form-control" id="categoria" required>
                </div>
                <div class="form-group etiqueta-celeste">
                    <label for="fecha_inicio">Fecha de inicio:</label>
                    <input type="date" name="fecha_inicio" class="form-control" id="fecha_inicio" required>
                </div>
                <div class="form-group etiqueta-celeste">
                    <label for="fecha_fin">Fecha de finalización:</label>
                    <input type="date" name="fecha_fin" class="form-control" id="fecha_fin" required>
                </div>
                {{-- <div class="form-group etiqueta-celeste">
                    <label for="direccion_banner">Dirección del Banner (si es necesario):</label>
                    <input type="text" name="direccion_banner" class="form-control" id="direccion_banner">
                </div>  --}}
                <button type="submit" class="btn btn-primary">Crear Evento</button>
            </form>
        </div>
        <div class="editar-color">
            <i class="fas fa-pencil-alt"></i>
            <span>Editar Banner</span>
        </div>
        
    </div>

</div>

<script src="{{ asset('js/color-picker.js') }}"></script>
