<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\User;
use App\Models\Role;
use App\Models\Project;


class ArticleController extends Controller
{

    public function view()
    {
        $this->authorize('create', Product::class);
        $articles = Article::orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        $this->authorize('create', Product::class);
        return view('admin.articles.create');
    }
    public function edit(Article $article)
    {
        $this->authorize('create', Product::class);
        return view('admin.articles.edit')->with('article', $article);
    }
    public function show(Article $article)
    {
        $this->authorize('create', Product::class);
        $articles = Article::all();
        return view('admin.articles.show', compact('articles'))->with('article', $article);
    }


    public function store(Request $request)
    {
        $this->authorize('create', Product::class);
        $article = new Article;
        $article->title = $request->title;
        $article->intro = $request->intro;
        $article->content = $request->content;
        $article->date = $request->date;
        $article->ExpDate = $request->ExpDate;
        if ($request->image) {
            $imageName = time() . uniqid() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $article->image = $imageName;
        }

        $request->user()->articles()->save($article);
        return redirect(route('admin.articles.index'))->with('statusCreate', __('Het artikel: "' . $article->title . '" is toegevoegd!'));
    }
    public function update(Article $article, Request $request)
    {
        $this->authorize('create', Product::class);
        $article->title = $request->title;
        $article->intro = $request->intro;
        $article->content = $request->content;
        $article->date = $request->date;
        $article->ExpDate = $request->ExpDate;

        if ($request->image) {
            $imageName = time() . uniqid() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $article->image = $imageName;
        }

        $article->save();


        return redirect()->route('articles.index')->with('statusUpdate', __('Het artikel: "' . $article->title . '" is aangepast!'));
    }

    public function destroy(Article $article)
    {

        $this->authorize('create', Product::class);
        unlink(public_path('/images/' . $article->image));

        $article->delete();

        return redirect()->route('admin.articles.index')->with('statusDelete', 'Het artikel "' . $article->title . '"  is verwijderd!');
    }
}
