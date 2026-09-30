<?php

namespace App\Exports;

use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ArticlesExport implements FromCollection, WithMapping, WithHeadings
{
    use Exportable;

    public function __construct(public Collection $records)
    {
        //
    }

    public function collection(): Collection
    {
        return $this->records;
    }

    public function map($article): array
    {
        return [
            $article->id,
            $article->category_id,
            $article->title,
            $article->user_id,
            $article->body,
            $article->images,
            $article->view_count,
            $article->ip_address,
            $article->created_at,
            $article->updated_at,
            $article->deleted_at,
        ];
    }

    public function headings(): array
    {
        return [
            'Id',
            'Category Id',
            'Title',
            'User Id',
            'Body',
            'Images',
            'View Count',
            'Ip Address',
            'Created At',
            'Updated At',
            'Deleted At',
        ];
    }
}
