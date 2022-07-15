<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index()
    {
        return view('pages.article.index');
    }

    public function create()
    {
        return view('pages.article.create');
    }

    public function store(Request $request)
    {
        $response = Http::post('http://127.0.0.1:8000/api/article', [
            'title' => $request->get('title'),
            'tag' => $request->get('tag'),
            'description' => $request->get('description'),
            'cover' => $request->get('cover'),
        ]);
        return redirect()->route('article.index');
    }

    public function show($id)
    {
        $data['id'] = $id;
        // dd($data);
        return view('pages.article.show', $data);
    }


    public function edit($id)
    {
        $data['id'] = $id;
        return view('pages.article.edit', $data);
    }
    public function update(Request $request, $id)
    {
        $response = Http::post('http://127.0.0.1:8000/api/article/' . $id, [
            'title' => $request->get('title'),
            'tag' => $request->get('tag'),
            'description' => $request->get('description'),
            'cover' => $request->get('cover'),
        ]);
        return redirect()->route('article.show', $id);
    }
    public function destroy($id)
    {
    }
}
