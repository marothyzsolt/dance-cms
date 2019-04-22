<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\DancerCategory::truncate();
        \App\DancerCategory::insert(['name' => 'CHILDREN PÁROS']);
        \App\DancerCategory::insert(['name' => 'JUVENILES PÁROS']);
        \App\DancerCategory::insert(['name' => 'JUNIOR KISFORMÁCIÓ	']);
        \App\DancerCategory::insert(['name' => 'JUNIOR NAGYFORMÁCIÓ']);
        \App\DancerCategory::insert(['name' => 'FELNŐTT NEMZETI KISFORMÁCIÓ']);
        \App\DancerCategory::insert(['name' => 'FELNŐTT KISFORMÁCIÓ']);
        \App\DancerCategory::insert(['name' => 'FELNŐTT NEMZETI NAGYFORMÁCIÓ']);
        \App\DancerCategory::insert(['name' => 'FELNŐTT NEMZETKÖZI NAGYFORMÁCIÓ']);
    }
}
