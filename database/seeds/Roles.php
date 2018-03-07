<?php

use Illuminate\Database\Seeder;

class Roles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('roles')->insert(array(
             'name' => "admin",
             'description'  => "system administrator",
             'created_at' => date('Y-m-d H:m:s'),
             'updated_at' => date('Y-m-d H:m:s')
          ));
    }
}
