<form action="{{ route('eventos.cancelar', $evento->id) }}" method="POST">
    @csrf
    @method('PUT') <!-- Usar PUT en lugar de GET o POST si corresponde -->

    <button type="submit" onclick="return confirm('¿Estás seguro de que deseas cancelar este evento?')">Cancelar Evento</button>
</form>
