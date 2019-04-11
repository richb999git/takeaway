<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MenuCategory;
use App\TakeawayMenu;
use App\Services\CsvServices;

class AdminMenuController extends Controller
{

    public function showMenuItems () 
    {
        $menu = TakeawayMenu::all();
        $menuCategories = MenuCategory::all();
        return view('admin.showMenuItems', ['menu' => $menu, 'menuCategories' => $menuCategories] );
    }

    public function enterMenuItem () 
    {
        $menuCategories = MenuCategory::all();
        return view('admin.addMenuItem', ['menuCategories' => $menuCategories] );
    }

    public function addMenuItem () 
    {
        request()->validate([
            'title' => ['required', 'min:3', 'max:50'],
            'description' => ['max:150'],
            'price' => ['required', 'numeric'], 
            'category' => ['required', 'integer']
        ]);
        TakeawayMenu::addMenuItem(request('title'), request('description'), request('price'), request('category'));
        return redirect()->route('showMenuItems');
    }

    public function editMenuItem ($id) 
    {
        $menuItem = TakeawayMenu::findOrFail($id);
        $menuCategories = MenuCategory::all();
        return view('admin.editMenuItem', ['menuItem' => $menuItem, 'menuCategories' => $menuCategories] );
    }

    public function updateMenuItem ($id) 
    {
        request()->validate([
            'title' => ['required', 'min:3', 'max:50'],
            'description' => ['max:150'],
            'price' => ['required', 'numeric'], 
            'category' => ['required', 'integer']
        ]);

        TakeawayMenu::updateMenuItem($id, request('title'), request('description'), request('price'), request('category'));
        return redirect()->route('showMenuItems');
    }

    public function deleteMenuItem ($id)
    {
        $menuItem = TakeawayMenu::findOrFail($id);
        $menuItem->delete();
        return redirect()->route('showMenuItems');
    }

    public function downloadMenu() {
        $rows = TakeawayMenu::all('title', 'description', 'price', 'menuCategoryId');
        $rows = json_decode(json_encode($rows), true);
        $columnNames = ['title', 'description', 'price', 'menuCategoryId' ];
        return CsvServices::getCsv($columnNames, $rows, 'menu.csv');
    }

    public function uploadMenu() {
        return view('admin.uploadMenu');
    }

    public function importMenuCsv()
    {
        $file = request("menuFile");
        $menuArr = TakeawayMenu::checkMenuUpload($file);
        if (!$menuArr) return redirect()->back(); // with error message if any
        TakeawayMenu::importMenuCsv($menuArr);
        session()->flash('errorMessage', 'Menu uploaded');
        
        return redirect()->route('showMenuItems');  
    }

}
