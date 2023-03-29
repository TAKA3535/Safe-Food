@extends('layouts.line')
@section('content')
<div class="center">
    <p>公式Lineアカウント友達追加用QRコード</p>
    <div class="line">
        <img src="https://qr-official.line.me/gs/M_973orjiy_GW.png" width="200" height="200"><br>
    </div><br>

    <form method="POST" action="line">
        @csrf
        <div>
            <label for="line_user_id">Line User ID:</label>
            <input type="text" name="line_user_id" id="line_user_id" required placeholder="Line User IDを入力">
        </div>
        <button type="submit">登録</button>
    </form><br>

    <!-- <form method="POST" action="line/enable">
        @csrf
        <label>状態を変更するLine User IDを選択</label>
        <br>
        @foreach ($lines as $id => $line)
        <input type="radio" name="line_id" value="{{ $id }}" required> {{ $line }}:
        <input type="radio" name="enable" value="true" checked> 有効
        <input type="radio" name="enable" value="false"> 無効
        <br>
        @endforeach
        <br>
        <button type="submit">変更</button>
    </form> -->

    <form method="POST" action="line">
        @csrf
        @method('PUT')
        <label>Line User ID:</label>
        <br>
        @foreach ($lines as $id => $line)
        <input type="radio" name="line_id" value="{{ $id }}" required> {{ $line }}
        <!-- <input type="radio" name="enable" value="true" required> 有効
        <input type="radio" name="enable" value="false" required> 無効 -->
        <br>
        @endforeach
        <input type="radio" name="enable" value="true" required> 有効
        <input type="radio" name="enable" value="false" required> 無効
        <br>
        <button type="submit">更新</button>
    </form>

    <form method="POST" action="line">
        @csrf
        @method('DELETE')
        <label>削除するLine User IDを選択</label>
        <br>
        @foreach ($lines as $id => $line)
        <input type="radio" name="line_id" value="{{ $id }}" required> {{ $line }}
        <br>
        <!-- <input type="radio" name="enable" value="1" checked> オン
        <input type="radio" name="enable" value="0"> オフ<br> -->

        {{-- <input type="radio" name="line_id" value="{{ $id }}"> {{ $line->line_user_id }}<br> 左だとダメ --}}
        @endforeach
        <br>
        <button type="submit">削除</button>
    </form><br>

</div>



@endsection