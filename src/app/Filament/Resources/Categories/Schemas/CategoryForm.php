<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Category')
                ->schema([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(15),
                    TextInput::make('slug')
                        ->required()
                        ->maxLength(20),
                    TextInput::make('parent_id')
                        ->numeric()
                        ->default(null),
                ])->columns(3)
            ]);
    }
}
