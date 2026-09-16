<?php

use App\Models\Article;
use Illuminate\Support\Facades\Gate;
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
        Gate::authorize('delete', $this->article);

        $this->article->delete();

        return $this->redirectRoute('articles.index', navigate: true);
    }
};