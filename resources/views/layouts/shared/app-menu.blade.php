<!-- {!! $admin_sidebar->asUl( ['class' => 'metismenu','id'=>'menu-bar'], ['class' => 'nav-second-level'] ) !!} -->

@if(Auth::user()->getRoleNames()[0] == "super admin" || Auth::user()->getRoleNames()[0] == "administrator" || Auth::user()->getRoleNames()[0] == "manager")
{!! $admin_sidebar->asUl( ['class' => 'metismenu','id'=>'menu-bar'], ['class' => 'nav-second-level'] ) !!}
@elseif(Auth::user()->getRoleNames()[0] == "employee")
{!! $employee_sidebar->asUl( ['class' => 'metismenu','id'=>'menu-bar'], ['class' => 'nav-second-level'] ) !!}
@else
{!! $finance_sidebar->asUl( ['class' => 'metismenu','id'=>'menu-bar'], ['class' => 'nav-second-level'] ) !!}
@endif