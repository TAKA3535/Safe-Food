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
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <!-- @vite('resources/js/app.js') -->
    <link rel="stylesheet" href="/css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">


    <!-- Styles -->
    <br>

    <script>
        $(function() {
            var body = $("body");
            var flag = true;

            $(document).on("mousemove", function(e) {
                if (flag) {
                    var x = e.clientX;
                    var y = e.clientY;

                    var star = $("<span>").attr("class", "star");
                    star.css({
                        "top": y + "px",
                        "left": x + "px"
                    });
                    body.prepend(star);
                    setTimeout(function() {
                        star.remove();
                    }, 1000);

                    flag = false;
                    setTimeout(function() {
                        flag = true;
                    }, 100);
                }
            });
        });
    </script>
    <script>
        // ページ読み込み時に保存された選択状態を復元する
        window.onload = function() {
            var selectedValue = sessionStorage.getItem('selectedValue');
            if (selectedValue) {
                var radio = document.getElementById(selectedValue);
                radio.checked = true;
                showCategory(radio);
            }
        };

        function showCategory(selectElement) {
            var selectedValue = selectElement.value;
            var contents = document.getElementsByClassName("sort");
            // var contents = document.querySelectorAll("#wraptest");
            for (var i = 0; i < contents.length; i++) {
                var content = contents[i];
                if (content.id == selectedValue) {
                    // content.style.display = "block";
                    content.style.display = "block";
                } else {
                    content.style.display = "none";
                }
            }
            var url = new URL(window.location.href);
            url.searchParams.set('category_id', selectedValue);
            window.history.pushState(null, '', url);
            
            // 選択された値をセッションストレージに保存する
            sessionStorage.setItem('selectedValue', selectedValue);
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
            left: 0;
            right: 0;
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
            <button class="styled" type="button" onclick="location.href='/line'">
                公式Line登録/仕様書
            </button>
        </nav>

        <nav>
            <ul>
                <li> <button class="styled" type="button" onclick="location.href='/foods/create'">商品登録</button>
                </li>
                <!-- <li><a href="/foods/create">商品登録</a></li> -->
                <li><a href="/profile"><img src="kkrn_icon_user_8.png" alt="ユーザーアイコン" width="30" height="30"></a>
                </li>
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
