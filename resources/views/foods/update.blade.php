@extends('layouts.main-another')

@section('content')
<form class="center" action="/foods/update/{{$foodData->id}}" method="post">
    @csrf
    <br>
    <!-- <label for="info">商品情報:</label> -->
    <p>商品情報</p>
    <input type="text" id="info" name="info" required value="{{$foodData->info}}" placeholder="商品情報を入力"><br>

    <!-- フォームで選択した画像 -->
    <div class="line" >
        <img id="figureImage" class="createImage" accept="image/*" src="/{{$foodData->image}}" required><br>
        <!-- <img id="figureImage" class="createImage" accept="image/*" src="{{ asset('storage/images/' . $foodData->image) }}" required><br> -->
    </div>

    <div class="buttons">
        <!-- フォーム -->
        <label for="input">画像ファイル</label>
        <input type="file" name="image" id="input" accept="image/*" value="商品イラスト選択" required>
    </div><br>

    <!-- <label for="category">ジャンル登録:</label> -->
    <p>ジャンル登録</p>
    <select name="category_id" id="category" required>
        <option value="" name="category_id" selected disabled>ジャンル登録</option>
        <option value=1>冷蔵</option>
        <option value=2>冷凍</option>
        <option value=3>常温</option>
    </select><br>

    <!-- <label for="limit_date">賞味期限日:</label> -->
    <p> 賞味期限日</p>
    <input type="date" id="limit_date" name="limit_date" value="{{ $foodData->limit_date }}" required><br>

    <!-- <label for="date">通知日設定:</label> -->
    <p> 通知日設定</p>
    <input type="date" id="date" name="alert" min="<?php echo date('Y-m-d'); ?>" value="{{ $foodData->alert }}" required><br>
    <input class="styled" type="submit" value="商品を更新"><br>
</form>
<form class="center" action="/foods/delete/{{$foodData->id}}" method="post">
    @csrf
    <input class="styled2" type="submit" value="商品を削除">
</form>Ï

@endsection