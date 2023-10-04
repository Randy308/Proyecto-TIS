<form action="{{ route('eventos.cancelar', $evento->id) }}" method="POST">
    <button type="submit" onclick="return confirm('¿Estás seguro de que deseas cancelar este evento?')">Cancelar Evento</button>
</form>
