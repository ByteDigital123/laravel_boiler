<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RoleTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $role;

    public function setUp() :void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
        $this->role = factory(Role::class)->create(['name' => 'TestRole', 'guard_name' => 'api']);
    }

    /** @test */
    public function a_user_can_be_assigned_a_role()
    {
        $this->user->assignRole($this->role);

        $this->assertEquals($this->user->roles()->first()->name, 'TestRole');
    }

    /** @test */
    public function a_user_can_be_removed_from_a_role()
    {
        // assign the role
        $this->user->assignRole($this->role);
        
        // check this role exists
        $this->assertEquals($this->user->roles()->first()->name, 'TestRole');

        // remove the role from the user
        $this->user->removeRole($this->role);

        // make sure there are no roles.
        $this->assertEquals($this->user->roles()->exists(), false);
    }
}
