<?php

namespace Modules\Payroll\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class GenerateMenus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        \Menu::make('admin_sidebar', function ($menu) {
            // Payroll
            $menu->add('<i class="fas fa-money-check-alt c-sidebar-nav-icon"></i> Payroll', [
                'route' => 'backend.payrolls.index',
                'class' => 'c-sidebar-nav-item',
            ])
            ->data([
                'order'         => 96,
                'activematches' => ['admin/payrolls*'],
                'permission'    => ['view_payrolls'],
            ])
            ->link->attr([
                'class' => 'c-sidebar-nav-link',
            ]);

            // Reset Payroll
            $menu->add('<i class="fas fa-balance-scale c-sidebar-nav-icon"></i> Reset Payroll', [
                'route' => 'backend.resetpayrolls.index',
                'class' => 'c-sidebar-nav-item',
            ])
            ->data([
                'order'         => 97,
                'activematches' => ['admin/resetpayrolls*'],
                'permission'    => ['view_resetpayrolls'],
            ])
            ->link->attr([
                'class' => 'c-sidebar-nav-link',
            ]);
        })->sortBy('order');

        \Menu::make('employee_sidebar', function ($menu) {
            // Payroll
            $menu->add('<i class="fas fa-money-check-alt c-sidebar-nav-icon"></i> Payroll', [
                'route' => 'employee.payrolls.index',
                'class' => 'c-sidebar-nav-item',
            ])
            ->data([
                'order'         => 96,
                'activematches' => ['employee/payrolls*'],
                'permission'    => ['view_payrolls'],
            ])
            ->link->attr([
                'class' => 'c-sidebar-nav-link',
            ]);
        })->sortBy('order');

        return $next($request);
    }
}