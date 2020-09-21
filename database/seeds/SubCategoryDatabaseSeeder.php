<?php

use Illuminate\Database\Seeder;

class SubCategoryDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory('App\Models\Category', 3)->create([
            'parent_id'=>$this->getRandomParentId()
        ]);

    }

    private function getRandomParentId()
    {
     return  $parent_id=  \App\Models\Category::inRandomOrder()->first();
    }
}
