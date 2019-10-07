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
            }
        }
    }
}
