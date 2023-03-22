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

    <!-- <script>
        $(document).ready(function() {
            // カテゴリープルダウンが変更された場合のイベント
            $('#mySelect').change(function() {
                // カテゴリーIDを取得
                var categoryId = $(this).val();
                // console.log(categoryId);
                if (categoryId) {
                    $.ajax({
                        url: "{{ url('/food/filter/') }}/" + categoryId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            // データが取得されたら、フィルターされた商品を表示
                            $('.wrap').html(data.html);
                        }
                    });
                } else {
                    // カテゴリーが選択されていない場合は、全ての商品を表示
                    $.ajax({
                        url: "{{ url('/food') }}",
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('.wrap').html(data.html);
                        }
                    });
                }
            });
        });
    </script> -->
    <!-- <script>
        document.getElementById("mySelect").onchange = function() {
            var categoryId = this.value;
            window.location.href = "/foods?category_id=" + categoryId;
        };
    </script> -->
    <!-- <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#category').change(function() {
                var categoryId = $(this).val();
                if (categoryId) {
                    $.ajax({
                        url: '/category/show',
                        type: 'POST',
                        data: {
                            category_id: categoryId
                        },
                        dataType: 'html',
                        success: function(data) {
                            $('#product-list').html(data);
                        },
                        error: function() {
                            alert('エラーが発生しました。');
                        }
                    });
                } else {
                    $('#product-list').html('');
                }
            });
        });
    </script> -->
    <script>
        $(document).ready(function() {
            $('#record-selector').change(function() {
                var recordId = $(this).val();
                if (recordId) {
                    $.ajax({
                        url: '/records/' + recordId,
                        type: 'GET',
                        success: function(data) {
                            $('#selected-record').html(data);
                        }
                    });
                } else {
                    $('#selected-record').empty();
                }
            });
        });
    </script>

    <script>
        function showContent(selectElement) {
            var selectedValue = selectElement.value;
            var contents = document.getElementsByClassName("wraptest");
            for (var i = 0; i < contents.length; i++) {
                var content = contents[i];
                if (content.id == selectedValue) {
                    content.style.display = "block";
                } else {
                    content.style.display = "none";
                }
            }
        }
    </script>


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

            <!-- <select name="category_id"  onchange="showContent(this)">
                <option value="full">全ジャンル</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                @endforeach
            </select> -->

            <select name="category_id"  onchange="showContent(this)">
                <option value="full">全ジャンル</option>
                <option value="0">冷蔵</option>
                <option value="1">冷凍</option>
                <option value="2">常温 </option>
            </select>

            <!-- <select name="category_id" id="mySelect">
                <option value="">全ジャンル</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                @endforeach
            </select> -->
            <!-- <select name="category_id" id="mySelect">
                <option value="">選択してください</option>
                @foreach ($foodData as $data)
                <option value="{{ $data->id }}">{{ $data->category_id }}</option>
                @endforeach
            </select> -->
            <select>
                <option value="">並び替え</option>
                <option value="">昇順</option>
                <option value="food">降順</option>
            </select>
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
            @component('components.header')
            @endcomponent

            <!-- <main class="bg-home d-flex align-items-center w-100 h-100"> -->
            @yield('content') <br>
            <!-- </main> -->

            @yield('scripts')


        </div>
    </div>

</body>

</html>