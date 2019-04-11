<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TakeawayMenu;
use App\Order;
use App\MenuCategory;
use Session;


class PageController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function MenuIndex()
    {
        $menu = TakeawayMenu::all();
        $menuCategories = MenuCategory::all();
        return view('menu.menuIndex', ['menu' => $menu, 'menuCategories' => $menuCategories] );
    }

    public function find_us()
    {
        return view('find_us');
    }

}
