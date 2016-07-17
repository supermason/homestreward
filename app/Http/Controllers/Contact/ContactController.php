<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 16/7/16
 * Time: 上午11:02
 */

namespace App\Http\Controllers\Contact;

use App\Contact;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ContactController extends Controller
{
    /**
     * 新增客户联系人
     *
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        // 先验证
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required|digits:11',
            'address' => 'required',
        ]);

        Contact::create([
            'name' => Input::get('name'),
            'phone' => Input::get('phone'),
            'address' => Input::get('address'),
        ]);

        return response()->json(['success' => true]);
    }

    /**
     * 根据关键字查找
     *
     * @return mixed
     */
    public function index()
    {
        $condition = '%' . Input::get("keywords") . '%';

        return response()->json(['contacts' => Contact::select('id', 'name', 'phone', 'address')->where('name', 'like', $condition)->orWhere('address', 'like', $condition)->orderBy('use_count', 'desc')->take(10)->get()]);
    }

    /**
     * 更新联系人使用频率
     *
     * @param $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);

        $contact->use_count += 1;

        if ($contact->save()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }
}