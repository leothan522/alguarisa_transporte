<?php

namespace App\Http\Responses;
use Filament\Auth\Http\Responses\Contracts\LogoutResponse as Response;

class LogoutResponse implements Response
{

    public function toResponse($request)
    {
        return redirect()->route('home');
    }
}
