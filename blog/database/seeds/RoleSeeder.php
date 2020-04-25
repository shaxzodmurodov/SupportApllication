<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 2; $i++) {
            $role = new Role();
            if ($i == 0) {
                $role->name = 'user';
                $role->is_user = 1;
            } else {
                $role->name = 'manager';
                $role->is_admin = 1;
            }
            $role->save();
        }
    }
}
