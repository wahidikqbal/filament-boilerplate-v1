<?php

namespace App\Filament\Resources\Users\Schemas;

use Illuminate\Support\Str;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\DateTimePicker;


class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->dehydrateStateUsing(fn($state) => Str::title($state))
                    ->extraInputAttributes(['style' => 'text-transform: capitalize'])
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                DateTimePicker::make('email_verified_at')
                    ->nullable()
                    ->default(null),
                TextInput::make('password')
                    ->password(),
            ]);
    }
}
