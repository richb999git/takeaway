<?php

use Illuminate\Database\Seeder;

class MenuCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $menuItem = new \App\MenuCategory;
        $menuItem->category = "PAPADUMS & CHUTNEYS";
        $menuItem->save();

        $menuItem = new \App\MenuCategory;
        $menuItem->category = "STARTERS";
        $menuItem->save();

        $menuItem = new \App\MenuCategory;
        $menuItem->category = "TANDOORI DISHES";
        $menuItem->save();

        $menuItem = new \App\MenuCategory;
        $menuItem->category = "BENGAL TIGER SPECIALITIES";
        $menuItem->save();

        $menuItem = new \App\MenuCategory;
        $menuItem->category = "CHEF’S RECOMMENDATION";
        $menuItem->save();

        $menuItem = new \App\MenuCategory;
        $menuItem->category = "SEAFOOD DISHES";
        $menuItem->save();

        $menuItem = new \App\MenuCategory;
        $menuItem->category = "JALFREZI DISHES";
        $menuItem->save();

        $menuItem = new \App\MenuCategory;
        $menuItem->category = "BALTI DISHES";
        $menuItem->save();

        $menuItem = new \App\MenuCategory;
        $menuItem->category = "BASIC DISHES";
        $menuItem->save();

        $menuItem = new \App\MenuCategory;
        $menuItem->category = "VEGETABLE SIDE DISHES";
        $menuItem->save();
        
        $menuItem = new \App\MenuCategory;
        $menuItem->category = "RICE";
        $menuItem->save();

        $menuItem = new \App\MenuCategory;
        $menuItem->category = "NAAN BREADS";
        $menuItem->save();

        $menuItem = new \App\MenuCategory;
        $menuItem->category = "ENGLISH DISHES";
        $menuItem->save();

        $menuItem = new \App\MenuCategory;
        $menuItem->category = "SET MEALS";
        $menuItem->save();
    }
}
