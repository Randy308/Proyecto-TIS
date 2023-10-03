
<div>

    <div class="row">
        @foreach ($eventos as $evento)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="position-relative">
                        <a href="{{ route('verEvento', $evento->idEvento) }}">
                            <img src="{{ $evento->direccion_banner }}" class="card-img-top" alt="{{ $evento->Titulo }}">
                        </a>

                        <div class="cinta">{{ $evento->estado }}</div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $evento->nombre_evento }}</h5>
                        <p class="card-text">{{ $evento->descripcion_evento }}</p>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{ $eventos->links() }}


</div>
