<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Auth\Login;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Assets\Css;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
//use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
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
            ->login(Login::class)

            /*
            |--------------------------------------------------------------------------
            | BRANDING
            |--------------------------------------------------------------------------
            */
            ->brandName('')
->brandLogo(fn () => request()->routeIs('filament.admin.auth.login')
    ? view('filament.admin.login-brand')
    : view('filament.admin.brand')
)
            ->brandLogoHeight('3rem')
            ->favicon(asset('images/Logo Baru Sipandai.png'))

            /*
            |--------------------------------------------------------------------------
            | CUSTOM CSS
            |--------------------------------------------------------------------------
            */
            ->assets([
                Css::make(
                    'sipandai-login',
                    asset('css/sipandai-login.css')
                ),
            ])

            /*
            |--------------------------------------------------------------------------
            | WARNA UTAMA
            |--------------------------------------------------------------------------
            */
            ->colors([
                'primary' => Color::Amber,
            ])

            /*
            |--------------------------------------------------------------------------
            | AUTO DISCOVERY
            |--------------------------------------------------------------------------
            */
            ->discoverResources(
                in: app_path('Filament/Resources'),
                for: 'App\\Filament\\Resources'
            )
            ->discoverPages(
                in: app_path('Filament/Pages'),
                for: 'App\\Filament\\Pages'
            )
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(
                in: app_path('Filament/Widgets'),
                for: 'App\\Filament\\Widgets'
            )

            /*
            |--------------------------------------------------------------------------
            | WIDGETS
            |--------------------------------------------------------------------------
            */
            ->widgets([
                AccountWidget::class,
                //FilamentInfoWidget::class,
            ])

            /*
            |--------------------------------------------------------------------------
            | MIDDLEWARE
            |--------------------------------------------------------------------------
            */
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                PreventRequestForgery::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])

            /*
            |--------------------------------------------------------------------------
            | ROLE & PERMISSION
            |--------------------------------------------------------------------------
            */
            ->plugins([
                FilamentShieldPlugin::make(),
            ])

            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}




// namespace App\Providers\Filament;

// use Filament\Http\Middleware\Authenticate;
// use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
// use Filament\Http\Middleware\AuthenticateSession;
// use Filament\Http\Middleware\DisableBladeIconComponents;
// use Filament\Http\Middleware\DispatchServingFilamentEvent;
// use Filament\Pages\Dashboard;
// use Filament\Panel;
// use Filament\PanelProvider;
// use Filament\Support\Colors\Color;
// use Filament\Widgets\AccountWidget;
// use Filament\Widgets\FilamentInfoWidget;
// use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
// use Illuminate\Cookie\Middleware\EncryptCookies;
// use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
// use Illuminate\Routing\Middleware\SubstituteBindings;
// use Illuminate\Session\Middleware\StartSession;
// use Illuminate\View\Middleware\ShareErrorsFromSession;
// use App\Filament\Pages\Auth\Login;
// //use Filament\View\PanelsRenderHook;

// class AdminPanelProvider extends PanelProvider
// {
//     public function panel(Panel $panel): Panel
//     {
//         return $panel
//             ->default()
//             ->id('admin')
//             ->path('admin')
//             ->login(Login::class)
//             ->brandName('SIPANDAI BIDKUM')
//             // ->brandLogo(asset('images/HUKUM_POLRI.png'))
//             // ->brandLogoHeight('3rem')
//             ->favicon(asset('images/HUKUM_POLRI.png'))
//                 ->assets([
//         \Filament\Support\Assets\Css::make(
//             'sipandai-login',
//             asset('css/sipandai-login.css')
//         ),
//     ])

// // ->renderHook(
// //     \Filament\View\PanelsRenderHook::TOPBAR_START,
// //     fn (): string => '
// //         <div class="flex items-center gap-3 mr-4">
// //             <img
// //                 src="' . asset('images/HUKUM_POLRI.png') . '"
// //                 alt="Logo SIPANDAI"
// //                 class="h-10 w-10 object-contain"
// //             >

// //             <div class="hidden sm:block leading-tight">
// //                 <div class="font-bold text-base text-gray-900 dark:text-white">
// //                     SIPANDAI BIDKUM
// //                 </div>

// //                 <div class="text-xs text-gray-500 dark:text-gray-400">
// //                     Sistem Informasi Pengawasan dan Administrasi
// //                 </div>
// //             </div>
// //         </div>
// //     '
// // )

//             ->colors([
//                 'primary' => Color::Amber,
//             ])
//             ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
//             ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
//             ->pages([
//                 Dashboard::class,
//             ])
//             ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
//             ->widgets([
//                 AccountWidget::class,
//                 FilamentInfoWidget::class,
//             ])
//             ->middleware([
//                 EncryptCookies::class,
//                 AddQueuedCookiesToResponse::class,
//                 StartSession::class,
//                 AuthenticateSession::class,
//                 ShareErrorsFromSession::class,
//                 PreventRequestForgery::class,
//                 SubstituteBindings::class,
//                 DisableBladeIconComponents::class,
//                 DispatchServingFilamentEvent::class,
//             ])
//             ->plugins([
//                 FilamentShieldPlugin::make(),
//             ])
//             ->authMiddleware([
//                 Authenticate::class,
//             ]);
//     }
// }
