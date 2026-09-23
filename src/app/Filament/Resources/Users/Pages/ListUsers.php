<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use App\Models\User;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('계정 생성'),
            Action::make('create_random_user')
                ->label('랜덤 계정 생성')
                ->action(function () {
                    User::factory()->create([
                        'remember_token' => null,
                    ])->assignRole('user');
                }),
        ];
    }
}
