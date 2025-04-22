<?php

namespace App\Http\Controllers;

use App\Data\ArticlesData;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the articles.
     */
    public function index()
    {
        $articles = ArticlesData::getArticles();
        $categories = ArticlesData::getCategories();
        $tags = ArticlesData::getTags();

        return view('blog.index', compact('articles', 'categories', 'tags'));
    }

    /**
     * Display the specified article.
     */
    public function show(string $slug)
    {
        $article = ArticlesData::getArticleBySlug($slug);

        if (!$article) {
            abort(404);
        }

        return view('blog.show', compact('article'));
    }

    /**
     * Display articles by category.
     */
    public function category(string $category)
    {
        $articles = ArticlesData::getArticlesByCategory($category);
        $categories = ArticlesData::getCategories();
        $tags = ArticlesData::getTags();

        return view('blog.index', compact('articles', 'categories', 'tags', 'category'));
    }

    /**
     * Display the about page.
     */
    public function about()
    {
        return view('blog.about');
    }
}
