<?php

namespace App\Exports;

use App\Models\Article;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class ArticlesExport implements FromCollection
{
    public function collection(): Collection
    {
        return Article::all();
    }
}
