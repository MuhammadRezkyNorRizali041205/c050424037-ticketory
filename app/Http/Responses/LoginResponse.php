<?php

namespace App\Http\Responses; // <-- wajib begini, bukan Controllers\Responses

use Filament\Auth\Http\Responses\LoginResponse as BaseLoginResponse;
use Illuminate\Support\Facades\Auth;
use Filament\Pages\Dashboard;
use Illuminate\Http\RedirectResponse;
use Livewire\Features\SupportRedirects\Redirector;

class LoginResponse extends BaseLoginResponse
{
    public function toResponse($request): RedirectResponse|Redirector
    {
        $user = Auth::user();

        if ($user->hasRole('admin')) {
            return redirect()->to(Dashboard::getUrl(panel: 'admin'));
        }

        if ($user->hasRole('technician')) {
            return redirect()->to(Dashboard::getUrl(panel: 'technician'));
        }

        return redirect()->to(Dashboard::getUrl(panel: 'user'));
    }
}
