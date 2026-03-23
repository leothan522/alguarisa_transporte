<?php

namespace App\Filament\Resources\Users\Tables;

use App\Models\User;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Support\Enums\Width;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
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
                    ->searchable()
                    ->visibleFrom('md'),
                TextColumn::make('email')
                    ->label(__('Email'))
                    ->searchable()
                    ->visibleFrom('md'),
                TextColumn::make('created_at')
                    ->label(__('Created'))
                    ->date()
                    ->visibleFrom('md'),
                TextColumn::make('vista_movil')
                    ->label(__('Users'))
                    ->getStateUsing(fn ($record) => $record->name )
                    ->description(fn ($record) => $record->email )
                    ->hiddenFrom('md'),
                IconColumn::make('deleted_at')
                    ->label('Estatus')
                    ->boolean()
                    ->state(fn (User $record): bool => empty($record->deleted_at))
                    ->alignCenter()
            ])

            ->filters([
                TrashedFilter::make()
            ])
            ->recordActions([
                ActionGroup::make([
                    Action::make('Restablecer Contraseña')
                        ->authorize('update')
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
                    RestoreAction::make(),


                ]),

            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                    ->authorizeIndividualRecords('delete'),
                ]),
            ]);
    }
}
