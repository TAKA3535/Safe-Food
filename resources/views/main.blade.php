@extends('layouts.main-default')
@section('content')
<x-guest-layout>
    <!-- <img src="{{ url('cooking_sauce.png') }}" width="250" height="250"> -->
    <!-- 上下どっちの書き方でもOK -->
    <!-- <img src="{{ asset('cooking_syouyu_bottle.png') }}" width="250" height="250"> -->

    <div class="wrap">
        <div class="item">
            <a href="/foods/update"><img src="cooking_sauce.png" alt="商品画像"></a>
            <h2>商品情報</h2>
        </div>

        <div class="item">
            <img src="cooking_syouyu_bottle.png">
            <h2>商品情報</h2>
        </div>

        <div class="item">
            <img src="food_sald_oil.png">
            <h2>商品情報</h2>
        </div>

        <div class="item">
            <img src="kkrn_icon_user_8.png">
            <h2>商品情報</h2>
        </div>

    </div>
</x-guest-layout>
@endsection