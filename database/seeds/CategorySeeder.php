<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Category::class, 20)->create()->each(function ($id) {
            $id->save(); // questo non servirebbe
        });
    }
}


//v. appunti db seeder 