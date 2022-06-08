<?php

namespace App\Http\Controllers\Backend;

use App\Authorizable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Flash;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Log;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
        // use Authorizable;

        public function __construct()
        {
            // Page Title
            $this->module_title = 'Dashboard';
    
            // module name
            $this->module_name = 'dashboards';
    
            // directory path of the module
            $this->module_path = 'dashboard';
    
            // module icon
            $this->module_icon = 'c-icon fas fa-music';
    
            // module model name, path
            $this->module_model = "App\Models\User";   
        }

        public function index(){
            $module_title = $this->module_title;
            $module_name = $this->module_name;
            $module_path = $this->module_path;
            $module_icon = $this->module_icon;
            $module_model = $this->module_model;
            $module_name_singular = Str::singular($module_name);
    
            $module_action = 'Dashboard';
    
            $users = DB::table('users')->where('nik', null)->get();
            $branches = DB::table('branches')->get();
    
            $user = count($users);
            $branch = count($users);
    
            return view('backend.dashboard.employee', compact('user', 'branch'));
        }
}
