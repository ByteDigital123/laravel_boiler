<?php

namespace App\Console\Commands\Boilerplate;

use Illuminate\Console\Command;

class ScaffoldProject extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scaffold:project';

    protected $legacyModels = [
        'AdminUser',
        'Permission',
        'FileModel',
        'OauthAccessToken',
        'Page',
        'Role',
    ];

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create controllers, repositories, resources, and requests from models';

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
        if ($this->confirm('Is this the first time you are running the scaffold?')) {
            $this->call('migrate:generate');
            $this->call('code:models');
        }

        $location = $this->choice('Which namespace shall we save them under?', ['Api', 'Website', 'UserDashboard']);

        foreach (glob("./app/*.php") as $file) {
            $model = basename($file, '.php');

            if (! in_array($model, $this->legacyModels)) {
                $this->info('Setting up files for ' . $model);

                $this->call('scaffold:single', [
                    'model' => $model,
                    'location' => $location
                ]);

                // // 1. create controllers
                // $this->info('Creating Controller');

                // \Artisan::call('scaffold:controller', [
                //     'name' => $model . "Controller",
                //     '--model' => $model,
                //     '--location' => $location
                // ]);
         
                // // 2. create resources

                // $this->info('Creating Resources');

                // \Artisan::call('make:resource', [
                //     'name' => $location . "\\"  . $model . "\\" . $model . "Resource"
                // ]);

                // \Artisan::call('make:resource', [
                //     'name' => $location . "\\"  . $model . "\\" . $model . "Collection"
                // ]);

                // // 3. create requests
                // $this->info('Creating Requests');

                // \Artisan::call('make:request', [
                //     'name' => $location . "\\"  . $model . "\Store" . $model . "Request"
                // ]);

                // \Artisan::call('make:request', [
                //     'name' => $location . "\\"  . $model . "\Update" . $model . "Request"
                // ]);

                // // 4. create repositories
                // $this->info('Creating Repositories');
            
                // \Artisan::call('scaffold:interface', [
                //     'name' => $model . "Interface",
                //     '--model' => $model
                // ]);

                // // call Create Repository
                // \Artisan::call('scaffold:repository', [
                //     'name' => "\Eloquent" . $model . "Repository",
                //     '--model' => $model
                // ]);
        
                // // Call Create ServiceProvider
                // \Artisan::call('scaffold:serviceProvider', [
                //     'name' => $model . "ServiceProvider",
                //     '--model' => $model
                // ]);

                // $this->info('Creating Model Search');
                // // Call Create Search
                // \Artisan::call('scaffold:search', [
                //     'name' => $model . "Search",
                //     '--model' => $model,
                //     '--location' => $location
                // ]);

                // // call policy create
                // $this->info('Creating Policy');
                // \Artisan::call('scaffold:policy', [
                //     'name' => $model . "Policy",
                //     '--model' => $model,
                //     '--location' => $location
                // ]);
            }
        }
    }
}
