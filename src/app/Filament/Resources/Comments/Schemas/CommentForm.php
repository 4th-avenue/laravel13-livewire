<?php

namespace App\Filament\Resources\Comments\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CommentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('article_id')
                    ->relationship('article', 'title')
                    ->required(),
                Select::make('user_id')
                    ->relationship('user', 'id')
                    ->required(),
                TextInput::make('parent_id')
                    ->numeric()
                    ->default(null),
                TextInput::make('mentioned_user_id')
                    ->numeric()
                    ->default(null),
                TextInput::make('body')
                    ->required()
                    ->maxLength(2000),
                TextInput::make('ip_address')
                    ->default(null),
            ]);
    }
}
