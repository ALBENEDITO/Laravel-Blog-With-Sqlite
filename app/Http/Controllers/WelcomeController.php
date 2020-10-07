<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class WelcomeController extends Controller
{
    public function index(Request $request)
    {
        $term = ($request->has("term") ? $request->term : null);

        if ($term) {
            $posts = Post::where('title', 'LIKE', "%{$term}%")
                ->orderBy('created_at', 'DESC')->get();
        } else {
            $posts = Post::orderBy('created_at', 'DESC')->get();
        }

        $categories = Category::orderBy('name','ASC')->get();
        return view('welcome', compact('posts','categories'));
    }

    public function post($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();
        return view("single", compact('post','categories'));
    }

    public function byCategory($category_id)
    {
        $category = Category::findOrFail($category_id);

        if (!$category) {
            Session::flash('danger', 'Categoria não encontrada');
            return redirect()->route('welcome');
        }

        $posts = $category->posts()->orderBy('created_at', 'DESC')->get();

        $categories = Category::orderBy('name','ASC')->get();
        return view('category', compact('posts','categories', 'category'));
    }

    public function byAuthor($user_id)
    {
        $user = User::findOrFail($user_id);

        if (!$user) {
            Session::flash('danger', 'Usuário não encontrado');
            return redirect()->route('welcome');
        }

        $posts = $user->posts()->orderBy('created_at', 'DESC')->get();

        $categories = Category::orderBy('name','ASC')->get();
        return view('author', compact('posts','categories', 'user'));
    }
}
