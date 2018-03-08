<?php

use Illuminate\Database\Seeder;
use App\Action as Action;

class RolesHasActions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $actions = Action::all();

        foreach ( $actions as $key => $action )
        {
            DB::table('roles_has_actions')->insert(array(
                         'role_id' => "1",
                         'action_id'  => $action->id
                      ));
        }
    }
}
