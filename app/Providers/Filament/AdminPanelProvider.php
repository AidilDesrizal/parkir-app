<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\View\PanelsRenderHook;

use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')

            ->login()
            ->registration()

            // LOGIN EXTRA UI
            ->renderHook(
                PanelsRenderHook::AUTH_LOGIN_FORM_BEFORE,
                fn () => view('filament.login_extra')
            )
            ->renderHook(
                PanelsRenderHook::AUTH_REGISTER_FORM_BEFORE,
                fn () => view('filament.login_extra')
            )

            // BRAND
            ->brandName('SimPark')
            ->brandLogo(view('filament.brand'))

            // PREMIUM COLOR
            ->colors([
                'primary' => Color::Amber,
            ])

            // RESOURCES & PAGES
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')

            // ❌ MATIKAN AUTO WIDGET
            // ->discoverWidgets(...)

            // ✅ DASHBOARD PAGE
            ->pages([
                Dashboard::class,
            ])

            // ✅ PREMIUM WIDGET SET
           ->widgets([

            \App\Filament\Widgets\ParkirStats::class,
            \App\Filament\Widgets\PemasukanChart::class,
            \App\Filament\Widgets\TotalPemasukan::class,
            \App\Filament\Widgets\TransaksiChart::class,
            \App\Filament\Widgets\PemasukanChart::class,
            \App\Filament\Widgets\InfoAplikasi::class,
])

            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])

            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
