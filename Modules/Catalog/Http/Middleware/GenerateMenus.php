<?php

namespace Modules\Catalog\Http\Middleware;

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
            $menu->add('<i class="fas fa-music c-sidebar-nav-icon"></i> Catalogs', [
                'route' => 'label.catalogs.index',
                'class' => "c-sidebar-nav-item",
            ])
            ->data([
                'order' => 85,
                'activematches' => ['label/catalogs*'],
                'permission' => ['view_catalogs'],
            ])
            ->link->attr([
                'class' => 'c-sidebar-nav-link',
            ]);
        })->sortBy('order');
        return $next($request);
    }
}
