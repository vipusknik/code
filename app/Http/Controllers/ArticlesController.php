<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Article\{
    Article,
    ArticleCategory
};

use App\Http\Requests\Article\{
    ArticleFormRequest
};

use App\Modules\Search\{
    ArticleSearch
};

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $articles = ArticleSearch::applyFilters($request)
            ->orderBy('created_at')
            ->paginate(15);

        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleFormRequest $request)
    {
        $article = Article::create(
            $request->except('new_category', 'categories')
        );

        $article->categories()->sync(
            $this->getCategoriesFrom($request)
        );

        return redirect()->route('articles.show', $article);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleFormRequest $request, Article $article)
    {
        $article->update(
            $request->except('new_category', 'categories')
        );

        $article->categories()->sync(
            $this->getCategoriesFrom($request)
        );

        return redirect()->route('articles.show', $article);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();

        return back()->withMessage('Статья удалена');
    }

    private function getCategoriesFrom($request)
    {
        $categories = collect(
            $request->categories ?: []
        );

        if ($request->has('new_category')) {
            $category = ArticleCategory::create(['title' => $request->new_category]);
            $categories->push($category->id);
        }

        return $categories;
    }
}
