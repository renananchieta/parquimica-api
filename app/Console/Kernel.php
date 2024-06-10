<?php

namespace App\Console;

use App\Models\Entity\Estudantes\EstudanteMatricula;
use App\Models\Entity\Logs\LogsLotes;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function () {
            $ultimoPagina = Cache::get('ultimoPagina', 403); // Começa na página 403 ou no último processado

            // Processa de 3 em 3 arquivos
            for ($pagina = $ultimoPagina; $pagina <= min($ultimoPagina + 2, 3674); $pagina++) {
                $this->lerArquivoJson($pagina);
            }
    
            Cache::put('ultimoPagina', $pagina); // Salva o último arquivo processado
            })->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }

    public function lerArquivoJson($pagina)
    {
        $arquivo = Storage::disk('public')->get('pagina' . $pagina . '.json');
        $data = json_decode($arquivo, true);

        foreach ($data as $dadosEstudante) {
            $estudante = new EstudanteMatricula();
            $estudante->cpf = $dadosEstudante['cpf'];
            $estudante->codigo_matricula = $dadosEstudante['codigo_matricula'];
            $estudante->codigo_instituicao = $dadosEstudante['codigo_instituicao'];
            $estudante->status = $dadosEstudante['status'];
            $estudante->save();
        }

        $log = new LogsLotes();
        $log->lote_id = 'pagina' . $pagina;
        $log->detalhes = 'pagina' . $pagina;
        $log->save();
    }
}
