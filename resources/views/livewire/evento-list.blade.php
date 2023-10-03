<link rel="stylesheet"  href="{{ asset('css/listEvent.css') }}">
<div>
   
    <div class="row">
        @foreach ($eventos as $evento)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="position-relative">
                        <img src="{{ $evento->direccion_banner }}" class="card-img-top" alt="{{ $evento->Titulo }}">
                        <div class="cinta">{{ $evento->estado }}</div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $evento->nombre_evento }}</h5>
                        <p class="card-text">{{ $evento->descripcion_evento }}</p>
                        <p><strong>Fecha de Inicio:</strong> {{ $evento->fecha_inicio->format('Y-m-d H:i:s') }}</p>
                        <p><strong>Fecha de Finalización:</strong> {{ $evento->fecha_fin->format('Y-m-d H:i:s') }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{ $eventos->links() }} 

  
</div>
