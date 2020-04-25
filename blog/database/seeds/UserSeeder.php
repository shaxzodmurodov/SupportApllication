<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 2; $i++) {
            $user = new User();
            if ($i == 0) {
                $user->name = 'user';
                $user->email = 'user@mail.com';
                $user->password = bcrypt(12345678);
                $user->setRememberToken(Str::random(60));
                $user->role_id = Role::whereIsUser(1)->first()->id;
            } else {
                $user->name = 'manager';
                $user->email = 'manager@mail.com';
                $user->password = bcrypt(12345678);
                $user->setRememberToken(Str::random(60));
                $user->role_id = Role::whereIsAdmin(1)->first()->id;
            }
            $user->save();
        }
    }
}
