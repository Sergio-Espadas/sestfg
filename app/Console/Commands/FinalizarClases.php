<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Clase;
use Illuminate\Support\Facades\Log;

class FinalizarClases extends Command
{
    protected $signature = 'clases:finalizar';

    protected $description = 'Finaliza las clases que ya han pasado';

    public function handle()
    {
        $now = now();

        $clases = Clase::where('fecha', '<', $now->toDateString())
                        ->where('hora', '<', $now->toTimeString())
                        ->get();

        foreach ($clases as $clase) {
            // Ejecutar la función finClase
            $this->call('clases:fin', ['claseId' => $clase->id]);
            Log::info("Clase finalizada automáticamente: {$clase->id}");
        }
    }
}