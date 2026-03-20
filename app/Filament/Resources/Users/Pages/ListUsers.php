<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions;
use Filament\Support\Enums\Width;


class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Crear Usuario')
                ->modalHeading('Crear Usuario')
                ->modalWidth(Width::ThreeExtraLarge)
                ->createAnother(false)
        ];
    }
}
