@extends('layouts.main')
@section('content')
<!-- <img src="{{ url('cooking_sauce.png') }}" width="250" height="250"> -->
<!-- 上下どっちの書き方でもOK -->
<!-- <img src="{{ asset('cooking_syouyu_bottle.png') }}" width="250" height="250"> -->

<div class="wrap">
    <div class="item">
        <a href="/foods/update"><img class="size" src="cooking_sauce.png" alt="商品画像"></a>
        <h2>商品情報</h2>
    </div>

    <div class="item">
        <img class="size" src="cooking_syouyu_bottle.png">
        <h2>商品情報</h2>
    </div>

    <div class="item">
        <img class="size" src="food_sald_oil.png">
        <h2>商品情報</h2>
    </div>

    <div class="item">
        <img class="size" src="cooking_mayonnaise_kakeru.png">
        <h2>商品情報</h2>
    </div>

    <div class="item">
        <img class="size" src="cooking_ketchp_kakeru.png">
        <h2>商品情報</h2>
    </div>

    <div class="item">
        <img class="size" src="katsuobushi.png">
        <h2>商品情報</h2>
    </div>

    <div class="item">
        <img class="size" src="cooking_yakiniku_tare.png">
        <h2>商品情報</h2>
    </div>

    <div class="item">
        <img class="size" src="cooking_osu2.png">
        <h2>商品情報</h2>
    </div>

    <div class="item">
        <img class="size" src="food_sald_oil.png">
        <h2>商品情報</h2>
    </div>

    <div class="item">
        <img class="size" src="kkrn_icon_user_8.png">
        <h2>商品情報</h2>
    </div>

    <div class="item">
        <img class="size" src="kkrn_icon_user_8.png">
        <h2>商品情報</h2>
    </div>
</div>
@endsection