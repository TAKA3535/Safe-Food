<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Carbon;
use Carbon\Carbon;

class FoodController extends Controller
{
    public function show(Request $request)
    {
        // Authファサードを使用して現在ログインしているユーザーのIDを取得
        $userId = Auth::id();


        // 現在ログインしているユーザーに関連する食品データの中から、指定した特定のcategory_idに紐付く商品を取得する
        // $categoryId = $request->input('category_id');
        // // dd($categoryId);
        // $foodDataQuery = Food::where('user_id', $userId);
        // if ($categoryId) {
        //     $foodDataQuery->where('category_id', $categoryId);
        // }
        // $foodData = $foodDataQuery->get();
        $categories = Category::all();
        // dd($categories);
        // 現在ログインしているユーザーに関連する食品データの中から、指定した特定のcategory_idに紐付く商品を取得する
        // $foodData = Food::where('user_id', $userId)->where('category_id', 1)->get();

        // 現在ログインしているユーザーに関連する食品データのみ取得
        // $foodData = Food::where('user_id', $userId)->get();    

        // $sort = $request->sort;

        // 昇順にソートする場合    
        // $foodData = Food::where('user_id', $userId)->orderBy('limit_date')->get();
        //降順にソートする場合 
        // $foodData = Food::where('user_id', $userId)->orderByDesc('limit_date')->get();   


        // ボタンのクエリパラメーターからソートの順番を取得,limitが予約語なので""で囲む
        // $sortOrder = $request->query('sort_order', 'asc');
        // $orderBy = $sortOrder === 'desc' ? 'limit_date desc' : 'limit_date asc';
        // $orderBy = $sortOrder === 'desc' ? 'alert desc' : 'alert asc';

        // リクエストに sort パラメータが存在する場合
        if ($request->sort) {
            $sort = $request->sort;
            // sort パラメータが asc の場合、昇順にソートする
            if ($sort === 'asc') {
                $foodData = Food::where('user_id', $userId)->orderBy('limit_date', 'asc')->get();
            }
            // sort パラメータが desc の場合、降順にソートする
            else if ($sort === 'desc') {
                $foodData = Food::where('user_id', $userId)->orderBy('limit_date', 'desc')->get();
            }
        }
        // sort パラメータが存在しない場合は、デフォルトで昇順にソートする
        else {
            $foodData = Food::where('user_id', $userId)->orderBy('limit_date', 'asc')->get();
        }

        // リクエストに sort パラメータが存在する場合
        if ($request->sort) {
            $sort = $request->sort0;
            // sort パラメータが asc の場合、昇順にソートする
            if ($sort === 'asc') {
                $foods1 = Food::where('user_id', $userId)->where('category_id', 1)->orderBy('limit_date', 'asc')->get();
            }
            // sort パラメータが desc の場合、降順にソートする
            else if ($sort === 'desc') {
                $foods1 = Food::where('user_id', $userId)->where('category_id', 1)->orderBy('limit_date', 'desc')->get();
            }
        }
        // sort パラメータが存在しない場合は、デフォルトで昇順にソートする
        else {
            $foods1 = Food::where('user_id', $userId)->where('category_id', 1)->orderBy('limit_date', 'asc')->get();
        }


        // 昇順・降順にソートする場合    
        // $foodData = Food::where('user_id', $userId)->orderByRaw($orderBy)->get();
        // category_idが1の場合
        // $foods1 = Food::where('user_id', $userId)->where('category_id', 1)->orderByRaw($orderBy)->get();
        // // category_idが2の場合
        // $foods2 = Food::where('user_id', $userId)->where('category_id', 2)->orderByRaw($orderBy)->get();
        // // category_idが3の場合
        // $foods3 = Food::where('user_id', $userId)->where('category_id', 3)->orderByRaw($orderBy)->get();

        // // category_idが1, 2, 3の場合
        // $foods123 = Food::whereIn('category_id', [1, 2, 3])->get();

        // category_idが1の場合
        $foods1 = Food::where('user_id', $userId)->where('category_id', 1)->orderBy('limit_date')->get();
        // category_idが2の場合
        $foods2 = Food::where('user_id', $userId)->where('category_id', 2)->orderBy('limit_date')->get();
        // category_idが3の場合
        $foods3 = Food::where('user_id', $userId)->where('category_id', 3)->orderBy('limit_date')->get();

        // dd($foodData);
        // $foodData = Food::get();

        // 賞味期限日より以前の日付になったらbackground-colorの色を赤にする商品情報の数だけループ 
        foreach ($foodData as $data) {
            // 賞味期限日を取得
            $limitDate = new Carbon($data->limit_date);

            // 通知日が今日の日付より前であれば、クラス名を追加
            if ($limitDate->isPast()) {
                // if ($data->limit_date <= Carbon::now()->subDay()) {
                $data->class = 'limit_date';
            }
            // 賞味期限日が3日以内の場合にクラス名（class）を追加する,lteは以下、gtはより大きい
            if ($limitDate->lte(now()->addDay(3)) && $limitDate->gte(now()->isFuture())) {
                $data->class = 'limitAlert';
            }
            // else {
            //     $data->class = 'item';
            // }
        }

        foreach ($foods1 as $data) {
            $limitDate = new Carbon($data->limit_date);
            if ($limitDate->isPast()) {
                $data->class = 'limit_date';
            }
            if ($limitDate->lte(now()->addDay(3)) && $limitDate->gte(now()->isFuture())) {
                $data->class = 'limitAlert';
            }
        }

        foreach ($foods2 as $data) {
            $limitDate = new Carbon($data->limit_date);
            if ($limitDate->isPast()) {
                $data->class = 'limit_date';
            }
            if ($limitDate->lte(now()->addDay(3)) && $limitDate->gte(now()->isFuture())) {
                $data->class = 'limitAlert';
            }
        }

        foreach ($foods3 as $data) {
            $limitDate = new Carbon($data->limit_date);
            if ($limitDate->isPast()) {
                $data->class = 'limit_date';
            }
            if ($limitDate->lte(now()->addDay(3)) && $limitDate->gte(now()->isFuture())) {
                $data->class = 'limitAlert';
            }
        }

        $datas = [
            'foodData' => $foodData,
            'categories' => $categories,
            'foods1' => $foods1,
            'foods2' => $foods2,
            'foods3' => $foods3,
            // 'sortOrder' => $sortOrder,
            // Food::find($request->id)
        ];
        return view('/main', $datas);
    }

