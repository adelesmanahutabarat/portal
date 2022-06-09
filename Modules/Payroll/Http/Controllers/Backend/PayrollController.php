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
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        ini_set('max_execution_time', 0);

        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Upload';

        $pathname = $request->file('report_file')->getPathName();
        $filename = $request->file('report_file')->getClientOriginalName();

        $reportFileDate = substr($filename,16,4)."-".substr($filename,14,2)."-01";

        $data['date_period'] = $reportFileDate; 
        $data['total'] = 0;
        $data['created_by'] = auth()->user()->id;
        $data['modified_by'] = auth()->user()->email;

        $report = DB::table('payrolls')->where('date_period', $reportFileDate)->get() ?? 0;

        if(validate_date($reportFileDate)==false){
            Flash::warning("<i class='fas fa-check'></i> Report Date Tidak Sesuai, Check Format tanggal di file. Contoh Nama File (Report_Salary_082022.csv)")->important();
            return redirect()->back()->send();
        }

        if(count($report) > 0){
            Flash::warning("<i class='fas fa-check'></i> Laporan Sudah Pernah Ada, untuk bulan ".$reportFileDate)->important();
            return redirect()->back()->send();
        }

        try{
			DB::beginTransaction();

            $Payroll = Payroll::create($data);
            $insert_id = $Payroll->id;
            
            $csv = Reader::createFromPath($pathname,'r');
            $csv->setDelimiter(",");
            $csv->getRecords();
            $records = $csv->getRecords();
            
            $report =collect();
            $i=0;
            foreach ($records as $offset => $row) {
                if($i>0){
                    $data=[
                        'date_period'=>$reportFileDate,
                        'nik'=>$row[0],
                        'amount'=>$row[2],
                    ];
                    $report->push($data);
                }
                $i++;
            }

            $time_start = microtime(true); 
            $chunks = $report->chunk(350);
            foreach ($chunks as $chunk)
            {
                PayrollDetail::insert($chunk->toArray());                
            }              

            $payrolldetail = PayrollDetail::selectRaw('SUM(amount) as amount')
            ->where('date_period','=',$reportFileDate)
            ->first();
            
            $updateQuery="update payrolls set total = {$payrolldetail->amount} where date_period='{$reportFileDate}';";
            DB::statement($updateQuery);
            
            $time_end = microtime(true);
            $execution_time = ($time_end - $time_start);
            DB::commit();
            // echo '<b>Total Execution Time:</b> '.($execution_time).' seconds';

            return redirect("admin/$module_name");
        } catch(\Exception $e){
			DB::rollBack();
			return $e->getMessage();
		}
    }

    public function storeloadinfile(Request $request)
    {
        dd($request);
        // Format Filename = Report_Salary_082022.csv
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Upload';

        $pathname = $request->file('report_file')->getPathName();
        $filename = $request->file('report_file')->getClientOriginalName();

        $reportFileDate = substr($filename,16,4)."-".substr($filename,14,2)."-01";

        dd($reportFileDate);

        $data['date_period'] = '1990-01-01'; 
        $data['total'] = 0;
        $data['created_by'] = auth()->user()->id;
        $data['modified_by'] = auth()->user()->email;

        $report = DB::table('transactions')->where('date', $reportFileDate)->get() ?? 0;

        if(validate_date($reportFileDate)==false){
            Flash::warning("<i class='fas fa-check'></i> Report Date Tidak Sesuai, Check Format tanggal di file. Contoh Nama File (believe 2021-12-01)")->important();
            return redirect()->back()->send();
        }

        if(count($report) > 0){
            Flash::warning("<i class='fas fa-check'></i> Laporan Sudah Pernah Ada, untuk bulan ".$reportFileDate)->important();
            return redirect()->back()->send();
        }
            
        try{
        DB::beginTransaction();
        
        $transaction = Transaction::create($data);
        $insert_id = $transaction->id;

        $loadQuery = '
        LOAD DATA LOCAL INFILE "'.addslashes($pathname).'"
        INTO TABLE reports
        CHARACTER SET latin1
        FIELDS TERMINATED by \',\'
        OPTIONALLY ENCLOSED BY \'"\'
        LINES TERMINATED BY \'\n\'
        IGNORE 1 LINES
        (@col1,@col2,@col3,@col4,@col5,@col6,@col7,@col8,@col9,@col10,@col11,@col12,@col13,@col14,@col15,@col16,@col17,@col18,@col19) 
        set 
        month=@col1,
        sales_month=@col2,
        platform=@col3,
        label_name=@col4,
        artist_name=@col5,
        release_title=@col6,
        title=@col7,
        upc=@col8,
        isrc=@col9,
        release_catalog_nb=@col10,
        release_type=@col11,
        sales_type=@col12,
        quantity=@col13,
        client_payment_currency=@col14,
        unit_price= @col15,
        mechanical_fee= @col16,
        gross_revenue= @col17,
        client_share_rate= @col18,
        net_revenue= @col19,
        modified_by="'.auth()->user()->email.'",
        trx_id='.$insert_id.';';
        

        $reports  = DB::statement($loadQuery);

        $time_start = microtime(true); 

        $transaction = Report::selectRaw('MAX(month) as date,SUM(gross_revenue) as gross_revenue,SUM(net_revenue) as net_revenue')
        ->where('trx_id','=',$insert_id)
        ->groupBy('trx_id')
        ->first();

        $updateQuery="update transactions set status = 0, gross_revenue = {$transaction->gross_revenue}, net_revenue = {$transaction->net_revenue}, date='{$transaction->date}' where id={$insert_id};";
        DB::statement($updateQuery);
        
        $time_end = microtime(true);
        $execution_time = ($time_end - $time_start);

        // echo '<b>Total Execution Time:</b> '.($execution_time).' seconds';
        DB::commit();

        return redirect("admin/$module_name");
        } catch(\Exception $e){
			DB::rollBack();
			return $e->getMessage();
		}   
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

        $payroll = $module_model::where([['id', '=', $id]])->firstOrFail();

        $module_action = 'Show';

        // $payroll = $module_model::join('branches as bc', 'payrolls.branch_id', 'bc.id')
        //         ->join('users as u', 'payrolls.created_by', 'u.id')
        //         ->selectRaw('payrolls.*, u.name, bc.name as cabang')
        //         ->where([['payrolls.id', '=', $id]])
        //         ->first();

        // $payroll_details = PayrollDetail::where('date_period', $payroll->date_period)->get();

        // dd($payroll_details);

        return view(
            "payroll::backend.$module_name.show",
            compact('module_title', 'module_name', 'module_icon', 'module_name_singular', 'module_action','payroll')
        );
    }

    public function detail_list(Request $request)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'List';

        $payroll = $module_model::where([['id', '=', $request->id]])->firstOrFail();

        $payroll_details = DB::table('payroll_details as prd')
        ->join('users as u', 'prd.nik', 'u.nik')
        ->join('branches as bc', 'u.placement_id', 'bc.id')
        ->selectRaw('prd.*, u.name, bc.name as cabang')
        ->where([['prd.date_period', '=', $payroll->date_period]])
        ->get();
                
        return Datatables::of($payroll_details)
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

	public function getdownloadexample()
	{
		return response()->download(public_path('file/example.csv'));
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
