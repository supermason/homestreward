<?php

namespace App\Http\Controllers\bill;

use App\ConsumingRecords;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Redirect, Input;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $billInfo = [
            'amount' => Input::get('amount'),
            'category_id' => Input::get('categoryId'),
            'remark' => Input::get('remark'),
            'who' => Auth::user()->id,
        ];

        // 单独判断一下是否有填写消费时间
        $consumptionDate = Input::get("consumptionDate");
        if ($consumptionDate !== '') {
            // 注意格式 'H:i:s'＝24小时制，'h:i:s'＝12小时制
            $billInfo["consumption_date"] = $consumptionDate . " " . date('H:i:s', time());
        } else {
            $billInfo["consumption_date"] = date('y-m-d H:i:s', time());
        }

        if (ConsumingRecords::create($billInfo)) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }

//        return response()->json($billInfo);
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

    /**
     * 根据页码＋每页数量获取账单信息
     */
    public function search()
    {
        return $this->getQueryObj()
            ->whereRaw('date_format(consuming_records.consumption_date, "%Y%m") = date_format(curDate(), "%Y%m")')
            ->orderBy('consuming_records.consumption_date', 'desc')
            ->paginate(5)->toJson();

    }

    /**
     * 根据年月日查询账单纪录
     * @param int $year
     * @param int $month
     * @param int $day
     */
    public function searchByDate($year, $month, $day)
    {
        $targetDate = $year . '-' . $month . '-' . $day;

//        {
//            "total": 50,
//           "per_page": 15,
//           "current_page": 1,
//           "last_page": 4,
//           "next_page_url": "http://laravel.app?page=2",
//           "prev_page_url": null,
//           "from": 1,
//           "to": 15,
//           "data":[
//                {
//                    // Result Object
//                },
//                {
//                    // Result Object
//                }
//           ]
//        }

        // 按日期查询时，获取全部数据，所以不用给paginate传参
        return $this->getQueryObj()
            ->whereRaw('date_format(consuming_records.consumption_date, "%Y%m%d") = date_format("' . $targetDate . '", "%Y%m%d")')
            ->orderBy('consuming_records.created_at', 'desc')
            ->paginate()->toJson();
    }

    /**
     * 获取当月消费总和
     */
    public function total()
    {
        return response()->json([
            'total' => ConsumingRecords::whereRaw('date_format(consuming_records.consumption_date, "%Y%m") = date_format(curDate(), "%Y%m")')->sum('amount')]);
    }

    /**
     * 创建消费记录查询对象
     * @return mixed
     */
    private function getQueryObj()
    {
        return ConsumingRecords::select('amount', 'cc.name AS category', 'remark', 'consuming_records.consumption_date AS date', 'u.name AS who')
            ->join('consumption_categories AS cc', 'category_id', '=', 'cc.id')
            ->leftJoin('users AS u', 'who', '=', 'u.id');
    }
}
