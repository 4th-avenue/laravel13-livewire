<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('User')
                    ->schema([
                        TextInput::make('userid')
                            ->required()
                            ->unique(),
                        TextInput::make('nickname')
                            ->required()
                            ->unique(),
                        TextInput::make('email')
                            ->label('Email address')
                            ->email()
                            ->required()
                            ->unique(),
                        DateTimePicker::make('email_verified_at'),
                        Select::make('roles')
                            ->relationship(titleAttribute: 'name')
                            ->preload(),
                        TextInput::make('photo_path')
                            ->default(null),
                        TextInput::make('password')
                            ->password()
                            ->required(fn (string $operation): bool => $operation === 'create')
                            ->dehydrated(fn (?string $state) => filled($state)),
                    ])->columns(2)
                    ->columnSpanFull()
            ]);
    }
}
