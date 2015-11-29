<?php

namespace App\Http\Controllers\wd\admin;

use App\Menu;
use App\Product;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        return view("wd.admin.product.index")->withData([
            'products' => Product::paginate(16),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return view("wd.admin.product.create")->withData([
            'pCategory' => Menu::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        // 验证一下必填项
        $this->validate($request, [
            'name' => 'required',
            'productImg' => 'required',
            'price' => 'required',
            'wholesalePrice' => 'required',
            'description' => 'required',
         ]);

        // 图片怎么处理呢？

        $product = new Product([
            'name' => Input::get('name'),
            'subtitle' => Input::get('subtitle'),
            'thumbnail' => 'sdfsdfsdf',
            'category_id' => Input::get('category'),
            'retail_price' => Input::get('price'),
            'wholesale_price' => Input::get('wholesalePrice'),
            'count' => Input::get('count'),
            'description' => Input::get('description'),
        ]);

        if ($product->save()) {

        } else {
            return Redirect::back()->withInput()->withErrors(trans('products.addNewProduct.errors.addError'));
        }
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
        return view("wd.admin.product.edit");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