    public function index(Request $request)
    {
        $userId = Auth::id();

        $foodData = Food::where('user_id', $userId)->get();
        $category_id = $request->input('category_id');

        if (!empty($category_id)) {
            $foodData = Food::where('user_id', $userId)->where('category_id', $category_id)->get();
        }

        $categories = Category::all();

        $datas = [
            'foodData' => $foodData,
            'categories' => $categories,
            'category_id' => $category_id,
        ];

        return view('/partials/foodList', $datas);
    }

    // Foodモデルからidで情報を検出→オブジェクト化
    public function foodUpdate($id)
    {
        $userId = Auth::id();
        // dd($userId);
        // find()メソッドを使用して選択したIDのみを持つデータのみ取得
        $foodData = Food::where('user_id', $userId)->find($id);
        // dd($id);
        // dd($foodData);
        // dd($userId);
        $datas = [
            'foodData' => $foodData,
        ];
        return view('/foods/update', $datas);
    }

    public function update(Request $request, $id)
    {
        // Foodモデル内でidの存在チェック
        if (Food::where('id', $id)->exists()) {
            // idが存在する場合、そのフードデータを取得する
            $foodData = Food::find($id);

            $foodData->info = $request->input('info');
            $foodData->image = $request->input('image');
            $foodData->category_id = $request->input('category_id');
            $foodData->limit_date = $request->input('limit_date');
            $foodData->alert = $request->input('alert');

            // カレントユーザーのIDを代入する
            // $foodData->user_id = Auth::user()->id;
            $foodData->timestamps = false;
            // 変更を保存する
            $foodData->save();
        } else {
            abort(404); // $foodData が見つからなかったら404エラーを返す
        }
        return redirect('/main');
    }

    public function create(Request $request)
    {
        $newFood = new Food;
        $newFood->info = $request->input('info');
        $newFood->image = $request->input('image');
        $newFood->category_id = $request->input('category_id');
        $newFood->limit_date = $request->input('limit_date');
        $newFood->alert = $request->input('alert');
        $newFood->user_id = Auth::user()->id;
        $newFood->timestamps = false;    // 追記 これがないと存在しないcreate_atカラムエラーが出る

        //レコードをデータベースに挿入
        $newFood->save();
        // $foodData = Food::get();
        // $datas = ['foodData' => $foodData];
        // return view('/main', $datas);
        return redirect('/main');
        // return view('/main');


        // $param = [
        //     'name' => $request->name,
        //     'mail' => $request->mail,
        //     'age' => $request->age,
        // ];
        // DB::table('people')->insert($param);
        // return redirect('/hello');
    }

    public function delete(Request $request, $id)
    {
        $food = Food::find($id);
        $food->delete();
        return redirect('/main');
    }

    // public function foodUpdate(Request $request)
    // {
    //     $datas= Food::find($request->foodId);
    //     $datas->update([
    //         "info" => $request->input('info'),
    //         "image" => $request->input('image'),
    //         "category_id" => $request->input('category_id'),
    //         "limit_date" => $request->input('limit_date'),
    //         "alert" => $request->input('alert'),
    //         "user_id" => Auth::user()->id,
    //         "timestamps" => false,
    //     ]);
    //     return view('/foods/update', ["data" => $datas]);
    //     // return redirect("/main");
    // }
}
