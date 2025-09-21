<?php

namespace App\Filament\Resources\Menus\Schemas;

use Illuminate\Support\Str;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class MenuForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // TextInput::make('user_id')
                //     ->required()
                //     ->numeric(),

                Hidden::make('user_id')
                    ->default(auth()->id())
                    ->dehydrated(true),
                TextInput::make('title')
                    ->dehydrateStateUsing(fn($state) => Str::title($state))
                    ->extraInputAttributes(['style' => 'text-transform: capitalize'])
                    ->required(),
                SpatieMediaLibraryFileUpload::make('menu_image')
                    ->collection('menus')
                    ->image()
                    ->maxSize(1024)
                    ->preserveFilenames()
                    ->columnSpanFull(),
                Textarea::make('description')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('Rp.'),
                TextInput::make('discount_price')
                    ->numeric()
                    ->prefix('Rp.')
                    ->default(null),
            ]);
    }
}
