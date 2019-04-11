<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MenuCategory;
use App\TakeawayMenu;
use App\Services\CsvServices;

class AdminMenuCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menuCategories = MenuCategory::all();
        return view('admin.showMenuCategories', ['menuCategories' => $menuCategories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.addMenuCategory');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'category' => ['required', 'max:150']
        ]);
        MenuCategory::create(['category' => request('category')]);   
        return redirect()->route('menuCategories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // not used
        return $this->index();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menuCategory = MenuCategory::findOrFail($id);
        return view('admin.editMenuCategory', ['menuCategory' => $menuCategory]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'category' => ['required', 'max:150']
        ]);
        MenuCategory::updateCategory($id, request('category'));
        return redirect()->route('menuCategories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        MenuCategory::deleteCategory($id);
        return redirect()->back();
    }
    

    public function downloadCategories() {
        $rows = MenuCategory::all('id', 'category');
        $rows = json_decode(json_encode($rows), true);
        $columnNames = ['id', 'category'];
        return CsvServices::getCsv($columnNames, $rows, 'categories.csv');
    }
}
