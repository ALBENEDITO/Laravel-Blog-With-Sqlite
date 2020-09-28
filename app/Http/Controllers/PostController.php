<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class PostController extends Controller
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
        $posts = auth()->user()->posts()->get();
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = auth()->user()->categories()->get();
        return view('posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            "category_id" => "required",
            "title" => "required|min:5|max:100",
            "body" => "required|max:5000",
            "image" => "required|image|mimes:png,jpeg,jpg|max:2048"
        ]);

        $data = $this->uploadData($request);

        $request->user()->posts()->create($data);

        Session::flash('success', 'Postagem criada com sucesso');

        return redirect()->route('posts.index');

    }

    private function uploadData($request)
    {
        $data = $request->all();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . "-" . $image->getClientOriginalName();
            Image::make($image->path())->fit(750, 300)->save(public_path("uploads/") . $filename);
            $data["image"] = $filename;
        }

        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = auth()->user()->posts()->find($id);

        if (!$post) {
            Session::flash('danger', 'Postagem não encontrada');
            return redirect()->route('posts.index');
        }

        $categories = auth()->user()->categories()->get();

        return view('posts.edit', compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            "category_id" => "required",
            "title" => "required|min:5|max:100",
            "body" => "required|min:5|max:100",
        ]);

        $post = auth()->user()->posts()->find($id);

        if (!$post) {
            Session::flash('danger', 'Postagem não encontrada');
            return redirect()->route('posts.index');
        }

        $post->update($request->all());

        Session::flash('success', 'Postagem atualizada com sucesso');

        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = auth()->user()->posts()->find($id);

        if (!$post) {
            Session::flash('danger', 'Postagem não encontrada');
            return redirect()->route('posts.index');
        }

        $post->delete();

        Session::flash('success', 'Postagem deletada com sucesso');

        return redirect()->route('posts.index');
    }
}
