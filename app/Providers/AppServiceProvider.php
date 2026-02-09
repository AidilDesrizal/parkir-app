<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Filament\Support\Facades\FilamentView;
use Illuminate\View\View;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // ✅ Hook tambahan tampilan login Filament
        FilamentView::registerRenderHook(
            'panels::auth.login.form.after',
            fn (): View => view('filament.login_extra')
        );
    }
}
