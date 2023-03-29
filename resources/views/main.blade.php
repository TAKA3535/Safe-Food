<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <!-- <script src="{{ mix('js/app.js') }}" defer></script> -->
    @vite(['resources/sass/app.scss', 'resources/js/food.js'])
    <!-- 下記でjQueryを読み込む -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- @vite( 'resources/js/app.js') -->
    <link rel="stylesheet" href="/css/style.css">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">


    <!-- Styles -->
    <br>

    <!-- プルダウンでジャンル別表示切り替え -->
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
            var url = new URL(window.location.href);
            url.searchParams.set('category_id', selectedValue);
            window.history.pushState(null, '', url);
        }
    </script>

    <!-- 昇順降順ソート切り替え -->
    <script>
        let isAscending = true;

        function toggleSort() {
            if (isAscending) {
                document.getElementById('sort-button').textContent = '賞味期限短い順';
                isAscending = false;
                // 降順にソートする処理
                fetch('/foods?sort=desc')
                    .then(response => response.json())
                    .then(data => {
                        // 取得したデータを表示する処理
                        location.reload();
                    });
            } else {
                document.getElementById('sort-button').textContent = '賞味期限長い順';
                isAscending = true;
                // 昇順にソートする処理
                fetch('/foods?sort=asc')
                    .then(response => response.json())
                    .then(data => {
                        // 取得したデータを表示する処理
                        location.reload();
                    });
            }
        }
    </script>

    <!-- <script>
        function showContent(selectElement) {
            var selectedValue = selectElement.value;
            var contents = document.getElementsByClassName("wraptest");
            for (var i = 0; i < contents.length; i++) {
                var content = contents[i];
                if (content.id == selectedValue || selectedValue == "full") {
                    content.style.display = "block";
                } else {
                    content.style.display = "none";
                }
            }
        }
    </script> -->


    <style>
        header {
            height: 100px;
            padding: 30px 4% 10px;
            position: fixed;
            top: 0;
            width: 100%;
            background-color: #fff;
            display: flex;
            align-items: center;
            border: 1px solid #7effb2;

        }

        a {
            text-decoration: none;
            color: #4b4b4b;
        }

        ul {
            list-style: none;
            margin: 0;
            display: flex;
        }

        li {
            margin: 0 0 0 15px;
            font-size: 14px;
        }

        nav {
            margin: 0 0 0 auto;
        }

        main {
            height: calc(100vh - 50px);
            min-height: calc(100vh - 50px);
            padding-top: 60px;
        }

        footer {
            height: 50px;
        }

        .bg-home {
            background-color: #1e90ff;
        }
    </style>

</head>

<body>
    <header>
        <h1>
            <a href="/main" class="logo">Safe Food</a>
        </h1>
        <nav>

            <select name="category_id" onchange="showCategory(this)">
                <option value="full">全ジャンル</option>
                <option value="0">冷蔵</option>
                <option value="1">冷凍</option>
                <option value="2">常温 </option>
            </select>

            <!-- <select>
                <option value="">並び替え</option>
                <option value="">昇順</option>
                <option value="food">降順</option>
            </select> -->

            <!-- {{-- --}} で囲んで強制コメントアウトにしている  -->
            {{-- <a href="?sort_order={{ $sortOrder === 'asc' ? 'desc' : 'asc' }}">limit_date</a> --}}
            <a href="?sort_order={{'asc' ? 'desc' : 'asc' }}">limit</a>

            {{-- 昇順にソートするリンク --}}
            <a href="{{ url('/main?sort=asc') }}">昇順</a>

            {{-- 降順にソートするリンク --}}
            <a href="{{ url('/main?sort=desc') }}">降順</a>

            <button id="sort-button" onclick="toggleSort()">賞味期限短い順</button>
        </nav><br>

        <nav>
            <button class="styled" type="button" onclick="location.href='/line'">
                公式Line登録/仕様書
            </button>
        </nav>

        <nav>
            <ul>
                <li> <button class="styled" type="button" onclick="location.href='/foods/create'">商品登録</button>
                </li>
                <!-- <li><a href="/foods/create">商品登録</a></li> -->
                <li><a href="/profile"><img src="kkrn_icon_user_8.png" alt="ユーザーアイコン" width="30" height="30"></a></li>
            </ul>
        </nav>
    </header>
    <br>
    <br>
    <br>
    <br>
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
                    <li>通知日：{{ $data->alert }}</li>
                </div>



                @endforeach
            </div>

            <div id="0" class="wraptest" style="display: none;">
                @foreach ($foods1 as $data)
                <div class="item {{$data->class}}">
                    <a href="/foods/update/{{$data->id}}"><img class="size" src="{{ $data->image }}" alt="商品画像"></a>
                    <li>商品情報：{{ $data->info }}</li>
                    <li>賞味期限日：{{ $data->limit_date }}</li>
                    <li>通知日：{{ $data->alert }}</li>
                </div>
                @endforeach
            </div>
            <div id="1" class="wraptest" style="display: none;">
                @foreach ($foods2 as $data)
                <div class="item {{$data->class}}">
                    <a href="/foods/update/{{$data->id}}"><img class="size" src="{{ $data->image }}" alt="商品画像"></a>
                    <li>商品情報：{{ $data->info }}</li>
                    <li>賞味期限日：{{ $data->limit_date }}</li>
                    <li>通知日：{{ $data->alert }}</li>
                </div>
                @endforeach
            </div>
            <div id="2" class="wraptest" style="display: none;">
                @foreach ($foods3 as $data)
                <div class="item {{$data->class}}">
                    <a href="/foods/update/{{$data->id}}"><img class="size" src="{{ $data->image }}" alt="商品画像"></a>
                    <li>商品情報：{{ $data->info }}</li>
                    <li>賞味期限日：{{ $data->limit_date }}</li>
                    <li>通知日：{{ $data->alert }}</li>
                </div>
                @endforeach
            </div>
            <!-- </ul> -->

            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        </div>
    </div>

</body>

</html>