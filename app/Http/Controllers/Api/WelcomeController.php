<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Category;

class WelcomeController extends Controller
{
  public function index(Request $request)
  {
    $term = ($request->has("term") ? $request->term : null);

    if ($term) {
        $posts = Post::with('user','category')->where('title', 'LIKE', "%{$term}%")->orderBy('created_at','DESC')->get();
    } else {
        $posts = Post::with('user','category')->orderBy('created_at','DESC')->get();
    }

    $categories = Category::orderBy('name','ASC')->get();

    return response()->json(['posts' => $posts, 'categories' => $categories]);
  }
}