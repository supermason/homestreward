<?php

namespace App\Http\Controllers\WD;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class WDController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  int  $category
     * @return Response
     */
    public function index($category)
    {
        //
        return view("wd.list");
    }

    /**
     * Display a listing of the latest resource.
     *
     * @param  int  $category
     * @return Response
     */
    public function latestIndex($category)
    {
        //
        return view("wd.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
        return view("wd.detail");
    }
}
