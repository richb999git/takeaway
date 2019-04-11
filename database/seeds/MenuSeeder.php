<?php

use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menuItem = new \App\takeawayMenu;
        $menuItem->title = "Plain papadum";
        $menuItem->description = "";
        $menuItem->price = 0.60;
        $menuItem->menuCategoryId = 1;
        $menuItem->save();

        $menuItem = new \App\takeawayMenu;
        $menuItem->title = "Spiced papadum";
        $menuItem->description = "";
        $menuItem->price = 0.60;
        $menuItem->menuCategoryId = 1;
        $menuItem->save();

        $menuItem = new \App\takeawayMenu;
        $menuItem->title = "Lime pickle";
        $menuItem->description = "";
        $menuItem->price = 0.50;
        $menuItem->menuCategoryId = 1;
        $menuItem->save();

        $menuItem = new \App\takeawayMenu;
        $menuItem->title = "Mango chutney";
        $menuItem->description = "";
        $menuItem->price = 0.50;
        $menuItem->menuCategoryId = 1;
        $menuItem->save();

        $menuItem = new \App\takeawayMenu;
        $menuItem->title = "Mint sauce";
        $menuItem->description = "";
        $menuItem->price = 0.50;
        $menuItem->menuCategoryId = 1;
        $menuItem->save();

        $menuItem = new \App\takeawayMenu;
        $menuItem->title = "Onion salad";
        $menuItem->description = "";
        $menuItem->price = 0.50;
        $menuItem->menuCategoryId = 1;
        $menuItem->save();
        
        $menuItem = new \App\takeawayMenu;
        $menuItem->title = "Chicken Tikka (starter)";
        $menuItem->description = "Mildly marinated diced chicken or lamb roasted on skewers in the tandoori";
        $menuItem->menuCategoryId = 2;
        $menuItem->price = 3.25;
        $menuItem->save();

        $menuItem = new \App\takeawayMenu;
        $menuItem->title = "Aloo chat";
        $menuItem->description = "Spicy potatoes cooked in a special dry sauce with spices and herbs, served with puri bread";
        $menuItem->menuCategoryId = 2;
        $menuItem->price = 3.25;
        $menuItem->save();

        $menuItem = new \App\takeawayMenu;
        $menuItem->title = "Vegetable Samosa";
        $menuItem->description = "Spicy mix vegetable stuffed in thin pastry and deep fried";
        $menuItem->menuCategoryId = 2;
        $menuItem->price = 3.25;
        $menuItem->save();

        $menuItem = new \App\takeawayMenu;
        $menuItem->title = "Onion Bhajee";
        $menuItem->description = "Onion & lentils mixed with gramflour & spiced deep fried";
        $menuItem->menuCategoryId = 2;
        $menuItem->price = 3.25;
        $menuItem->save();

        $menuItem = new \App\takeawayMenu;
        $menuItem->title = "Meat Samosa";
        $menuItem->description = "Lamb mince stuffed in thin pastry and deep";
        $menuItem->menuCategoryId = 2;
        $menuItem->price = 3.25;
        $menuItem->save();

        $menuItem = new \App\takeawayMenu;
        $menuItem->title = "Tandoori chicken (starter)";
        $menuItem->description = "(On the bone).Tender chicken marinated in herbs & spices & barbecued in a clay oven";
        $menuItem->menuCategoryId = 3;
        $menuItem->price = 3.95;
        $menuItem->save();
     
        $menuItem = new \App\takeawayMenu;
        $menuItem->title = "Tandoori King Prawn";
        $menuItem->description = "King prawn marinated in special spices and grilled in the tandoori";
        $menuItem->menuCategoryId = 3;
        $menuItem->price = 13.95;
        $menuItem->save();

        $menuItem = new \App\takeawayMenu;
        $menuItem->title = "Tandoori Chicken (main)";
        $menuItem->description = "(On the bone).Tender chicken marinated in herbs & spices and barbecued in a clay oven";
        $menuItem->menuCategoryId = 3;
        $menuItem->price = 7.95;
        $menuItem->save();

        $menuItem = new \App\takeawayMenu;
        $menuItem->title = "Chicken Tikka (Main)";
        $menuItem->description = "Mildly marinated diced chicken or lamb roasted on skewers in the tandoori";
        $menuItem->menuCategoryId = 3;
        $menuItem->price = 7.50;
        $menuItem->save();

        $menuItem = new \App\takeawayMenu;
        $menuItem->title = "Bengal Tiger Special (Medium hot).";
        $menuItem->description = "Specially cooked with chicken tikka, lamb tikka & king prawn in chef’s own special sauce";
        $menuItem->menuCategoryId = 4;
        $menuItem->price = 11.95;
        $menuItem->save();
        
        $menuItem = new \App\takeawayMenu;
        $menuItem->title = "Shatkora gosht (Medium hot)";
        $menuItem->description = "Cooked with lamb tikka, chicken tikka in special tangy flavour sauce";
        $menuItem->menuCategoryId = 4;
        $menuItem->price = 9.50;
        $menuItem->save();
                
        $menuItem = new \App\takeawayMenu;
        $menuItem->title = "Lamb kufta(Medium hot)";
        $menuItem->description = "Lamb minced cooked on a special wok with herbs & spices served with red onion topping";
        $menuItem->menuCategoryId = 4;
        $menuItem->price = 9.50;
        $menuItem->save();

    }
}

