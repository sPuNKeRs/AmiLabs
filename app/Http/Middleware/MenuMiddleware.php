<?php

namespace App\Http\Middleware;

use Closure;

use Menu;
use Caffeinated\Menus\Builder;
use Illuminate\Support\Facades\Auth;

class MenuMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Главное меню
        Menu::make('main', function(Builder $menu) {
            // Страница регистратуры
            $menu->add('registry', 'registry')->data([
                'icon' => 'perm_identity',
                'titles' => 'Регистратура',
                'route' => 'registry'
            ]);
            // Страница отчетов
            $menu->add('reports', 'reports')->data([
                'icon' => 'donut_small',
                'titles' => 'Отчеты',
                'route' => 'reports'
            ]);
        });

        // Меню администратора
        Menu::make('admin', function(Builder $menu) {
            // Общие настройки
            $menu->add('settings', 'settings')->data([
                'icon' => 'build',
                'titles' => 'Общие настройки',
                'route' => 'settings'
            ]);

             //  Профиль
            $menu->add('profile', 'profile/'.Auth::user()->id)->data([
                'icon' => 'assignment_ind',
                'titles' => 'Профиль',
                'route' => 'profile/'
            ]);
            
            // Пользователи
            $menu->add('users', 'users')->data([
                'icon' => 'supervisor_account',
                'titles' => 'Пользователи',
                'route' => 'users'
            ])->active('users/*');;

            // Справочники
            $menu->add('reference', 'reference')->data([
                'icon' => 'reorder',
                'titles' => 'Справочники',
                'route' => 'reference'
            ]);
        });

        return $next($request);
    }
}
