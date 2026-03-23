<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Fieldset::make('Datos Básicos')
                    ->columnSpanFull()
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->label(__('Name'))
                            ->required(),
                        TextInput::make('email')
                            ->unique()
                            ->label(__('Email'))
                            ->email()
                            ->required(),
                        /*DateTimePicker::make('email_verified_at'),*/
                        TextInput::make('password')
                            ->label(__('Password'))
                            ->hiddenOn('edit')
                            ->password()
                            ->revealable()
                            ->required()
                            ->minValue(8),
                        /*Textarea::make('two_factor_secret')
                            ->columnSpanFull(),
                        Textarea::make('two_factor_recovery_codes')
                            ->columnSpanFull(),
                        DateTimePicker::make('two_factor_confirmed_at'),*/
                    ]),
            ]);
    }
    }
