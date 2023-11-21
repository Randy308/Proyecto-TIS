<div>
    {{-- The best athlete wants his opponent at his best. --}}
    {{-- {"id":1,"user_id":1,"nombre_evento":"Ipsa unde itaque assumenda.","descripcion_evento":"Molestias sapiente esse nihil veniam ipsam.","estado":"Activo","categoria":"Ciencia de datos","fecha_inicio":"2023-11-22","fecha_fin":"2023-12-17","direccion_banner":"\/storage\/image\/img-default.jpeg","latitud":-17.393599893481,"longitud":-66.145963539153,"background_color":"#FFFF","created_at":"2023-11-19T14:59:21.000000Z","updated_at":"2023-11-19T14:59:21.000000Z"} --}}
    <p class="h4">{{ $evento->nombre_evento }}</p>
    <p class="h4">{{ $evento->descripcion_evento }}</p>
    <p class="h4">{{ $evento->direccion_banner }}</p>
    <p class="h4">{{ $evento->fecha_inicio }}</p>
    <p class="h4">{{ $evento->user->name }}</p>
    <p class="h4">{{ $evento->user->email }}</p>
    <label for="meeting-time">Tiempo de inicio del evento:</label>

    <input type="datetime-local" id="meeting-time" name="meeting-time" value="{{ $evento->fecha_inicio }}T19:30" min="2023-06-07T00:00"
        max="2024-06-14T00:00" />
</div>
