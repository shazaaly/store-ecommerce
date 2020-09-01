<?php
use Illuminate\Database\Seeder;


class CategoryDataBaseSeeder extends Seeder
{

    public function run()
    {
        //
        factory('App\Models\Category', 20)->create();


    }
}
