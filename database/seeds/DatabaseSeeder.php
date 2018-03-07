<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(Users::class);
        $this->call(Roles::class);
        $this->call(UsersHasRoles::class);
        $this->call(Actions::class);
    }
}
