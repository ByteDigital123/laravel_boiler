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

        // 1. create controllers
        
        $this->info('Creating Controllers');
        
        $this->call('create:controller:model', [
            '--location' => $location
        ]);

        // 2. create resources
        
        $this->info('Creating Resources');

        $this->call('resource:create:model', [
            '--location' => $location
        ]);

        // 3. create requests
        
        $this->info('Creating Requests');

        $this->call('request:create:model', [
            '--location' => $location
        ]);

        // 4. create repositories
        
        $this->info('Creating Repositories');

        $this->call('create:repository:model');

        // 5. Create Search Filters

        

        // 6. Create Policies


        // FINI

        $this->info('Files have been completed');
    }
}
