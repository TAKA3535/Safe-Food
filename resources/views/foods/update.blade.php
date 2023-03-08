@extends('layouts.main-another')

@section('content')
<form class="center" action="/main" method="post">
    @csrf
    <label for="product_name">商品情報:</label>
    <input type="text" id="product_name" name="product_name" required value="商品情報を入力(任意)"><br>

    <!-- <label for="image">画像:</label>
    <input type="file" id="image" name="image"><br> -->

    <!-- フォームで選択した画像 -->
    <img id="figureImage" class="createImage" accept="image/*" src="https://tool-engineer.work/wp-content/uploads/2022/06/default.png"><br>

    <div class="buttons">
        <!-- フォーム -->
        <label for="input">画像ファイル</label>

        <input type="file" name="input" id="input" accept="image/*">
        <!-- <input type="file" name="logo" id="form" accept=".jpg, .jpeg, .png, .gif"> -->
        <!-- <figure id="figure" style="display: none"> -->
        <img src="" alt="" id="figureImage">
        <!-- </figure> -->
        <!-- 画像削除ボタン -->
    </div><br>

    <label for="category">ジャンル登録:</label>
    <select name="category" id="category">
        <option value="">ジャンル登録</option>
        <option value="food">冷蔵</option>
        <option value="food">冷凍</option>
        <option value="food">常温</option>
    </select><br>

    <label for="limit">賞味期限日:</label>
    <input type="date" id="limit" name="limit"><br>

    <label for="date">通知日設定:</label>
    <input type="date" id="date" name="date" min="<?php echo date('Y-m-d'); ?>" value="<?php echo date('Y-m-d'); ?>"><br>

    <input class="styled" type="submit" value="商品を更新"><br>
    <input type="submit" value="商品を削除">
</form>
@endsection