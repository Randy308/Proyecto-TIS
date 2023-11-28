<div>
    <label>
        <input type="checkbox" wire:model="showInstitucion"> Mostrar instituciones
    </label>

    @if ($showInstitucion)
        <div>
            <label for="selectedInstitucion">Selecciona una institución:</label>
            <select wire:model="selectedInstitucion" id="selectedInstitucion">
                <option value="" selected disabled>Selecciona una institución</option>
                @foreach ($instituciones as $nombre_institucion)
                    <option value="{{ $nombre_institucion }}">{{ $nombre_institucion }}</option>
                @endforeach
            </select>
        </div>
    @endif
</div>




    {{-- <label>
        <input type="checkbox" wire:model="showEventos"> Mostrar eventos
    </label>

    @if ($showEventos)
        <label for="selectedEvento">Selecciona un evento:</label>
        <select wire:model="selectedEvento" id="selectedEvento">
            <option value="" selected disabled>Selecciona un evento</option>
            @foreach ($eventos as $id => $nombre)
                <option value="{{ $id }}">{{ $nombre }}</option>
            @endforeach
        </select>
    @endif   --}}