<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryFormRequest;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = $request->user()->categories()->get();

        return response()->json($categories);
    }

    public function store(CategoryFormRequest $request)
    {
        $request->user()->categories()->create($request->all());

        return response()->json([
            "error" => false,
            "message" => "Categoria criada com sucesso"
        ]);
    }

    public function edit(Request $request, $id)
    {
        $category = $request->user()->categories()->find($id);

        if (!$category) {
            return response()->json([
                "error" => true,
                "message" => "Categoria não encontrada"
            ]);
        }

        return response()->json($category);
    }

    public function update(CategoryFormRequest $request, $id)
    {
        $category = $request->user()->categories()->find($id);

        if (!$category) {
            return response()->json([
                "error" => true,
                "message" => "Categoria não encontrada"
            ]);
        }

        $category->update($request->all());

        return response()->json([
            "error" => false,
            "message" => "Categoria atualizada com sucesso"
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $category = $request->user()->categories()->find($id);

        if (!$category) {
            return response()->json([
                "error" => true,
                "message" => "Categoria não encontrada"
            ]);
        }

        if ($category->posts()->count() > 0) {
            return response()->json([
                "error" => true,
                "message" => 'Não foi possível deletar a categoria, pois existem ' . $category->posts()->count() . ' postagens vinculadas a ela.'
            ]);
        }

        $category->delete();

        return response()->json([
            "error" => false,
            "message" => "Categoria deletada com sucesso"
        ]);
    }
}