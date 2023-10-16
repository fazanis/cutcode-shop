<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class InstallCommand extends Command
{

    protected $signature = 'shop:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Instalation';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->call('storage:link');
        $this->call('migrate');
    }
}
