<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SetupApp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setup:app';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate app key and JWT secret key automatically';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Generating APP_KEY...');
        $this->call('key:generate');

        $this->info('Generating JWT secret...');
        $this->call('jwt:secret', ['--force' => true]);

        $this->info('Keys generated successfully.');
    }
}
