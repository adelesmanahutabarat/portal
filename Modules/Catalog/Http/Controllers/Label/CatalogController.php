<?php

namespace Modules\Catalog\Http\Controllers\Label;
use App\Authorizable;
use App\Http\Controllers\Controller;
use Log;
use Image;
use Storage;
use Flash;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Spatie\Activitylog\Models\Activity;
use App\Gallery;
use Modules\Catalog\Http\Requests\Label\CatalogsRequest;
use Auth;
class CatalogController extends Controller
{
    use Authorizable;
    public function __construct()
    {
        // Page Title
        $this->module_title = 'Catalogs';

        // module name
        $this->module_name = 'catalogs';

        // directory path of the module
        $this->module_path = 'catalogs';

        // module icon
        $this->module_icon = 'fas fa-music';

        // module model name, path
        $this->module_model = "Modules\Catalog\Entities\Catalog";
        $this->module_file_model = "Modules\Catalog\Entities\CatalogFiles";
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

        $$module_name = $module_model::paginate();

        return view(
            "catalog::label.index",
            compact('module_title', 'module_name', "$module_name", 'module_icon', 'module_name_singular', 'module_action')
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

        $$module_name = $module_model::select('id','cid', 'title','status', 'updated_at')
                            ->where('created_by', '=' , Auth::user()->id);

        $data = $$module_name;

        return Datatables::of($$module_name)
                ->addColumn('action', function ($data) {
                    $module_name = $this->module_name;

                    return view('catalog::includes.action_column', compact('module_name', 'data'));
                })
                ->editColumn('status', function ($data) {
                    return $data->status_formatted;
                })
                ->editColumn('updated_at', function ($data) {
                    $module_name = $this->module_name;

                    $diff = Carbon::now()->diffInHours($data->updated_at);

                    if ($diff < 25) {
                        return $data->updated_at->diffForHumans();
                    } else {
                        return $data->updated_at->isoFormat('LLLL');
                    }
                })
                ->rawColumns(['name','status', 'action'])
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

        Log::info(label_case($module_title.' '.$module_action).' | User:'.auth()->user()->name.'(ID:'.auth()->user()->id.')');

        return view(
            "catalog::label.create",
            compact('module_title', 'module_name', 'module_icon', 'module_name_singular', 'module_action')
        );
    }
    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(CatalogsRequest $request)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Store';
        $data = $request->except('status');
        $data['created_by_name'] = auth()->user()->name;
        $$module_name_singular = $module_model::create($data);
        Flash::success("<i class='fas fa-check'></i> New '".Str::singular($module_title)."' Added")->important();

        Log::info(label_case($module_title.' '.$module_action)." | '".$$module_name_singular->name.'(ID:'.$$module_name_singular->id.") ' by User:".auth()->user()->name.'(ID:'.auth()->user()->id.')');

        return redirect("label/$module_name/{$$module_name_singular->id}/edit/");
    }
    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store_temp(Request $request)
    {
        $module_file_model = $this->module_file_model;
        $count = $module_file_model::all()->count();
        if($count>10){
            $res = [            
                'status'=>'error',
                'message' => 'Max dalam satu catalog hanya 10 file'
            ];
        }else{
            foreach($request->file('file_url') as $image)
            {
                $original_name = $image->getClientOriginalName();
                $path = Storage::disk('s3')->put('images', $image);
                //  $image->store('images','s3');
                $module_file_model::insert([
                    'catalog_id'=>1,
                    'file_name'=>$original_name,
                    'file_url'=>$path
                ]);
            }

            $res = array(
            'status'=>'success',
            'message'  => 'Multiple Image File Has Been uploaded Successfully'
            );
        }
        
 
        return response()->json($res);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id=0)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Show';
        

        $$module_name_singular = $module_model::findOrFail($id);
        $files=$$module_name_singular->files;
        $$module_name_singular->download_url = $$module_name_singular->lyric_url ?Storage::disk('s3')->temporaryUrl(
            $$module_name_singular->lyric_url,
            now()->addHour(),
            ['ResponseContentDisposition' => 'attachment']
        ):"#";
        return view(
            "catalog::label.show",
            compact('module_title', 'module_name', 'module_icon', 'module_name_singular', 'module_action', "$module_name_singular",'files')
        );
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

        $module_action = 'Edit';
        

        $$module_name_singular = $module_model::findOrFail($id);
        $files=$$module_name_singular->files;
        $$module_name_singular->download_url = $$module_name_singular->lyric_url ?Storage::disk('s3')->temporaryUrl(
            $$module_name_singular->lyric_url,
            now()->addHour(),
            ['ResponseContentDisposition' => 'attachment']
        ):"#";

        

        return view(
            "catalog::label.edit",
            compact('module_title', 'module_name', 'module_icon', 'module_name_singular', 'module_action', "$module_name_singular",'files')
        );
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_file_model = $this->module_file_model;
        $module_name_singular = Str::singular($module_name);


        $validatedData = $request->validate([
            'title' => 'required|max:191:'.$module_model.',title,'.$id,
            'artis_name' => 'nullable|max:191:'.$module_model.',artis_name,'.$id,
        ]);
        
        $$module_name_singular = $module_model::findOrFail($id);
        $module_action = 'Update';
        
        $$module_name_singular->update($request->except('lyric_url','artwork_url','file_url','status'));
        // Artwork URL
        if ($request->hasFile('artwork_url')) {

            $path = Storage::disk('s3')->put('images', $request->file('artwork_url'),'public');
            Storage::disk('s3')->delete('images',$$module_name_singular->artwork_url);
            $$module_name_singular->artwork_url = $path;
            $$module_name_singular->save();
        }
        if($request->file('file_url')){
            foreach($request->file('file_url') as $track)
            {
                $original_name = $track->getClientOriginalName();
                $path = Storage::disk('s3')->put('track', $track);
                $module_file_model::insert([
                    'catalog_id'=>$id,
                    'file_name'=>$original_name,
                    'file_url'=>$path
                ]);
            }
        }
        // Lyric URL
        if ($request->hasFile('lyric_url')) {
            $path = Storage::disk('s3')->put('lyric', $request->file('lyric_url'));
            Storage::disk('s3')->delete('images',$$module_name_singular->lyric_url);
            $$module_name_singular->lyric_url = $path;
            $$module_name_singular->save();
        }

        flash(icon()." ".Str::singular($module_title)."' Updated Successfully")->success()->important();

        logUserAccess($module_title.' '.$module_action. " | Id: ". $$module_name_singular->id);

        return redirect()->back();
    }
    public function delete_file($id){

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
