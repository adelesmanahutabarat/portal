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
use Auth;
use Flash;

class PayrollController extends Controller
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
        
        Log::info(label_case($module_title.' '.$module_action).' | User:'.auth()->user()->name.'(ID:'.auth()->user()->id.')');
     
        return view(
            "payroll::backend.$module_name.index",
            compact('module_title', 'module_name', 'module_path', 'module_icon', 'module_action', 'module_name_singular', 'branches')
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
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Create';

        $users = DB::table('users')->orderBy('name', 'ASC')->get();
        $branches = DB::table('branches')->orderBy('name', 'ASC')->get();

        Log::info(label_case($module_title.' '.$module_action).' | User:'.auth()->user()->name.'(ID:'.auth()->user()->id.')');

        return view(
            "payroll::backend.$module_name.create",
            compact('module_title', 'module_name', 'module_path', 'module_icon', 'module_action', 'module_name_singular', 'users', 'branches')
        );
    }

        /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function add($id)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Create';

        $users = DB::table('users')->orderBy('name', 'ASC')->where('id_card_number', '<>', null)->get();
        $branches = DB::table('branches')->orderBy('name', 'ASC')->get();
        $branch = DB::table('branches')->where('id', $id)->first();

        Log::info(label_case($module_title.' '.$module_action).' | User:'.auth()->user()->name.'(ID:'.auth()->user()->id.')');

        return view(
            "payroll::backend.$module_name.create",
            compact('module_title', 'module_name', 'module_path', 'module_icon', 'module_action', 'module_name_singular', 'users', 'branches', 'branch')
        );
    }

    public function money($nominal){
        $money = preg_replace( '/[^0-9]/', '', $nominal);

        return $money;
    }
    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Store';

        $data = ['branch_id' => $request->branch_id, 'date_period' => $request->date_period, 'total' => $this->money($request->total)];
        $data += ['created_by' => Auth::user()->id];

        $$module_name_singular = $module_model::create($data);

        $user_id = $request->input('user_id', []);
		$nominal = $request->input('nominal', []);

        for ($i=0; $i < count($nominal); $i++) {
			if ($nominal[$i] != '') {
				PayrollDetail::create([
					'date_period' =>  $request->date_period,
					'branch_id' => $request->branch_id,
					'user_id' => $user_id[$i],
					'amount' => $this->money($nominal[$i]),
				]);
			}
		}

        Flash::success("<i class='fas fa-check'></i> New '".Str::singular($module_title)."' Added")->important();

        return redirect("admin/$module_name");
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
        $payroll = $module_model::join('branches as bc', 'payrolls.branch_id', 'bc.id')
                ->join('users as u', 'payrolls.created_by', 'u.id')
                ->selectRaw('payrolls.*, u.name, bc.name as cabang')
                ->where([['payrolls.id', '=', $id]])
                ->first();

        $payroll_details = PayrollDetail::where('date_period', $payroll->date_period)->get();

        $module_action = 'Show';
        return view(
            "payroll::backend.$module_name.show",
            compact('module_title', 'module_name', 'module_icon', 'module_name_singular', 'module_action','payroll', 'payroll_details')
        );
    }

    public function detail_list()
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'List';

        $data = PayrollDetail::join('users as u', 'payroll_details.user_id', 'u.id')->selectRaw('amount, name');
                
        return Datatables::of($data)
        ->addIndexColumn()
        ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $data = $module_model::where([['id', '=', $id]])->firstOrFail();
        $payroll = $module_model::join('branches as bc', 'payrolls.branch_id', 'bc.id')
                ->join('users as u', 'payrolls.created_by', 'u.id')
                ->selectRaw('payrolls.*, u.name, bc.name as cabang')
                ->where([['payrolls.id', '=', $id]])
                ->first();

        $payroll_details = PayrollDetail::where('date_period', $payroll->date_period)->get();

        $module_action = 'Show';
        return view(
            "payroll::backend.$module_name.edit",
            compact('module_title', 'module_name', 'module_icon', 'module_name_singular', 'module_action','payroll', 'payroll_details')
        );
    }

    public function edit_list()
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'List';

        $data = PayrollDetail::join('users as u', 'payroll_details.user_id', 'u.id')->selectRaw('amount, name');
                
        return Datatables::of($data)
        ->addColumn('action', function ($data) {
            $module_name = $this->module_name;

            return view('master::includes.action_column', compact('module_name', 'data'));
        })
        ->rawColumns(['action'])
        ->addIndexColumn()
        ->make(true);
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
