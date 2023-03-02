@extends('layouts.main-default')
@section('content')
<br>
<br>

<!-- <div class="tab">
    <button class="tablinks" onclick="openTab(event, 'tab1')">タブ1</button>
    <button class="tablinks" onclick="openTab(event, 'tab2')">タブ2</button>
    <button class="tablinks" onclick="openTab(event, 'tab3')">タブ3</button>
</div>

<div id="tab1" class="tabcontent">
    <h3>タブ1のコンテンツ</h3>
    <p>
    <div class="item">
            <a href="/foods/update"><img src="cooking_sauce.png" alt="商品画像"></a>
            <h2>商品情報</h2>
        </div>

        </div>

    </div>

    </p>
</div>

<div id="tab2" class="tabcontent">
    <h3>タブ2のコンテンツ</h3>
    <p>ここにタブ2の詳細な説明を記述します。</p>
</div>

<div id="tab3" class="tabcontent">
    <h3>タブ3のコンテンツ</h3>
    <p>ここにタブ3の詳細な説明を記述します。</p>
</div> -->

<p id="tabcontrol">
    <a href="#tabpage1">アカウント</a>
    <a href="#tabpage2">通知設定</a>
    <a href="#tabpage3">メールアドレス変更</a>
    <a href="#tabpage4">パスワード変更</a>
    <a href="#tabpage5">ログアウト</a>
    <a href="#tabpage6">アカウント削除</a>
</p>
<div id="tabbody">
    <div id="tabpage1">…… タブ1の中身 ……</div>
    <div id="tabpage2">…… タブ2の中身 ……</div>
    <div id="tabpage3">…… タブ3の中身 ……</div>
    <div id="tabpage4">…… タブ4の中身 ……</div>
    <div id="tabpage5">…… タブ5の中身 ……</div>
    <div id="tabpage6">…… タブ6の中身 ……</div>
</div>

@endsection