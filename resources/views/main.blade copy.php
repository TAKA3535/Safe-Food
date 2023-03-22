@extends('layouts.main')
@section('content')
<!-- <img src="{{ url('cooking_sauce.png') }}" width="250" height="250"> -->
<!-- 上下どっちの書き方でもOK -->
<!-- <img src="{{ asset('cooking_syouyu_bottle.png') }}" width="250" height="250"> -->

<!-- <ul> -->
    <div id="full" class="wraptest">
        @foreach ($foodData as $data)
        <div class="item {{$data->class}}">
            <a href="/foods/update/{{$data->id}}"><img class="size" src="{{ $data->image }}" alt="商品画像"></a>

            <li>商品情報：{{ $data->info }}</li>
            <li>賞味期限日：{{ $data->limit }}</li>
            <li>通知日：{{ $data->alert }}</li>
        </div>

        <!-- <div class="item">
            <a href="/foods/update"><img class="size" src="cooking_sauce.png" alt="商品画像"></a>
            <h2>商品情報</h2>
        </div> -->

        @endforeach
    </div>

    <div id="0" class="wraptest">
        @foreach ($foods1 as $data)
        <div class="item {{$data->class}}">
            <a href="/foods/update/{{$data->id}}"><img class="size" src="{{ $data->image }}" alt="商品画像"></a>
            <li>商品情報：{{ $data->info }}</li>
            <li>賞味期限日：{{ $data->limit }}</li>
            <li>通知日：{{ $data->alert }}</li>
        </div>
        @endforeach
    </div>
    <div id="1" class="wraptest">
        @foreach ($foods2 as $data)
        <div class="item {{$data->class}}">
            <a href="/foods/update/{{$data->id}}"><img class="size" src="{{ $data->image }}" alt="商品画像"></a>
            <li>商品情報：{{ $data->info }}</li>
            <li>賞味期限日：{{ $data->limit }}</li>
            <li>通知日：{{ $data->alert }}</li>
        </div>
        @endforeach
    </div>
    <div id="2" class="wraptest">
        @foreach ($foods3 as $data)
        <div class="item {{$data->class}}">
            <a href="/foods/update/{{$data->id}}"><img class="size" src="{{ $data->image }}" alt="商品画像"></a>
            <li>商品情報：{{ $data->info }}</li>
            <li>賞味期限日：{{ $data->limit }}</li>
            <li>通知日：{{ $data->alert }}</li>
        </div>
        @endforeach
    </div>
<!-- </ul> -->
<!-- @include('partials.foodList', ['foodData' => $foodData])
</div>

<div>
    <div id="result"></div>
    <select id="dropdown">
        <option value="1">Option 1</option>
        <option value="2">Option 2</option>
        <option value="3">Option 3</option>
    </select>
</div>

<h1>foodData</h1>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Info</th>
            <th>CATEGORY</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($foodData as $data)
        <tr>
            <td>{{ $data->id }}</td>
            <td>{{ $data->info }}</td>
            <td>{{ $data->category_id }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<select id="record-selector">
    <option value="">Select a record</option>
    @foreach ($foodData as $data)
    <option value="{{ $data->id }}">{{ $data->category_id }}</option>
    @endforeach
</select>

<div id="selected-record"></div><br> -->

<!-- <select onchange="showContent(this)">
    <option value="option0">全ジャンル</option>
    <option value="option1">冷蔵1</option>
    <option value="option2">冷凍２</option>
    <option value="option3">常温3</option>
</select><br> -->

<!-- 
<div id="option1" class="wraptest">
    @foreach ($foods1 as $data)
    <div class="item {{$data->class}}">
        <a href="/foods/update/{{$data->id}}"><img class="size" src="{{ $data->image }}" alt="商品画像"></a>
        <li>商品情報：{{ $data->info }}</li>
        <li>賞味期限日：{{ $data->limit }}</li>
        <li>通知日：{{ $data->alert }}</li>
    </div>
    @endforeach
</div>
<div id="option2" class="wraptest">
    @foreach ($foods2 as $data)
    <div class="item {{$data->class}}">
        <a href="/foods/update/{{$data->id}}"><img class="size" src="{{ $data->image }}" alt="商品画像"></a>
        <li>商品情報：{{ $data->info }}</li>
        <li>賞味期限日：{{ $data->limit }}</li>
        <li>通知日：{{ $data->alert }}</li>
    </div>
    @endforeach
</div>
<div id="option3" class="wraptest">
    @foreach ($foods3 as $data)
    <div class="item {{$data->class}}">
        <a href="/foods/update/{{$data->id}}"><img class="size" src="{{ $data->image }}" alt="商品画像"></a>
        <li>商品情報：{{ $data->info }}</li>
        <li>賞味期限日：{{ $data->limit }}</li>
        <li>通知日：{{ $data->alert }}</li>
    </div>
    @endforeach
</div> -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@vite(['resources/sass/app.scss', 'resources/js/food.js'])
@endsection