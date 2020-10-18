<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $Posts = $request->user()->posts()->get();

        return response()->json($Posts);
    }

    public function store(Request $request)
    {
         $this->validate($request, [
            "category_id" => "required",
            "title" => "required|min:5|max:100",
            "body" => "required|max:5000",
            "image" => "image|mimes:png,jpeg,jpg|max:2048"
        ]);

        $request->user()->posts()->create($request->all());

        return response()->json([
            "error" => false,
            "message" => "Categoria criada com sucesso"
        ]);
    }

    public function edit(Request $request, $id)
    {
        $post = $request->user()->posts()->find($id);

        if (!$post) {
            return response()->json([
                "error" => true,
                "message" => "Categoria não encontrada"
            ]);
        }

        return response()->json($post);
    }

    public function update(PostFormRequest $request, $id)
    {
        $post = $request->user()->posts()->find($id);

        if (!$post) {
            return response()->json([
                "error" => true,
                "message" => "Categoria não encontrada"
            ]);
        }

        $post->update($request->all());

        return response()->json([
            "error" => false,
            "message" => "Categoria atualizada com sucesso"
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $post = $request->user()->posts()->find($id);

        if (!$post) {
            return response()->json([
                "error" => true,
                "message" => "Categoria não encontrada"
            ]);
        }

        if ($post->posts()->count() > 0) {
            return response()->json([
                "error" => true,
                "message" => 'Não foi possível deletar a categoria, pois existem ' . $post->posts()->count() . ' postagens vinculadas a ela.'
            ]);
        }

        $post->delete();

        return response()->json([
            "error" => false,
            "message" => "Categoria deletada com sucesso"
        ]);
    }
}