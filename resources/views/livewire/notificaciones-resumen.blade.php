<li class="nav-item dropdown" id="navdropdownNoti">
    <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownNoti" role="button"
       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" wire:click = "cambiarEstadoNoti">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
             class="bi bi-bell-fill" viewBox="0 0 16 16">
            <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zm.995-14.901a1 1 0 1 0-1.99 0A5.002 5.002 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901z"/>
        </svg>
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdownNoti">
        @foreach ($notificaciones as $notificacion)
            <a class="dropdown-item" href="#">
                <h6>{{$notificacion->asunto}}</h6>
                <p>{{$notificacion->detalle}}</p>
                <small>{{$notificacion->fechaHora}}</small>
            </a>
        @endforeach
            <button class="dropdown-item" disabled>No tienes notificaciones</button>


    </div>
</li>

<script>
    document.addEventListener('livewire:load', function () {
        setInterval(function () {
            Livewire.emit('actualizarDatos');
        }, 5000);

        Livewire.on('mantenerDropdownAbierto', () => {
            const dropdown = document.getElementById('navdropdownNoti');
            const dropdownMenu = dropdown.querySelector('.dropdown-menu');

            
            dropdownMenu.classList.add('show');
        });
    });
</script>