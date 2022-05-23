<?php

namespace Modules\Withdraw\Http\Controllers\Label;
use App\Authorizable;
use Log;
use Flash;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Withdraw\Http\Requests\Label\WithdrawRequest;
class WithdrawController extends Controller
{
    use Authorizable;
    public function __construct()
    {
        // Page Title
        $this->module_title = 'Withdraws';

        // module name
        $this->module_name = 'withdraws';

        // directory path of the module
        $this->module_path = 'withdraws';

        // module icon
        $this->module_icon = 'fas fa-money-check';

        // module model name, path
        $this->module_model = "Modules\Withdraw\Entities\Withdraw";
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
        $saldo = 0;
        $$module_name = $module_model::paginate();

        return view(
            "withdraw::label.index",
            compact('module_title', 'module_name', "$module_name", 'module_icon', 'module_name_singular', 'module_action','saldo')
        );
    }
    public function index_data()
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'List';

        $$module_name = $module_model::select('id','amount', 'status','created_at')
                            ->where('created_by', '=' , Auth::user()->id);

        $data = $$module_name;

        return Datatables::of($$module_name)
                ->addColumn('action', function ($data) {
                    $module_name = $this->module_name;

                    return view('withdraw::includes.action_column', compact('module_name', 'data'));
                })
                ->editColumn('status', function ($data) {
                    return $data->status_formatted;
                })
                ->editColumn('created_at', function ($data) {
                    $diff = Carbon::now()->diffInHours($data->created_at);

                    if ($diff < 25) {
                        return $data->created_at->diffForHumans();
                    } else {
                        return $data->created_at->isoFormat('LLLL');
                    }
                })
                ->rawColumns(['status', 'action'])
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
        if(Auth::user()->mobile==null){
            Flash::warning("<i class='fas fa-check'></i> Wajib isi nomor handphone terlebih dahulu,karena konfirmasi akan dikirim melalui nomor handphone")->important();
            return redirect("label/users/profile/".Auth::user()->id."/edit");
        }
        $module_action = 'Create';
        $saldo = 0;

        return view(
            "withdraw::label.create",
            compact('module_title', 'module_name', 'module_icon', 'module_name_singular', 'module_action','saldo')
        );
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(WithdrawRequest $request)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);
        $module_action = 'Store';
        
        $checkExist = $module_model::where([['created_by','=',Auth::user()->id],['status','=',0]])->count();
        if($checkExist>0){
            $pesan = 'Hanya satu withdraw pending diperbolehkan.';
            Flash::warning("<i class='fas fa-check'></i> {$pesan}")->important();
            return redirect("label/$module_name/");
        }
        $data = $request->only('amount','description','created_by_name');
        $data['created_by_name'] = auth()->user()->name;
        $$module_name_singular = $module_model::create($data);


        $pesan = "Berhasil Mengajukan Withdraw";
        Flash::success("<i class='fas fa-check'></i> {$pesan}")->important();
        Log::info(label_case($module_title.' '.$module_action)." | '".$$module_name_singular->name.'(ID:'.$$module_name_singular->id.") ' by User:".auth()->user()->name.'(ID:'.auth()->user()->id.')');
        return redirect("label/$module_name/");
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
        if(Auth::user()->mobile==null){
            Flash::warning("<i class='fas fa-check'></i> Wajib isi nomor handphone terlebih dahulu,karena konfirmasi akan dikirim melalui nomor handphone")->important();
            return redirect("label/users/profile/".Auth::user()->id."/edit");
        }
        $data = $module_model::where([['id', '=', $id],['created_by','=',Auth::user()->id]])->firstOrFail();
        $module_action = 'Show';
        return view(
            "withdraw::label.show",
            compact('module_title', 'module_name', 'module_icon', 'module_name_singular', 'module_action','data')
        );
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        // return view('withdraw::edit');
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
