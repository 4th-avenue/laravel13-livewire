<?php

namespace App\Imports;

use App\Models\Article;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;

class ArticlesImport implements ToModel
{
    public function model(array $row): Model|null
    {
        return new Article([
            //
        ]);
    }
}
