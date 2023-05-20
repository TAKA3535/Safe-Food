<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/sass/app.scss', 'resources/js/food.js'])
    <link rel="stylesheet" href="/css/style.css">
    <script>
        function showCategory(selectElement) {
            var selectedValue = selectElement.value;
            var contents = document.getElementsByClassName("wraptest");
            for (var i = 0; i < contents.length; i++) {
                var content = contents[i];
                if (content.id == selectedValue) {
                    // content.style.display = "block";
                    content.style.display = "flex";
                } else {
                    content.style.display = "none";
                }
            }
        }
    </script>
</head>

<body>
            <select name="category_id" onchange="showCategory(this)">
                <option value="full">全ジャンル</option>
                <option value="0">冷蔵</option>
                <option value="1">冷凍</option>
            </select>
            <a href="?sort_order={{ $sortOrder === 'asc' ? 'desc' : 'asc' }}">limit_date</a>
    <br>
    <div class="background">
        <div>
            <!-- <ul> -->
            <div id="full" class="wraptest">
                @foreach ($foodData as $data)
                <div class="item {{$data->class}}">
                    <a href="/foods/update/{{$data->id}}"><img class="size" src="{{ $data->image }}" alt="商品画像"></a>

                    <li>商品情報：{{ $data->info }}</li>
                    <li>賞味期限日：{{ $data->limit_date }}</li>
                </div>
                @endforeach
            </div>

            <div id="0" class="wraptest" style="display: none;">
                @foreach ($foods1 as $data)
                <div class="item {{$data->class}}">
                    <a href="/foods/update/{{$data->id}}"><img class="size" src="{{ $data->image }}" alt="商品画像"></a>
                    <li>商品情報：{{ $data->info }}</li>
                    <li>賞味期限日：{{ $data->limit_date }}</li>
                </div>
                @endforeach
            </div>
            <div id="1" class="wraptest" style="display: none;">
                @foreach ($foods2 as $data)
                <div class="item {{$data->class}}">
                    <a href="/foods/update/{{$data->id}}"><img class="size" src="{{ $data->image }}" alt="商品画像"></a>
                    <li>商品情報：{{ $data->info }}</li>
                    <li>賞味期限日：{{ $data->limit_date }}</li>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</body>
</html>

foodController.php
<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class FoodController extends Controller
{
    public function show(Request $request)
    {
        $userId = Auth::id();
        $categories = Category::all();
        // $foodData = Food::where('user_id', $userId)->get();    
        $foodData = Food::where('user_id', $userId)->orderBy('limit')->get();
        // $foodData = Food::where('user_id', $userId)->orderByDesc('limit')->get();   

        $sortOrder = $request->query('sort_order', 'asc');
        // $orderBy = $sortOrder === 'desc' ? '"limit" desc' : '"limit" asc';
        $orderBy = $sortOrder === 'desc' ? 'alert desc' : 'alert asc';

        $foodData = Food::where('user_id', $userId)->orderByRaw($orderBy)->get();
        $foods1 = Food::where('user_id', $userId)->where('category_id', 1)->orderByRaw($orderBy)->get();
        $foods2 = Food::where('user_id', $userId)->where('category_id', 2)->orderByRaw($orderBy)->get();

        $datas = [
            'foodData' => $foodData,
            'categories' => $categories,
            'foods1' => $foods1,
            'foods2' => $foods2,
            'sortOrder' => $sortOrder,
        ];
        return view('/main', $datas);
    }
}





@extends('layouts.main-another')

@section('content')
<form class="center" action="/main" method="post">
    <div class="buttons">
        <p>画像選択</p>
        <input type="file" name="image" id="input" value="商品イラスト選択" required>
    </div><br>
    <input type="submit" class="styled" value="商品を登録">
@endsection


<tr>
                    <th class="borderCount" tabindex="0">
                        <button type="button" onclick="location.href='/main'">登録した全ての食品(賞味期限切れ除く)</button>
                    </th>
                    <th class="borderCount">
                        <button type="button" onclick="location.href='/main?category=1'">蔵食品(賞味期限切れ除く)</button>
                    </th>
                    <th class="borderCount">
                        <button type="button" onclick="location.href='/main?category=2'">冷凍食品(賞味期限切れ除く)</button>
                    </th>
                    <th class="borderCount">
                        <button type="button" onclick="location.href='/main?category=3'">常温食品(賞味期限切れ除く)</button>
                    </th>
                    <th class="borderCount">
                        <button type="button" onclick="location.href='/main?category=4'">登録した全ての食品(賞味期限切れ除く)</button>
                    </th>
                    <th class="borderCount">
                        <button type="button" onclick="location.href='/main?category=5'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;通知日&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
                    </th>
                </tr>



blade
<tr>
<th class="borderCount">
    {{-- <a href="/main" onclick="changeBackgroundColor(this)" class="{{ Request::fullUrlIs('http://localhost/main') ? 'activefull' : '' }}">登録した全ての食品(賞味期限切れ除く)</a> --}}
    {{-- <button onclick="showCategory('full')" >登録した食品(賞味期限切れ除く)</button> --}}
    <button type="button" onclick="location.href='/main'" >登録した全ての食品(賞味期限切れ除く)</button>
    {{-- <button id="myButton" onclick="showCategory(this.value)" value="full">登録した食品(賞味期限切れ除く)</button> --}}
</th>
<th class="borderCount">
    {{-- <a href="/main?category=1">冷蔵食品(賞味期限切れ除く)</a> --}}
    <button type="button" onclick="location.href='/main?category=1'">蔵食品(賞味期限切れ除く)</button>

    {{-- <button onclick="showCategory('0')">冷蔵食品</button> --}}
    {{-- <button onclick="showCategory(this.value)" value="0">冷蔵食品(賞味期限切れ除く)</button> --}}

</th>
<th class="borderCount">
    <button type="button" onclick="location.href='/main?category=2'">冷凍食品(賞味期限切れ除く)</button>
    {{-- <a href="/main?category=2">冷凍食品(賞味期限切れ除く)</a> --}}

    {{-- <button onclick="showCategory(this.value)" value="1">冷蔵食品(賞味期限切れ除く)</button> --}}
</th>
<th class="borderCount">
    {{-- <a href="/main?category=3">常温食品(賞味期限切れ除く)</a> --}}
    <button type="button" onclick="location.href='/main?category=3'">常温食品(賞味期限切れ除く)</button>

    {{-- <button onclick="showCategory(this.value)" value="2">常温食品(賞味期限切れ除く)</button> --}}
</th>
<th class="borderCount">
    <button type="button" onclick="location.href='/main?category=4'">登録した全ての食品(賞味期限切れ除く)</button>

    {{-- <a href="/main?category=4">賞味期限切れの食品(賞味期限切れ除く)</a> --}}
    {{-- <a href="/main?category=4"
        class="{{ Request::fullUrlIs('http://localhost/main?category=4') ? 'active' : '' }}">賞味期限切れの食品</a> --}}
    {{-- <button onclick="showCategory(this.value)" value="3">賞味期限切れの食品(賞味期限切れ除く)</button> --}}
</th>
<th class="borderCount">
    {{-- <a href="/main?category=5">通知日</a> --}}
    <button type="button"
        onclick="location.href='/main?category=5'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;通知日&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
    {{-- <button onclick="showCategory(this.value)" value="2">常温食品(賞味期限切れ除く)</button> --}}
</th>
</tr>