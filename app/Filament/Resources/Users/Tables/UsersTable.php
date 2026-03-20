<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Support\Enums\Width;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('Name'))
                    ->searchable(),
                TextColumn::make('email')
                    ->label(__('Email'))
                    ->searchable(),
                /*TextColumn::make('email_verified_at')
                    ->dateTime()
                    ->sortable(),*/
               /* TextColumn::make('two_factor_confirmed_at')
                    ->dateTime()
                    ->sortable(),*/
                TextColumn::make('created_at')
                    ->label(__('Created'))
                    ->dateTime()
                    ->sortable(),
                /*TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),*/
            ])
            ->filters([
                //
            ])
            ->recordActions([
               /* EditAction::make(),*/
                ActionGroup::make([
                    Action::make('Restablecer Contraseña')
                        ->schema([
                            TextInput::make('password')
                                ->label(__('New password'))
                                ->password()
                                ->required(),
                        ])
                        ->icon(Heroicon::Key)
                        ->action(function (array $data, Model $record): void {
                            $record->update([
                                'password' => $data['password'],
                            ]);
                            Notification::make()
                                ->title('Contraseña actualizada con éxito')
                                ->success()
                                ->send();
                        })
                        ->modalWidth(Width::ExtraSmall),
                    EditAction::make(),
                    DeleteAction::make(),


                ]),

            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
