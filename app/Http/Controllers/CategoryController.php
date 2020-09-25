<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryFormRequest;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = auth()->user()->categories()->get();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CategoryFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryFormRequest $request)
    {
        $request->user()->categories()->create($request->all());

        Session::flash('success', 'Categoria criada com sucesso');

        return redirect()->route('categories.index');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = auth()->user()->categories()->find($id);

        if (!$category) {
            Session::flash('danger', 'Categoria não encontrada');
            return redirect()->route('categories.index');
        }

        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CategoryFormRequest  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryFormRequest $request, $id)
    {
        $category = auth()->user()->categories()->find($id);

        if (!$category) {
            Session::flash('danger', 'Categoria não encontrada');
            return redirect()->route('categories.index');
        }

        $category->update($request->all());

        Session::flash('success', 'Categoria atualizada com sucesso');

        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = auth()->user()->categories()->find($id);

        if (!$category) {
            Session::flash('danger', 'Categoria não encontrada');
            return redirect()->route('categories.index');
        }

        if ($category->posts()->count() > 0) {
            Session::flash('danger', 'Não foi possível deletar a categoria, pois existem ' . $category->posts()->count() . ' postagens vinculadas a ela.');
            return redirect()->route('categories.index');
        }

        $category->delete();

        Session::flash('success', 'Categoria deletada com sucesso');

        return redirect()->route('categories.index');
    }
}
