<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // //drop all those tables
        // $this->command->call('migrate:drop-all-tables');
        // // Call the php artisan migrate:refresh using Artisan
        // $this->command->call('migrate:refresh');
        //
        // $this->command->line("Data cleared, starting from blank database.");


        if(!\App\AdminUser::where('email', '=', 'admin@nucleus.org')->exists()){

            $this->call(AdminUserSeeder::class);

            $this->call(RolesAndPermissionsSeeder::class);

            $this->command->info('Assigning the user Super Admin Privilidges...');
            $user = \App\AdminUser::where('email', '=', 'admin@nucleus.org')->first();

            $user->assignRole('Super Admin');

            $this->command->comment('Here are your admin details to login:');
            $this->command->warn('Email: ' . $user->email);
            $this->command->warn('Password: "abc123"');

            $this->command->info('Setting up OAuth');

            \Artisan::call('passport:install');

    }
    }
}
