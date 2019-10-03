<?php

use App\Sandbox;
use Illuminate\Database\Seeder;

class SandboxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Sandbox::class, 500)->create();
    }
}
