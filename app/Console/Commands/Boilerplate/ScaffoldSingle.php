<?php

namespace App\Console\Commands\Boilerplate;

use Illuminate\Console\Command;

class ScaffoldSingle extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scaffold:single';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scaffold files for given model';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $model = $this->ask('Which model are we creating the files for?');

        $location = $this->anticipate('Which namespace shall we save them under?', ['Api']);

        // 1. create controllers
        
        try {
            $this->info('Creating Controller');

            \Artisan::call('scaffold:controller', [
                'name' => $model . "Controller",
                '--model' => $model,
                '--location' => $location
            ]);
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }

        // 2. create resources
        
        try {
            $this->info('Creating Resources');

            \Artisan::call('scaffold:resource', [
                'name' => $location . "\\"  . $model . "\\" . $model . "Resource"
            ]);

            \Artisan::call('scaffold:resource', [
                'name' => $location . "\\"  . $model . "\\" . $model . "Collection"
            ]);
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }

        // 3. create requests
        
        try {
            $this->info('Creating Requests');

            \Artisan::call('scaffold:request', [
                    'name' => $location . "\\"  . $model . "\Store" . $model . "Request"
                ]);

            \Artisan::call('scaffold:request', [
                    'name' => $location . "\\"  . $model . "\Update" . $model . "Request"
                ]);
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }

        // 4. create repositories
        
        try {
            $this->info('Creating Repositories');
            
            \Artisan::call('scaffold:interface', [
                'name' => $model . "Interface",
                '--model' => $model
            ]);
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }

        // call Create Repository
        \Artisan::call('scaffold:repository', [
            'name' => "\Eloquent" . $model . "Repository",
            '--model' => $model
        ]);
        
        // Call Create ServiceProvider
        \Artisan::call('scaffold:serviceProvider', [
            'name' => $model . "ServiceProvider",
            '--model' => $model
        ]);

        $this->info('Your files are ready');
    }
}
