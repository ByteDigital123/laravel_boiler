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
    protected $signature = 'scaffold:single {model} {location}';

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
        //$model = $this->ask('Which model are we creating the files for?');

        //$location = $this->choice('Which namespace shall we save them under?', ['Api', 'Web', 'UserDashboard']);

        // 1. create controllers
        $this->info('Creating Controller');

        $model = $this->argument('model');
        $location = $this->argument('location');

        \Artisan::call('scaffold:controller', [
            'name' => $model . "Controller",
            '--model' => $model,
            '--location' => $location
        ]);

        // 2. create resources
        $this->info('Creating Resources');

        \Artisan::call('make:resource', [
            'name' => $location . "\\"  . $model . "\\" . $model . "Resource"
        ]);

        \Artisan::call('make:resource', [
            'name' => $location . "\\"  . $model . "\\" . $model . "Collection"
        ]);

        // 3. create requests
        try {
            $this->info('Creating Requests');

            \Artisan::call('make:request', [
                    'name' => $location . "\\"  . $model . "\Store" . $model . "Request"
                ]);

            \Artisan::call('make:request', [
                    'name' => $location . "\\"  . $model . "\Update" . $model . "Request"
                ]);
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }

        // 4. create repositories
        $this->info('Creating Repositories');
        
        \Artisan::call('scaffold:interface', [
            'name' => $model . "Interface",
            '--model' => $model
        ]);

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

        $this->info('Creating Model Search');
        // Call Create Search
        \Artisan::call('scaffold:search', [
            'name' => $model . "Search",
            '--model' => $model,
            '--location' => $location
        ]);


        $this->info('Creating Policy');
        \Artisan::call('scaffold:policy', [
            'name' => $model . "Policy",
            '--model' => $model,
            '--location' => $location
        ]);

        $this->info('Making Factory');
        \Artisan::call('make:factory', [
            'name' => $model . "Factory"
        ]);

        $this->call('scaffold:permission', [
            'model' => $model
        ]);

        $this->info('Your files are ready');
        $this->warn('Remember to update the AuthServiceProvider with the policies');
    }
}
