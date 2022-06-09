<?php

namespace Modules\Payroll\Http\Controllers\Employee;

use App\Authorizable;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Log;
use Modules\Payroll\Entities\Payroll;
use Modules\Payroll\Entities\PayrollDetail;
use Modules\Master\Entities\Branch;
use Modules\Master\Entities\BankAccount;
use Modules\Master\Entities\Bank;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use League\Csv\Reader;
use Auth;
use Flash;

class UserPayrollController extends Controller
{
    use Authorizable;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'Payroll';

        // module name
        $this->module_name = 'payrolls';

        // directory path of the module
        $this->module_path = 'payrolls';

        // module icon
        $this->module_icon = 'c-icon far fa-file-alt';

        // module model name, path
        $this->module_model = "Modules\Payroll\Entities\PayrollDetail";
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'List';

        $page_heading = ucfirst($module_title);
        $title = $page_heading.' '.ucfirst($module_action);

        $payroll_details = PayrollDetail::where('nik', auth()->user()->nik)->get();
        
        Log::info(label_case($module_title.' '.$module_action).' | User:'.auth()->user()->name.'(ID:'.auth()->user()->id.')');
     
        return view(
            "payroll::employee.$module_name.index",
            compact('module_title', 'module_name', 'module_path', 'module_icon', 'module_action', 'module_name_singular', 'payroll_details')
        );
    }

    public function index_list()
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'List';

        $data = PayrollDetail::where('nik', auth()->user()->nik)->get();

        return Datatables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function ($data) {
            $module_name = $this->module_name;

            return view('payroll::includes.action_column_employee', compact('module_name', 'data'));
        })
        ->addColumn('created_at', function ($data) {
            $created_at = $data->created_at;

            return $created_at;
        })
        ->rawColumns(['action', 'created_at'])
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('payroll::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $data = $module_model::where([['id', '=', $id]])->firstOrFail();
        $rekening = BankAccount::with('bank')->where('user_id',Auth::user()->id)->first();

        $module_action = 'Show';
        return view(
            "payroll::employee.$module_name.invoice",
            compact('module_title', 'module_name', 'module_icon', 'module_name_singular', 'module_action','data','rekening')
        );
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('payroll::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
