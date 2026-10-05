<?php

namespace App\Filament\Resources\Articles\Pages;

use App\Filament\Resources\Articles\ArticleResource;
use App\Imports\ArticlesImport;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ListArticles extends ListRecords
{
    protected static string $resource = ArticleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
            Action::make('importArticles')
                ->label('Import Articles')
                ->icon('heroicon-o-document-arrow-up')
                ->schema([
                    FileUpload::make('attachment')
                        ->disk('public')
                        ->required(),
                ])
                ->action(function (array $data){
                    $disk = Storage::disk('public');
                    $relativePath = $data['attachment'];

                    $filePath = $disk->path($relativePath);

                    try {
                        Excel::import(new ArticlesImport, $filePath);

                        Notification::make()
                            ->title('Articles Imported')
                            ->success()
                            ->send();
                    } catch (\Throwable $e) {
                        Notification::make()
                            ->title('Import Failed')
                            ->body('파일 처리 중 오류가 발생했습니다: ' . $e->getMessage())
                            ->danger()
                            ->send();
                    } finally {
                        if ($disk->exists($relativePath)) {
                            $disk->delete($relativePath);
                        }
                    }
                }),
        ];
    }
}
