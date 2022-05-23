<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Modules\Catalog\Entities\Catalog;
class BackendController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $catalog_pending = Catalog::where([['status','=','0']])->count();
        $catalog_diterima = Catalog::where([['status','=','1']])->count();
        return view('backend.index',compact('catalog_pending','catalog_diterima'));

    }
}
