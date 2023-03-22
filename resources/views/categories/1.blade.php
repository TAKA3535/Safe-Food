<div class="wrap">
    @foreach ($foodData as $data)
    <div class="item {{$data->class}}">
        <a href="/foods/update/{{$data->id}}"><img class="size" src="{{ $data->image }}" alt="商品画像"></a>

        <li>商品情報：{{ $data->info }}</li>
        <li>賞味期限日：{{ $data->limit }}</li>
        <li>通知日：{{ $data->alert }}</li>
        <li>ジャンル：{{ $data->category_id }}</li>
    </div>

    <!-- <div class="item">
            <a href="/foods/update"><img class="size" src="cooking_sauce.png" alt="商品画像"></a>
            <h2>商品情報</h2>
        </div> -->

    @endforeach
</div>
</div>