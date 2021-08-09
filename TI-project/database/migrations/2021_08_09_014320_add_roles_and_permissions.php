<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AddRolesAndPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // users
        $admin = Role::create(['name' => 'admin']);
        $user = Role::create(['name' => 'user']);

        //permissions
        $permissions = [
            //permissions for draws
            'CreateDraws',
            'UpdateDraws',
            'AccessDraws',
            'DeleteDraws',
            'ViewDraws',

            //permissions for bids
            'AccessWinners',
            'CheckNumbers',
            'CheckBids',
            'GenerateNumber',
            'MakeBid',
            'ViewBid',
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $admin->givePermissionTo($permissions);
        $user->givePermissionTo(['ViewDraws', 'MakeBid', 'ViewBid']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
