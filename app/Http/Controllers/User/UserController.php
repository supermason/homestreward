<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;

use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

use Redirect, Input;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $newName = Input::get('name');
        //
        $my = User::find(Auth::user()->id);
        $my->name = $newName;
        $my->save();

        return response()->json(['newName' => $newName]);
    }

    /**
     * 修改密码
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'oldPassword' => 'required|min:6',
            'password' => 'required|confirmed|min:6'
        ]);

        $user = User::findOrFail(Auth::user()->id);

        if ($user->password != Input::get('oldPassword')) {
            return response()->json(['success' => false, 'msg' => trans('user.edit.passwordWrong')]);
        } else {
            $user->password = Input::get('password');
            $user->save();

            return response()->json(['success' => true]);
        }

    }

    /**
     * 修改头像
     *
     * @param Request $request
     * @return string
     */
    public function changeFace(Request $request)
    {
        $newFace = '';

        return $newFace;
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
