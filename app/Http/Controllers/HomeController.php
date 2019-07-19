<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::orderBy('display_order')->get();

        return view('home', [
            'categories' => $categories
        ]);
    }

    /**
     * Shows the items that are on the menu.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function menu()
    {
        $categories = Category::with('menuItems')->orderBy('display_order')->get();
        return view('menu', ['categories' => $categories]);
    }
}
