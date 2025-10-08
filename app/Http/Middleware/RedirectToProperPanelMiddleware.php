<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Filament\Facades\Filament;
use Filament\Pages\Dashboard;
use Symfony\Component\HttpFoundation\Response;

class RedirectToProperPanelMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            $user = auth()->user();
            $currentPanel = Filament::getCurrentPanel()?->getId();

            // Fungsi helper untuk memastikan panel tersedia
            $safeRedirect = function (string $panel): ?Response {
                if (Filament::getPanel($panel)) {
                    return redirect()->to(Dashboard::getUrl(panel: $panel));
                }

                // Kalau panel belum terdaftar, arahkan ke root atau dashboard default
                return redirect('/');
            };

            // Admin role redirection
            if ($user->hasRole('admin') && $currentPanel !== 'admin') {
                return $safeRedirect('admin');
            }

            // Technician role redirection
            if ($user->hasRole('technician') && $currentPanel !== 'technician') {
                return $safeRedirect('technician');
            }

            // User role redirection
            if ($user->hasRole('user') && $currentPanel !== 'user') {
                return $safeRedirect('user');
            }
        }

        return $next($request);
    }
}
