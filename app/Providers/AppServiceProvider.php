<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Filament\Forms\Components\DateTimePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Support\Facades\FilamentView;
use Filament\View\PanelsRenderHook;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $timezone = request()->cookie('client_timezone', config('app.timezone'));

        DateTimePicker::configureUsing(fn (DateTimePicker $component) => $component->timezone($timezone));
        TextColumn::configureUsing(fn (TextColumn $column) => $column->timezone($timezone));

        // Tambahan script otomatis untuk mendeteksi timezone dan mengirimkannya ke cookie
        FilamentView::registerRenderHook(
            PanelsRenderHook::BODY_START,
            fn (): string => Blade::render('<script>
                const tz = Intl.DateTimeFormat().resolvedOptions().timeZone;
                if (document.cookie.indexOf("client_timezone=" + tz) === -1) {
                    document.cookie = "client_timezone=" + tz + "; path=/";
                    location.reload();
                }
            </script>')
        );
    }
}

// namespace App\Providers;

// use Illuminate\Support\ServiceProvider;
// use Filament\Forms\Components\DateTimePicker;
// use Filament\Tables\Columns\TextColumn;
// use Filament\Support\Facades\FilamentTimezone;

// class AppServiceProvider extends ServiceProvider
// {
//     /**
//      * Register any application services.
//      */
//     public function register(): void
//     {
//         //
//     }

//     /**
//      * Bootstrap any application services.
//      */
//     // public function boot(): void
//     // {
//     //     //
//     // }
// public function boot(): void
// {
//     // Cek apakah user sedang login dan punya setting timezone, atau ambil dari session
//     $userTimezone = auth()->user()?->timezone ?? session('browser_timezone', config('app.timezone'));

//     // Set global timezone untuk form/tabel Filament
//     FilamentTimezone::set($userTimezone);
    
//     // Atau atur langsung pada component behavior jika dinamis:
//     DateTimePicker::configureUsing(fn (DateTimePicker $component) => $component->timezone($userTimezone));
//     TextColumn::configureUsing(fn (TextColumn $column) => $column->timezone($userTimezone));
// }

// }
