<?php

namespace App\Http\Controllers;

use App\History;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        return History::all();
    }
 
    public function show($id)
    {
        return History::find($id);
    }

    public function store(Request $request)
    {
        return History::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $article = History::findOrFail($id);
        $article->update($request->all());

        return $article;
    }

    public function delete(Request $request, $id)
    {
        $article = History::findOrFail($id);
        $article->delete();

        return 204;
    }
}
