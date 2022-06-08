<?php

namespace Modules\Payroll\Http\Controllers\Backend;

use App\Authorizable;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Log;
use Modules\Payroll\Entities\Payroll;
use Modules\Payroll\Entities\PayrollDetail;
use Modules\Master\Entities\Branch;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use League\Csv\Reader;
use Auth;
use Flash;

class ResetPayrollController extends Controller
{
    use Authorizable;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'Reset Payroll';

        // module name
        $this->module_name = 'resetpayrolls';

        // directory path of the module
        $this->module_path = 'resetpayrolls';

        // module icon
        $this->module_icon = 'c-icon far fa-file-alt';

        // module model name, path
        $this->module_model = "Modules\Payroll\Entities\Payroll";
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

        $branches = Branch::all();
        $payrolls = Payroll::all();
        
        Log::info(label_case($module_title.' '.$module_action).' | User:'.auth()->user()->name.'(ID:'.auth()->user()->id.')');
     
        return view(
            "payroll::backend.$module_name.index",
            compact('module_title', 'module_name', 'module_path', 'module_icon', 'module_action', 'module_name_singular', 'branches', 'payrolls')
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

        $data = Payroll::join('users as u', 'payrolls.created_by', 'u.id')->selectRaw('payrolls.*, u.name');
        
                
        return Datatables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function ($data) {
            $module_name = $this->module_name;

            return view('payroll::includes.action_column', compact('module_name', 'data'));
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
        return view('payroll::show');
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
        dd("testing");
    }

        /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function reset($id)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        // dd("lock");
        $module_action = 'Reset';
        try{
            DB::beginTransaction();
            
            $date = Payroll::find($id)->date_period;
            $payrolldetail = DB::table('payroll_details')->where('date_period', $date)->delete();
            $payroll = DB::table('payrolls')->where('date_period', $date)->delete();

            DB::commit();
            Flash::success("<i class='fas fa-check'></i> Payroll Berhasil di reset untuk bulan {$date}")->important();
        } catch(\Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }

        return redirect("admin/$module_name");
    }
}
