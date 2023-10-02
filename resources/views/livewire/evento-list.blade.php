<link rel="stylesheet"  href="{{ asset('css/listEvent.css') }}">
<div>
   
    <div class="row">
        @foreach ($eventos as $evento)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="position-relative">
                        <img src="{{ $evento->DireccionImg }}" class="card-img-top" alt="{{ $evento->Titulo }}">
                        <div class="cinta">{{ $evento->Estado }}</div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $evento->Titulo }}</h5>
                        <p class="card-text">{{ $evento->Descripcion }}</p>
                        <p><strong>Fecha de Inicio:</strong> {{ $evento->FechaInicio->format('Y-m-d H:i:s') }}</p>
                        <p><strong>Fecha de Finalización:</strong> {{ $evento->FechaFin->format('Y-m-d H:i:s') }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{ $eventos->links() }} 

  
</div>
