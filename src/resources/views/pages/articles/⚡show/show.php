<?php

use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

new class extends Component
{
    public Article $article;

    public function mount(Article $article)
    {
        $this->article = $article->load('user:id,nickname');
    }

    public function deleteArticle()
    {
        if (Auth::check()) {
            $this->article->delete();
        } else {
            return $this->redirectRoute('login', navigate: true);
        }

        return $this->redirectRoute('articles.index', navigate: true);
    }
};