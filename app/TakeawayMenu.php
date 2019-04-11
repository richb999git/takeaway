<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\MenuCategory;
use App\Services\CsvServices;


class TakeawayMenu extends Model
{
    // protected so table name and model are the same instead of Laravel assuming db should be "takeaway_menus"
    protected $table = 'takeaway_menu';

    // make all fields able to be mass updated. They are not be defult.
    protected $fillable = [
        'title', 'description', 'image', 'price', 'menuCategoryId'
    ];

    public function menuCategory() {
        return $this->BelongsTo('App\MenuCategory');
    }

    public static function addMenuItem($title, $description, $price, $category) {
        $menuItem = new \App\TakeawayMenu;        
        $menuItem->title = $title;
        $menuItem->description = $description; 
        $menuItem->price = $price;
        $menuItem->menuCategoryId = $category;
        if(!$menuItem->save()) {
            session()->flash('errorMessage', 'Error saving menu item');
            return redirect()->route('showMenuItems');
        };
        return $menuItem;
    }

    public static function updateMenuItem($id, $title, $description, $price, $category) {
        $menuItem = TakeawayMenu::findOrFail($id);        
        $menuItem->title = $title;
        $menuItem->description = $description; 
        $menuItem->price = $price;
        $menuItem->menuCategoryId = $category;
        if(!$menuItem->save()) {
            session()->flash('errorMessage', 'Error saving menu item');
            return redirect()->route('showMenuItems');
        };
        return $menuItem;
    }

    public static function importMenuCsv ($menuArr) {
        foreach ($menuArr as $menuArrItem) {
            TakeawayMenu::firstOrCreate($menuArrItem); // only add an item if any part of it is new
        }
    }

    public static function checkMenuUpload($file)
    {
        if (!$file) {
            session()->flash('errorMessage', 'Error: No file chosen');
            return false; 
        }
        
        $extension = $file->getClientOriginalExtension();
        if ($extension != "csv") {
            session()->flash('errorMessage', 'Error: Wrong file type');
            return false; 
        }

        $menuArr = CsvServices::csvToArray($file);
        if ($menuArr == false || $menuArr == []) {
            session()->flash('errorMessage', 'Error loading file. Please try again');
            return false; 
        }
        
        // check that the required columns are included
        if (!array_key_exists('title', $menuArr[0]) || !array_key_exists('price', $menuArr[0]) || !array_key_exists('menuCategoryId', $menuArr[0])) {
            session()->flash('errorMessage', 'Missing columns. Please try again');
            return false;
        }        
        
        // check that no invalid columns are included
        $keys = array_keys($menuArr[0]);
        foreach ($keys as $key) {
            if ( $key != 'title' && $key != 'description' && $key != 'price' && $key != 'menuCategoryId' ) {
                session()->flash('errorMessage', 'Invalid column. Please try again');
                return false; 
            }
        }

        // Check columns to upload are valid. ID isn't
        foreach ($menuArr as $menuItem) {
            if ($menuItem['title'] == "" || $menuItem['price'] == "" || $menuItem['menuCategoryId'] == "") {
                session()->flash('errorMessage', 'Blank data is invalid. Please try again');
                return false;
            }
            if (!is_numeric($menuItem['price'])) {
                session()->flash('errorMessage', 'Data type of price is invalid. Please try again');
                return false; 
            } else if (!is_numeric($menuItem['menuCategoryId'])) {
                session()->flash('errorMessage', 'Data type of menuCategoryId is invalid. Please try again');
                return false; 
            } else if ((int)$menuItem["menuCategoryId"] != $menuItem["menuCategoryId"] ) {
                session()->flash('errorMessage', 'Data type of menuCategoryId is not an integer. Please try again');
                return false;  
            }           
        }

        //check that the menuCategoryId is in the menuCategory table
        $menuCategories = MenuCategory::all('id');
        $menuCategories = json_decode(json_encode($menuCategories), true); // convert object into array
        $menuCategories = array_column($menuCategories,'id'); // convert into normal flat array
        foreach ($menuArr as $menuItem) {
            $item = (int)$menuItem['menuCategoryId'];
            if (!in_array($item, $menuCategories)) {
                session()->flash('errorMessage', 'Invalid menuCategoryId. Please try again or enter new menu category');
                return false; 
            }
        }

        return $menuArr;
    }

}
