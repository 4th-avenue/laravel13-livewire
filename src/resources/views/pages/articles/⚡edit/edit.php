<?php

use App\Livewire\Forms\ArticleForm;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

new class extends Component
{
    public Article $article;

    public ArticleForm $form;

    public $childCategories = [];

    public function mount(Article $article)
    {
        Gate::authorize('update', $this->article);

        $this->article = $article;

        $this->form->fill($this->article->only(['category_id', 'title', 'body']));

        $this->childCategories = Category::whereNotNull('parent_id')
            ->pluck('name', 'id')
            ->toArray();
    }

    public function save()
    {
        Gate::authorize('update', $this->article);

        $this->form->validate();

        $this->article->update(
            $this->form->only(['category_id', 'title', 'body'])
        );

        return $this->redirectRoute('articles.show', $this->article, navigate: true);
    }
};