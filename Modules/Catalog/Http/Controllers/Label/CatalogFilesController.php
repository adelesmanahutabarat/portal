<?php

namespace Modules\Catalog\Http\Controllers\Label;
use App\Authorizable;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Storage;
use Illuminate\Support\Facades\Response as Download;
class CatalogFilesController extends Controller
{
    public function __construct()
    {
        // Page Title
        $this->module_title = 'Catalog Files';

        // module name
        $this->module_name = 'catalogfiles';

        // directory path of the module
        $this->module_path = 'catalogfiles';

        // module icon
        $this->module_icon = 'fas fa-music';

        // module model name, path
        $this->module_model = "Modules\Catalog\Entities\CatalogFiles";
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        // return view('catalog::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        // return view('catalog::create');
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
        $data = $this->module_model::findOrFail($id);
        $download_url = Storage::disk('s3')->temporaryUrl(
            $data->file_url,
            now()->addHour(),
            ['ResponseContentDisposition' => 'attachment;filename="'.$data->file_name.'"']
        );
        return redirect($download_url);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        // return view('catalog::edit');
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
        $module_model = $this->module_model;
        $module_title = $this->module_title;
        $module_name_singular = Str::singular($this->module_name);
        $$module_name_singular = $module_model::findOrFail($id);
        $$module_name_singular->delete();
        Storage::disk('s3')->delete('images',$$module_name_singular->file_url);
        flash(icon()." ".Str::singular($module_title)."' Delete Successfully")->success()->important();
        logUserAccess($module_title." Delete | Id: ". $$module_name_singular->id);
        return redirect()->back();
    }
}
