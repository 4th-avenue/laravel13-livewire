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

        $sessionKey = 'article.' . $article->id;

        if (! session($sessionKey)) {
            $this->article->increment('view_count');
            session([$sessionKey => true]);
        }
    }

    public function deleteArticle()
    {
        Gate::authorize('delete', $this->article);

        $this->article->delete();

        return $this->redirectRoute('articles.index', navigate: true);
    }
};