<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class ArticleForm extends Form
{
    #[Validate('required|exists:categories,id')]
    public int $category_id;

    #[Validate('required|string|max:60')]
    public string $title;

    #[Validate('required|string|max:21844')]
    public string $body;
}
