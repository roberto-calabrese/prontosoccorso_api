<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;


class UpdateApplicationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Esegue alcune operazioni, git pull, generate sitemap, queue restart, copia del sitemap.xml sulla parte client';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {

        $this->info('Eseguendo git pull...');
        $this->runProcess(['git', 'pull']);

        $this->info('Riavviando le code...');
        $this->call('queue:restart');

        $this->info('Pulendo la cache...');
        $this->call('cache:clear');

        $this->info('Ricreo la site map');
        $this->call('sitemap:generate');


        $sitemap = 'sitemap.xml';
        $sourcePath = public_path($sitemap);
        $destinationPath = env('DEST_PATH_PS_LIVE_CLIENT', null) . $sitemap;

        if ($destinationPath) {
            $this->info("Copiando file da $sourcePath a $destinationPath...");
            if (!copy($sourcePath, $destinationPath)) {
                throw new \RuntimeException('Errore durante la copia del file.');
            }
        }

        $this->info('Tutte le operazioni sono state completate con successo.');
        return Command::SUCCESS;

    }

    /**
     * Run a shell process and handle errors.
     *
     * @param array $command
     * @return void
     */
    private function runProcess(array $command): void
    {
        $process = new Process($command);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new \RuntimeException($process->getErrorOutput());
        }

        $this->info($process->getOutput());
    }
}

