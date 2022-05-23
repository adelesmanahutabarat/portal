<?php

namespace Modules\Withdraw\Http\Middleware;

use Closure;

class GenerateMenus
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
       
        \Menu::make('label_sidebar', function ($menu) {

            // Tags
            $menu->add('<i class="fas fa-money-check c-sidebar-nav-icon"></i> Withdraws', [
                'route' => 'label.withdraws.index',
                'class' => "c-sidebar-nav-item",
            ])
            ->data([
                'order' => 85,
                'activematches' => ['label/withdraws*'],
                'permission' => ['view_withdraws'],
            ])
            ->link->attr([
                'class' => 'c-sidebar-nav-link',
            ]);
        })->sortBy('order');
        return $next($request);
    }
}
