<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleAPIController extends Controller
{
    public function imagePath(Request $request)
    {
        $input = $request->all();
        dd($input);
        $image = $request->file('cover');
        $imageName = date('YmdHis') . "." . $image->getClientOriginalExtension();
        $pathImage =  'cover/' . $imageName;
        $image->storeAs('cover/', $imageName, ['disk' => 'public']);
        return response()->json([
            'message' => 'Success',
            'data' => $pathImage
        ], 200);
    }
    public function index()
    {
        $index = Article::where('user_id', Auth::id())->get();
        return response()->json([
            'message' => 'Success',
            'data' => $index
        ], 200);
    }
    public function store(Request $request)
    {
        $input = $request->all();
        $input['name'] = $input['title'];
        $image = $request->file('cover');
        $imageName = date('YmdHis') . "." . $image->getClientOriginalExtension();
        $pathImage =  'cover/' . $input['name'] . '/' . '/' . $imageName;
        $image->storeAs('cover/' . $input['name'] . '/' . '/', $imageName, ['disk' => 'public']);
        $input['cover'] = $pathImage;
        $input['user_id'] = Auth::id();
        $input['slug'] = Str::slug($input['title']);
        $input['article_code'] = 'ARTICLE' . Str::random(4) . time();
        $input['cover'] = $pathImage;
        $article = Article::create($input);
        return response()->json([
            'message' => 'Success'
        ], 200);
    }

    public function show($id)
    {
        // dd(Auth::id());
        $article = Article::where('id', $id)->where('user_id', Auth::user()->id)->get();
        return response()->json([
            'message' => 'Success',
            'data' => $article
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $article = Article::find($id);
        // dd($article);
        $input['name'] = $input['title'];
        if ($request->hasFile('cover')) {
            Storage::disk('public')->delete($article->cover);
            $image = $request->file('cover');
            $imageName = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $pathImage =  'cover/' . $input['name'] . '/' . '/' . $imageName;
            $image->storeAs('cover/' . $input['name'] . '/' . '/', $imageName, ['disk' => 'public']);
        } else {
            $pathImage = $article->cover;
        }
        $input['cover'] = $pathImage;
        Article::find($id)->update([
            'title' => $input['title'],
            'tag' => $input['tag'],
            'description' => $input['description'],
            'cover' => $input['cover']
        ]);
        return response()->json([
            'message' => 'Success'
        ], 200);
    }

    public function destroy($id)
    {
        // dd($id);
        $article = Article::find($id);
        Storage::disk('public')->delete($article->cover);
        $article->delete();
        return response()->json([
            'message' => 'Success'
        ], 200);
    }
}
