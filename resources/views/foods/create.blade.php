@extends('layouts.main-another')

@section('content')
    <form class="center" action="/main" method="post" enctype="multipart/form-data">
        @csrf
        <br>
        <p>食品情報</p>
        <input type="search" class="clear" id="info" name="info" placeholder="食品情報を入力" value="{{ old('info') }}"><br>
        @error('info')
            <div>
                <p class="error-message"> {{ $message }} </p>
            </div>
        @enderror
        <div class="line">
            <img id="figureImage" class="createImage" accept="image/*" src="/1210228.png"><br>
        </div>
        <div class="buttons">
            <p>画像選択</p>
            <input type="file" name="image" id="input" accept="image/*" value="食品イラスト選択">
        </div>
        @error('image')
            <div>
                <p class="error-message"> {{ $message }} </p>
            </div>
        @enderror
        <br>
        <p>ジャンル登録</p>

        <input type="radio" name="category_id" value="0" required>冷蔵
        <input type="radio" name="category_id" value="1" required>冷凍
        <input type="radio" name="category_id" value="2" required>常温

        <p>賞味期限日</p>
        <input type="date" id="limit_date" name="limit_date" required><br>

        <p>通知日設定</p>
        <input type="date" id="date" name="alert" min="<?php echo date('Y-m-d'); ?>" value="<?php echo date('Y-m-d'); ?>"
            required><br>

        <input type="submit" class="styled" value="商品を登録">
    @endsection
