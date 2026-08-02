<?php

namespace App\Filament\Resources\Permissions\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PermissionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Permission')
                    ->schema([
                        TextInput::make('name')
                            ->minLength(2)
                            ->maxLength(30)
                            ->required()
                            ->unique()
                    ])
            ]);
    }
}
