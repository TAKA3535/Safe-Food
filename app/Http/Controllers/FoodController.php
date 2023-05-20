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
use Illuminate\Support\Facades\Storage;
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

        $foodData = Food::where('user_id', $userId)->where('limit_date', '>=', date('Y-m-d'))->orderBy('limit_date', 'asc')->get();
        // $foodData = Food::where('user_id', $userId)->where('alert', '=', date('Y-m-d'))->get();
        $count = $foodData->count();



        if ($request->category) {
            $category = $request->category;
            // if ($category === 'full') {
            //     $foodData = Food::where('user_id', $userId)->where('limit_date', '>=', date('Y-m-d'))->orderBy('limit_date', 'asc')->get();
            // }
            if ($category === '1') {
                $foodData = Food::where('user_id', $userId)->where('limit_date', '>=', date('Y-m-d'))->where('category_id', 1)->orderBy('limit_date', 'asc')->get();
            }
            if ($category === '2') {
                $foodData = Food::where('user_id', $userId)->where('limit_date', '>=', date('Y-m-d'))->where('category_id', 2)->orderBy('limit_date', 'asc')->get();
            }
            if ($category === '3') {
                $foodData = Food::where('user_id', $userId)->where('limit_date', '>=', date('Y-m-d'))->where('category_id', 3)->orderBy('limit_date', 'asc')->get();
            }
            if ($category === '4') {
            $foodData = Food::where('user_id', $userId)->where('limit_date', '<', date('Y-m-d'))->orderBy('limit_date', 'asc')->get();
            } 
            if ($category === '5') {
                $foodData = Food::where('user_id', $userId)->where('alert', '=', date('Y-m-d'))->orderBy('limit_date', 'asc')->get();
                } 
        }
        else {
            $foodData = Food::where('user_id', $userId)->where('limit_date', '>=', date('Y-m-d'))->orderBy('limit_date', 'asc')->get();
        }




        // リクエストに sort パラメータが存在する場合
        if ($request->sort) {
            $sort = $request->sort;
            // sort パラメータが asc の場合、昇順にソートする
            if ($sort === 'asc') {
                $foodData = Food::where('user_id', $userId)->where('limit_date', '>=', date('Y-m-d'))->orderBy('limit_date', 'asc')->get();
            }
            // sort パラメータが desc の場合、降順にソートする
            else if ($sort === 'desc') {
                $foodData = Food::where('user_id', $userId)->where('limit_date', '>=', date('Y-m-d'))->orderBy('limit_date', 'desc')->get();
            }
            if ($sort === 'asc0') {
                $foodData = Food::where('user_id', $userId)->where('limit_date', '>=', date('Y-m-d'))->where('category_id', 1)->orderBy('limit_date', 'asc')->get();
            }
            // sort パラメータが desc の場合、降順にソートする
            else if ($sort === 'desc0') {
                $foodData = Food::where('user_id', $userId)->where('limit_date', '>=', date('Y-m-d'))->where('category_id', 1)->orderBy('limit_date', 'desc')->get();
            }
            if ($sort === 'asc1') {
                $foodData = Food::where('user_id', $userId)->where('limit_date', '>=', date('Y-m-d'))->where('category_id', 2)->orderBy('limit_date', 'asc')->get();
            }
            // sort パラメータが desc の場合、降順にソートする
            else if ($sort === 'desc1') {
                $foodData = Food::where('user_id', $userId)->where('limit_date', '>=', date('Y-m-d'))->where('category_id', 2)->orderBy('limit_date', 'desc')->get();
            }
            if ($sort === 'asc2') {
                $foodData = Food::where('user_id', $userId)->where('limit_date', '>=', date('Y-m-d'))->where('category_id', 3)->orderBy('limit_date', 'asc')->get();
            }
            // sort パラメータが desc の場合、降順にソートする
            else if ($sort === 'desc2') {
                $foodData = Food::where('user_id', $userId)->where('limit_date', '>=', date('Y-m-d'))->where('category_id', 3)->orderBy('limit_date', 'desc')->get();
            }
        }
        // sort パラメータが存在しない場合は、デフォルトで昇順にソートする
        // else {
        //     $foodData = Food::where('user_id', $userId)->where('limit_date', '>=', date('Y-m-d'))->orderBy('limit_date', 'asc')->get();

        //     // $imageUrl = Storage::url($foodData->image);
        //     // $imageUrls[] = $imageUrl;
        // }

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
        $foods1 = Food::where('user_id', $userId)->where('category_id', 1)->where('limit_date', '>=', date('Y-m-d'))->orderBy('limit_date')->get();
        $count1 = $foods1->count();

        // category_idが2の場合
        $foods2 = Food::where('user_id', $userId)->where('category_id', 2)->where('limit_date', '>=', date('Y-m-d'))->orderBy('limit_date')->get();
        $count2 = $foods2->count();

        // category_idが3の場合
        $foods3 = Food::where('user_id', $userId)->where('category_id', 3)->where('limit_date', '>=', date('Y-m-d'))->orderBy('limit_date')->get();
        $count3 = $foods3->count();

        // $imageUrl3 = Storage::url($foods3->image);
        // $imageUrls3[] = $imageUrl3;
        $foods4 = Food::where('user_id', $userId)->where('limit_date', '<', date('Y-m-d'))->orderBy('limit_date', 'asc')->get();
        $count4 = $foods4->count();

        $foods5 = Food::where('user_id', $userId)->where('alert', '=', date('Y-m-d'))->orderBy('limit_date', 'asc')->get();
        $count5 = $foods5->count();





        // dd($foodData);
        // $foodData = Food::get();

        // 賞味期限日より以前の日付になったらbackground-colorの色を赤にする商品情報の数だけループ 
        $remainingDays = [];
        foreach ($foodData as $data) {
            // 賞味期限日を取得
            $limitDate = new Carbon($data->limit_date);
            // $limitDate = new Carbon('2023-05-10');

            $today = Carbon::today();
            if ($limitDate->lt($today)) {
                $data->class = 'limit_date';
            }
            // 通知日が今日の日付より前であれば、クラス名を追加

            // 賞味期限日が3日以内の場合にクラス名（class）を追加する,lteは以下、gtはより大きい
            $threeDaysLater = Carbon::today()->addDays(2);
            if ($limitDate->between($today, $threeDaysLater)) {
                $data->class = 'limitAlert';
            }
            // else {
            //     $data->class = 'item';
            // }
            // 残り日数を計算
            $remainingDays[$data->id]  = $today->diffInDays($limitDate, false);
        }
        // dd($remainingDays);

        foreach ($foods1 as $data) {
            $limitDate = new Carbon($data->limit_date);
            $today = Carbon::today();
            if ($limitDate->lt($today)) {
                $data->class = 'limit_date';
            }
            $threeDaysLater = Carbon::today()->addDays(2);
            if ($limitDate->between($today, $threeDaysLater)) {
                $data->class = 'limitAlert';
            }
            $remainingDays[$data->id]  = $today->diffInDays($limitDate, false);
        }

        foreach ($foods2 as $data) {
            $limitDate = new Carbon($data->limit_date);
            $today = Carbon::today();
            if ($limitDate->lt($today)) {
                $data->class = 'limit_date';
            }
            $threeDaysLater = Carbon::today()->addDays(2);
            if ($limitDate->between($today, $threeDaysLater)) {
                $data->class = 'limitAlert';
            }
            $remainingDays[$data->id]  = $today->diffInDays($limitDate, false);
        }

        foreach ($foods3 as $data) {
            $limitDate = new Carbon($data->limit_date);
            $today = Carbon::today();
            if ($limitDate->lt($today)) {
                $data->class = 'limit_date';
            }
            $threeDaysLater = Carbon::today()->addDays(2);
            if ($limitDate->between($today, $threeDaysLater)) {
                $data->class = 'limitAlert';
            }
            $remainingDays[$data->id]  = $today->diffInDays($limitDate, false);
        }

        foreach ($foods4 as $data) {
            $limitDate = new Carbon($data->limit_date);
            $today = Carbon::today();
            if ($limitDate->lt($today)) {
                $data->class = 'limit_date';
            }
            $threeDaysLater = Carbon::today()->addDays(2);
            if ($limitDate->between($today, $threeDaysLater)) {
                $data->class = 'limitAlert';
            }
        }

        $datas = [
            'foodData' => $foodData,
            'categories' => $categories,
            'foods1' => $foods1,
            'foods2' => $foods2,
            'foods3' => $foods3,
            'foods4' => $foods4,
            'count' => $count,
            'count1' => $count1,
            'count2' => $count2,
            'count3' => $count3,
            'count4' => $count4,
            'count5' => $count5,
            'remainingDays' => $remainingDays,
            // 'imageUrls' => $imageUrls,
            // 'imageUrls3' => $imageUrls3,
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
        $foodData = Food::where('user_id', $userId)->findOrFail($id);
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
            $foodData = Food::findOrFail($id);

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
        $newFood->image = $request->image;
        // $file = $request->file('image');
        // $filePath = $file->store('images'); // ファイルを保存してファイルパスを取得
        // $newFood->image = $filePath; // ファイルパスを保存
        // Storage::disk('public')->put('images/' , file_get_contents($filePath)); // ファイルをストレージに保存
        // Storage::disk('public')->put($filePath, file_get_contents(storage_path('app/'.$filePath))); // ファイルを公開用ディスクにコピー
        $newFood->category_id = $request->input('category_id');
        $newFood->limit_date = $request->input('limit_date');
        $newFood->alert = $request->input('alert');
        $newFood->user_id = Auth::user()->id;
        $newFood->timestamps = false;    // 追記 これがないと存在しないcreate_atカラムエラーが出る

        //レコードをデータベースに挿入
        $newFood->save();

        // if ($request->hasFile('image')) {
        //     $file = $request->file('image');
        //     $fileName = $file->getClientOriginalName(); // ファイル名を取得
        //     $filePath = $file->store('images'); // ファイルを保存してファイルパスを取得

        //     // データベースに保存する処理
        //     $image = new Image();
        //     $image->file_name = $fileName; // ファイル名を保存
        //     $image->file_path = $filePath; // ファイルパスを保存
        //     $image->save();

        //     // 保存完了のメッセージをセッションに格納してリダイレクト
        //     $request->session()->flash('success_message', '画像のアップロードが完了しました。');
        //     return redirect()->back();
        // }

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
        $food = Food::findOrfail($id);
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
