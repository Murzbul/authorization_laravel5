<?php

use Illuminate\Database\Seeder;

class ConfigSystem extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('config_system')->insert(array(
         'key' => "authorized",
         'value'  => "true",
         'created_at' => date('Y-m-d H:m:s'),
         'updated_at' => date('Y-m-d H:m:s')
      ));

      DB::table('config_system')->insert(array(
         'key' => "auth",
         'value'  => "true",
         'created_at' => date('Y-m-d H:m:s'),
         'updated_at' => date('Y-m-d H:m:s')
      ));
    }
}
