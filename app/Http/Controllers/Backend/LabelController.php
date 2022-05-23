<?php

namespace App\Http\Controllers\Backend;
use Modules\Catalog\Entities\Catalog;
use App\Http\Controllers\Controller;
use Auth;
class LabelController extends Controller
{
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $catalog_pending = Catalog::where([['created_by', '=' , Auth::user()->id],['status','=','0']])->count();
        $catalog_diterima = Catalog::where([['created_by', '=' , Auth::user()->id],['status','=','1']])->count();
        return view('label.index',compact('catalog_pending','catalog_diterima'));
    }
}
