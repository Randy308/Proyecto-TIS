<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CrearEventoTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testCrearEvento()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/crear-evento')
                ->assertSee('Crear Evento')
                ->assertSee('Nombre del Evento')
                ->assertSee('Tipo de Evento')
                ->assertSee('Agregar ubicación:')
                ->assertSee('Fecha de inicio')
                ->assertSee('Fecha de finalización')
                ->assertSee('Modalidad del evento')
                ->assertSee('Cancelar')
                ->assertSee('Crear Evento')
                ->type('nombre_evento', 'Nombre del evento de prueba')
                ->select('tipo_evento', 'Reclutamiento')
                ->press('Crear Evento')
                ->waitForText('El evento ha sido creado exitosamente');
        });
    }
}
