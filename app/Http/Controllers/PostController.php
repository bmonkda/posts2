<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Post;
use App\Models\Subcategoria;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::all();
        return view('posts.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        
        $request->validate([
            'titulo' => 'required|max:255',
            'contenido' => 'required',
            'categoria' => 'required|exists:categorias,id',
            'subcategoria' => 'required|exists:subcategorias,id',
        ]);

        $post = new Post;
        $post->titulo = $request->input('titulo');
        $post->contenido = $request->input('contenido');
        $post->categoria_id = $request->input('categoria');
        $post->subcategoria_id = $request->input('subcategoria');
        $post->save();

        // return redirect()->route('posts.show', $post);
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        // $posts = Post::all();
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        // $categorias = Categoria::all();
        // $subcategorias = Subcategoria::where('categoria_id', $post->categoria_id)->get();
        // return view('posts.edit', compact('post', 'categorias', 'subcategorias'));

        $categorias = Categoria::all();
        $subcategorias = $post->categoria_id ? Subcategoria::where('categoria_id', $post->categoria_id)->get() : collect();

        return view('posts.edit', compact('post', 'categorias', 'subcategorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'titulo' => 'required|max:255',
            'contenido' => 'required',
            'categoria' => 'nullable|exists:categorias,id',
            'subcategoria' => 'nullable|exists:subcategorias,id',
        ]);

        $post->titulo = $request->input('titulo');
        $post->contenido = $request->input('contenido');
        $post->categoria_id = $request->input('categoria');
        $post->subcategoria_id = $request->input('subcategoria');
        $post->save();

        return redirect()->route('posts.index');
        // return redirect()->route('posts.show', $post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index');
    }

    public function getCategorias()
    {
        $categorias = Categoria::all();
        return response()->json($categorias);
    }

    public function getSubcategorias($categoria)
    {
        $subcategorias = Subcategoria::where('categoria_id', $categoria)->pluck('nombre', 'id');
        return response()->json($subcategorias);
    }

    public function storeOrUpdatePost(Request $request, $id = null)
    {
        $post = $id ? Post::find($id) : new Post;
        $post->titulo = $request->titulo;
        $post->contenido = $request->contenido;
        $post->categoria_id = $request->categoria_id;
        $post->save();
        return response()->json(['success' => true]);
    }

}
