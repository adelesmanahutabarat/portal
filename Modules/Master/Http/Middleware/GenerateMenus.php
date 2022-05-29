<?php

namespace Modules\Master\Http\Middleware;

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

            // Access Control Dropdown
            $accessControl = $menu->add('<i class="c-sidebar-nav-icon far fa-file-alt"></i> Master <span class="menu-arrow">', [
                'class' => 'c-sidebar-nav-dropdown',
            ])
            ->data([
                'order'         => 90,
                'activematches' => [
                    'admin/employee*',
                    'admin/bank*',
                    'admin/bank_account*',
                    'admin/branch*',
                    'admin/employee_status*',
                ],
                'permission'    => ['view_employees', 'view_banks', 'view_bank_accounts', 'view_branch', 'view_employee_status'],
            ]);
            $accessControl->link->attr([
                'class' => 'c-sidebar-nav-dropdown-toggle',
                'href'  => '#',
            ]);

            // Submenu: Employee
            $accessControl->add('<i class="c-sidebar-nav-icon fas fa-address-book"></i> Karyawan', [
                'route' => 'backend.employees.index',
                'class' => 'nav-item',
            ])
            ->data([
                'order'         => 105,
                'activematches' => 'admin/employees*',
                'permission'    => ['view_employees'],
            ])
            ->link->attr([
                'class' => 'c-sidebar-nav-link',
            ]);

            // Submenu: Bank
            $accessControl->add('<i class="c-sidebar-nav-icon fas fa-landmark"></i> Bank', [
                'route' => 'backend.banks.index',
                'class' => 'nav-item',
            ])
            ->data([
                'order'         => 106,
                'activematches' => 'admin/banks*',
                'permission'    => ['view_banks'],
            ])
            ->link->attr([
                'class' => 'c-sidebar-nav-link',
            ]);

            // Submenu: Bank Account
            $accessControl->add('<i class="c-sidebar-nav-icon far fa-address-card"></i>Bank Account', [
                'route' => 'backend.bankaccounts.index',
                'class' => 'nav-item',
            ])
            ->data([
                'order'         => 106,
                'activematches' => 'admin/bankaccounts*',
                'permission'    => ['view_bankaccounts'],
            ])
            ->link->attr([
                'class' => 'c-sidebar-nav-link',
            ]);

            // Submenu: Branch
            $accessControl->add('<i class="c-sidebar-nav-icon fas fa-project-diagram"></i>Cabang', [
                'route' => 'backend.branches.index',
                'class' => 'nav-item',
            ])
            ->data([
                'order'         => 106,
                'activematches' => 'admin/branches*',
                'permission'    => ['view_branches'],
            ])
            ->link->attr([
                'class' => 'c-sidebar-nav-link',
            ]);

            // Submenu: Employee Status
            $accessControl->add('<i class="c-sidebar-nav-icon fas fa-marker"></i> Employee Status', [
                'route' => 'backend.employeestatus.index',
                'class' => 'nav-item',
            ])
            ->data([
                'order'         => 106,
                'activematches' => 'admin/employeestatus*',
                'permission'    => ['view_employeestatus'],
            ])
            ->link->attr([
                'class' => 'c-sidebar-nav-link',
            ]);

        })->sortBy('order');

        return $next($request);
    }
}