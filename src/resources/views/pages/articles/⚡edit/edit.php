<?php

use App\Models\Article;
use App\Models\Category;
use Livewire\Attributes\Validate;
use Livewire\Component;

new class extends Component
{
    public Article $article;

    #[Validate('required|exists:categories,id')]
    public $category_id;
    #[Validate('required|string|max:60')]
    public $title;
    #[Validate('required|string|max:21844')]
    public $body;

    public $childCategories = [];

    public function mount(Article $article)
    {
        $this->article = $article;

        $this->fill($this->article->only(['category_id', 'title', 'body']));

        $this->childCategories = Category::whereNotNull('parent_id')
            ->pluck('name', 'id')
            ->toArray();
    }

    public function save()
    {
        $this->validate();

        $this->article->update(
            $this->only(['category_id', 'title', 'body'])
        );

        return $this->redirectRoute('articles.show', $this->article, navigate: true);
    }
};