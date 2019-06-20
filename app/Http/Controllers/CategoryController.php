<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('manage', 'App\Category');
        $categories = Category::orderBy('display_order')->get();
        return view('admin.category.index', [
            'categories' => $categories
        ]);
    }

    public function upsert(Request $request)
    {
        $this->authorize('manage', 'App\Category');
        $categories = $request->post('categories');

        // Update existing categories and store new categories
        foreach ($categories as $category) {
            if ($category['id']) // Not empty or 0
                Category::where('id', $category['id'])->update($category);
            else
                Category::create($category);
        }
        return [
            'success' => true,
            'categories' => Category::all()
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the items in a category.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function items(Category $category)
    {
        return $category->menuItems->map(function ($item) {
            return $item->only(['id', 'name']);
        });
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return array
     * @throws \Exception
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Category $category)
    {
        $this->authorize('delete', $category);
        $category->delete();
        return ['success' => true];
    }
}
