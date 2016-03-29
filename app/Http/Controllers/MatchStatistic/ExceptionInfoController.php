<?php

namespace App\Http\Controllers\MatchStatistic;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\MatchStatisticExceptions;
use Illuminate\Support\Facades\Input;

class ExceptionInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view("matchstatistic.index")->withData([
            'exceptions' => MatchStatisticExceptions::orderBy('created_at', 'desc')->paginate(16),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 验证一下必填项
        $this->validate($request, [
            'device' => 'required',
            'android' => 'required',
            'title' => 'required',
            'content' => 'required',
        ]);

        $exception = new MatchStatisticExceptions(Input::getAll());

        // 不用理会是否保存成功
        $exception->save();

        return null;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // 会自动抛出异常，在handler里单独处理一下
        $exception = MatchStatisticExceptions::findOrFail($id);

        //
        return view("matchstatistic.detail")->withData([
            "exception" => $exception,
        ]);
    }
}
