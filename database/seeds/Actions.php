<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Route as Route;
use App\Action as Action;

class Actions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $actions = Action::all();
        $routeCollection = Route::getRoutes();

        if ( $actions->isEmpty() )
        {
            Action::setAllActionsByRouteCollection( $routeCollection );
        }
    }
}
