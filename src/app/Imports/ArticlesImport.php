<?php

namespace App\Imports;

use App\Models\Article;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ArticlesImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row): Model|null
    {
        Article::unguard();

        $article = new Article([
            'id' => $row['id'],
            'category_id' => $row['category_id'],
            'title' => $row['title'],
            'user_id' => $row['user_id'],
            'body' => $row['body'],
            'images' => $row['images'],
            'view_count' => $row['view_count'] ?? 0,
            'ip_address' => $row['ip_address'],
            'created_at' => $row['created_at'],
            'updated_at' => $row['updated_at'],
            'deleted_at' => $row['deleted_at'],
        ]);

        Article::reguard();

        return $article;
    }
}
