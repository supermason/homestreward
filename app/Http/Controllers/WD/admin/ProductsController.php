<?php

namespace App\Http\Controllers\wd\admin;

use App\Menu;
use App\Product;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

use App\UI\Select\SelectCreator;
use App\Util\Graphics\ImageUtil;

use Illuminate\Support\Facades\Redirect;

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
            'products' => Product::orderBy('created_at', 'desc')->paginate(16),
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

        $status = [
            'ok' => false,
            'msg' => ''
        ];

        $imgPath = ImageUtil::saveImgFromRequest($request, 'productImg', 'img/wd/product/' . Input::get('category'));

        if (!is_null($imgPath)) {
            $product = new Product([
                'name' => Input::get('name'),
                'subtitle' => Input::get('subtitle'),
                'thumbnail' => $imgPath,
                'category_id' => Input::get('category'),
                'retail_price' => Input::get('price'),
                'wholesale_price' => Input::get('wholesalePrice'),
                'count' => Input::get('count'),
                'description' => Input::get('description'),
            ]);

            if (!$product->save()) {
                $status['msg'] = trans('products.addNewProduct.errors.addError');
            } else {
                $status['ok'] = true;
            }
        } else {
            $status['msg'] = trans('products.addNewProduct.errors.imgError');
        }


        if ($status['ok']) {
            return Redirect::back()->withMessage('ok');
        } else {
            return Redirect::back()->withInput()->withErrors($status['msg']);
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
        // 会自动抛出异常，在handler里单独处理一下
        $product = Product::findOrFail($id);

        //
        return view("wd.admin.product.edit")->withData([
            "product" => $product,
            "options" => SelectCreator::createOptions(Menu::class, ["product_category", "label"], $product->category_id),
        ]);
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
        // 先验证
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
            'wholesalePrice' => 'required',
            'description' => 'required',
        ]);

        //
        $product = Product::findOrFail($id);

        $product->name = Input::get('name');
        $product->subtitle = Input::get('subtitle');
        $product->category_id = Input::get('category');
        $product->retail_price = Input::get('price');
        $product->wholesale_price = Input::get('wholesalePrice');
        $product->count = Input::get('count');
        $product->description = Input::get('description');
        // 单独处理图片



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
