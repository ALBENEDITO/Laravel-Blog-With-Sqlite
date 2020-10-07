<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use App\Post;
use App\Category;

class WelcomeController extends Controller
{
  public function index(Request $request)
  {
    $term = ($request->has("term") ? $request->term : null);

    if ($term) {
        $posts = Post::with('user','category')->where('title', 'LIKE', "%{$term}%")
            ->orderBy('created_at','DESC')->get();
    } else {
        $posts = Post::with('user','category')->orderBy('created_at','DESC')->get();
    }

    $categories = Category::orderBy('name','ASC')->get();

    return response()->json(['posts' => $posts, 'categories' => $categories]);
  }

    public function show($id)
    {
        $post = Post::with('user','category')->find($id);

        if (!$post) {
            return response()->json([
                "error" => true,
                "message" => "Postagem não encontrada"
            ]);
        }

        $categories = Category::orderBy('name','ASC')->get();

        return response()->json(['post' => $post, 'categories' => $categories]);
    }

    public function byCategory($category_id)
    {
        $category = Category::findOrFail($category_id);

        if (!$category) {
            return response()->json([
                "error" => true,
                "message" => "Categoria não encontrada"
            ]);
        }

        $posts = $category->posts()->with('user','category')->orderBy('created_at', 'DESC')->get();

        $categories = Category::orderBy('name','ASC')->get();

        return response()->json(['posts' => $posts, 'categories' => $categories, 'category' => $category]);
    }

    public function byAuthor($user_id)
    {
        $user = User::findOrFail($user_id);

        if (!$user) {
            return response()->json([
                "error" => true,
                "message" => "Usuário não encontrado"
            ]);
        }

        $posts = $user->posts()->with('user','category')->orderBy('created_at', 'DESC')->get();

        $categories = Category::orderBy('name','ASC')->get();

        return response()->json(['posts' => $posts, 'categories' => $categories, 'user' => $user]);
    }
}