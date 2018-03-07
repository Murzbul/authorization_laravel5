<?php

use Illuminate\Database\Seeder;

class UsersHasRoles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users_has_roles')->insert(array(
                   'user_id' => "1",
                   'role_id'  => "1"
                ));
    }
}
