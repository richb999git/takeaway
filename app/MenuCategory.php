<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class MenuCategory extends Model
{
    // protected so table name plural is correct instead of Laravel assuming db should be "menu_categorys"
    protected $table = 'menu_categories';

    protected $fillable = [
        'category'
    ];

    public function takeawayMenu() {
        return $this->hasMany('App\takeawayMenu');
    }

    public static function updateCategory ($id, $category) {
        $menuCategory = MenuCategory::findOrFail($id);
        $menuCategory->category = $category;
        if(!$menuCategory->save()) {
            session()->flash('errorMessage', 'Error saving category');
        }
    }

    public static function deleteCategory ($id) {
        $menuCategory = MenuCategory::findOrFail($id);
        $menu = TakeawayMenu::all();
        $match = false;
        foreach ($menu as $menuItem) {
            if ($menuItem->menuCategoryId == $menuCategory->id) {
                $match = true;
            }
        }
        if ($match) {
            session()->flash('errorMessage', 'Unable to delete because of associated data');
        } else {
            $menuCategory->delete();
        }
    }

}
