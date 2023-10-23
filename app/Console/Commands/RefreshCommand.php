<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class RefreshCommand extends Command
{

    protected $signature = 'shop:fresh';

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
        if (app()->isLocal()){
            Storage::deleteDirectory('products');
            Storage::deleteDirectory('brands');
            $this->call('migrate:fresh',['--seed'=>true]);
        }
    }
}
