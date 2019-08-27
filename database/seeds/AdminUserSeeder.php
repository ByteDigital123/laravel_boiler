<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use App\AdminUser;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $user = AdminUser::create([
       		'first_name' => 'Admin',
          'last_name' => 'User',
       		'email' => 'admin@nucleus.org',
       		'password' => bcrypt('abc123'),
          'api_token' => Str::random(60),
          'created_at' => \Carbon\Carbon::now(),
          'updated_at' => \Carbon\Carbon::now()
       ]);
    }
}
