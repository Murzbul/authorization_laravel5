<?php

use Illuminate\Database\Seeder;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->insert(array(
         'name' => "admin",
         'email'  => "admin@laravel.com",
         'password'  => bcrypt("1234"),
         'visibility'  => 1,
         'created_at' => date('Y-m-d H:m:s'),
         'updated_at' => date('Y-m-d H:m:s')
      ));
    }
}
