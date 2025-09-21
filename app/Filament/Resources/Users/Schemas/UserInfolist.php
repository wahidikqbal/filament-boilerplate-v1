<?php

namespace App\Filament\Resources\Users\Schemas;

use Dom\Text;
use Filament\Schemas\Schema;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;

class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('email')
                    ->label('Email address'),
                TextEntry::make('slug')
                    ->label('Halaman'),
                TextEntry::make('email_verified_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('roles')
                    ->label('Roles')
                    ->getStateUsing(fn($record) => $record->roles->pluck('name')->map(fn($name) => ucwords($name))->join(', '))
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                ImageEntry::make('avatar_url')
                    ->getStateUsing(fn($record) => $record->avatar_url ? asset('storage/' . $record->avatar_url) : null)
                    ->placeholder('-'),
            ]);
    }
}
