<?php

namespace App\Observers;

use App\Article;
use Illuminate\Support\Str;
use function uniqid;

class ArticleObserver
{
    public function saving($article)
    {
        $slug = Str::slug($article->title, '-');

        if (Article::where('slug', $slug)->exists()){
            $slug = $slug . uniqid();
        }

        $article->slug = $slug;
    }
}
