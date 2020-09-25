<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias_count = auth()->user()->categories()->count();
        $posts_count = auth()->user()->posts()->count();
        return view('home', compact('categorias_count','posts_count'));
    }
}
