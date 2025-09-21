<?php

namespace App\Filament\Resources\Users\Schemas;

use Illuminate\Support\Str;
use Filament\Actions\Action;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DateTimePicker;


class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->placeholder('Branch Name')
                    ->dehydrateStateUsing(fn($state) => Str::title($state))
                    ->extraInputAttributes(['style' => 'text-transform: capitalize'])
                    ->required(),
                TextInput::make('slug')
                    ->label('Halaman')
                    ->placeholder('click the button next to generate a slug from your name')
                    ->suffixAction(
                        Action::make('generate')
                            ->icon('heroicon-m-sparkles')
                            ->tooltip('Generate dari Nama')
                            ->action(
                                fn(callable $get, callable $set) =>
                                $set('slug', Str::slug($get('name')))
                            )
                    )
                    ->dehydrated() // 🟢 penting: agar nilai slug ikut disimpan
                    ->required()
                    ->extraInputAttributes(['style' => 'text-transform: lowercase']),
                TextInput::make('email')
                    ->label('Email address')
                    ->placeholder('example@mail.com')
                    ->email()
                    ->required(),
                Select::make('roles')
                    ->label('Roles')
                    ->relationship('roles', 'name')
                    ->multiple()
                    ->preload()
                    ->searchable()
                    ->getOptionLabelFromRecordUsing(fn($record) => Str::title($record->name)),

                DateTimePicker::make('email_verified_at')
                    ->nullable()
                    ->default(null),
                TextInput::make('password')
                    ->password()
                    ->placeholder(
                        fn(string $context) => $context === 'create'
                            ? 'create your password'
                            : 'Leave blank if you dont want to change the password'
                    )
                    ->dehydrateStateUsing(fn($state) => filled($state) ? Hash::make($state) : null)
                    ->dehydrated(fn($state) => filled($state)) // hanya ikut disimpan jika ada isinya
                    ->required(fn(string $context) => $context === 'create') // hanya required saat create
                    ->autocomplete('new-password'),
            ]);
    }
}
