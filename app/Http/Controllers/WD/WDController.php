<?php

namespace App\Http\Controllers\WD;

use Illuminate\Http\Request;

use App\Menu;
use App\Products;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class WDController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        return view("wd.index")->withData([
            'menu' => Menu::all(),
            'products' => $this->doSearchByCategory(WDConfig::PRODUCT_CATEGORY_JIEMIAN),
        ]);
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

    /**
     * search products according to the given category
     *
     * @param $category
     * @return Json Response
     */
    public function searchByCategory($category)
    {
        return $this->doSearchByCategory($category)->toJson();
    }

    /**
     * search products according to the given category
     *
     * @param $category
     * @return Response
     */
    private function doSearchByCategory($category)
    {
        return Products::where('category_id', '=', $category)
            ->orderBy('updated_at', 'desc')
            ->paginate(5);
    }
}
