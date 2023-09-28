@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="square-container">
                <div class="card">
                    <div class="cuadrado">
                        <h3>CREAR EVENTO</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="/crear-evento" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3 borde-celeste">
                                <div>
                                    <label for="Titulo" class="form-label" style="font-family: 'Inter', sans-serif; font-weight: 600; color: #61758A;">
                                        Título:
                                    </label>
                                </div>
                                <input type="text" name="Titulo" class="form-control" style="font-family: 'Inter', sans-serif;" required>
                            </div>

                            <div class="mb-3 borde-celeste">
                                <div>
                                    <label for="DireccionImg" class="form-label" style="font-family: 'Inter', sans-serif; font-weight: 600; color: #61758A;">
                                        Banner (JPEG/PNG/GIF):
                                    </label>
                                </div>
                                <input type="file" name="DireccionImg" class="form-control-file" style="font-family: 'Inter', sans-serif;">
                            </div>

                            <div class="mb-3 borde-celeste borde-celeste">
                                <div>
                                    <label for="Descripcion" class="form-label" style="font-family: 'Inter', sans-serif; font-weight: 600; color: #61758A;">
                                        Descripción:
                                    </label>
                                </div>
                                <textarea name="Descripcion" class="form-control" style="font-family: 'Inter', sans-serif;" required></textarea>
                            </div>

                            <div class="mb-3 borde-celeste">
                                <div>
                                    <label for="Estado" class="form-label" style="font-family: 'Inter', sans-serif; font-weight: 600; color: #61758A;">
                                        Estado:
                                    </label>
                                </div>
                                <select name="Estado" class="form-select" style="font-family: 'Inter', sans-serif;" required>
                                    <option value="Activo">Activo</option>
                                    <option value="Finalizado">Finalizado</option>
                                    <option value="Cancelado">Cancelado</option>
                                </select>
                            </div>

                            <div class="mb-3 borde-celeste">
                                <div>
                                    <label for="FechaInicio" class="form-label" style="font-family: 'Inter', sans-serif; font-weight: 600; color: #61758A;">
                                        Fecha de Inicio:
                                    </label>
                                </div>
                                <input type="date" name="FechaInicio" class="form-control" style="font-family: 'Inter', sans-serif;" required>
                            </div>

                            <div class="mb-3 borde-celeste">
                                <div>
                                    <label for="FechaFin" class="form-label" style="font-family: 'Inter', sans-serif; font-weight: 600; color: #61758A;">
                                        Fecha de Finalización:
                                    </label>
                                </div>
                                <input type="date" name="FechaFin" class="form-control" style="font-family: 'Inter', sans-serif;" required>
                            </div>

                            <div class="text-center"> <!-- Alinea los botones al centro -->
                                <a href="/" class="btn btn-secondary">Cancelar</a>
                                <button type="submit" class="btn btn-primary">Crear Evento</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


