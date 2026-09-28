<?php

namespace App\Filament\Resources\Categories\Pages;

use App\Filament\Resources\Categories\CategoryResource;
use Filament\Actions\DeleteAction;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EditCategory extends EditRecord
{
    protected static string $resource = CategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->action(function ($record, array $data, DeleteAction $action) {
                    $user = Auth::user();

                    if (! $user || ! Hash::check($data['password'], $user->password)) {
                        Notification::make()
                            ->title('비밀번호가 일치하지 않습니다.')
                            ->danger()
                            ->send();

                        $action->cancel();
                    }

                    $record->delete();
                })
                ->requiresConfirmation()
                ->modalHeading('카테고리 삭제')
                ->modalDescription('이 카테고리를 삭제하려면 비밀번호를 입력하세요.')
                ->schema([
                    TextInput::make('password')
                        ->password()
                        ->label('비밀번호 입력')
                        ->required(),
                ])
        ];
    }
}
