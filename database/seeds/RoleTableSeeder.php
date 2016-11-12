<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = new Role();
        $role_admin->name = 'admin';
        $role_admin->description = 'Администратор';
        $role_admin->save();

        $role_registrator = new Role();
        $role_registrator->name = 'registrator';
        $role_registrator->description = 'Регистратор';
        $role_registrator->save();
    }
}
