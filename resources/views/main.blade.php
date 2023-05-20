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

    <!-- @vite('resources/js/app.js') -->
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
            var contents = document.getElementsByClassName("sort");
            // var contents = document.querySelectorAll("#wraptest");
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


    <script>
        function showCategory(category_id) {
            var selectedValue = category_id;
            var contents = document.getElementsByClassName("sort");
            for (var i = 0; i < contents.length; i++) {
                var content = contents[i];
                if (content.id == selectedValue) {
                    content.style.display = "flex";
                } else {
                    content.style.display = "none";
                }
            }
            var url = new URL(window.location.href);
            url.searchParams.set('category_id', selectedValue);
            window.history.pushState(null, '', url);
        }

        function updateSortLinks(sortType) {
            var links = document.getElementsByClassName("sort-link");
            for (var i = 0; i < links.length; i++) {
                var link = links[i];
                var href = link.getAttribute("data-href");
                href = href.replace(/(asc|desc)/, sortType);
                link.setAttribute("href", href);
            }
        }

        // $(".scroll-top").hide();

        // $(window).scroll(function() {
        //     if ($(this).scrollTop() > 100) { //スクロールするピクセル数
        //         $(".scroll-top").fadeIn();
        //     } else {
        //         $(".scroll-top").fadeOut();
        //     }
        // });

        // $(".scroll-top").click(function() {
        //     $("html, body").animate({
        //         scrollTop: 0
        //     }, ページトップに戻る秒数);
        //     return false;
        // });

        $(document).ready(function() {
            $(window).scroll(function() {
                if ($(this).scrollTop() > 50) {
                    $('.scroll-top-btn').addClass('active');
                } else {
                    $('.scroll-top-btn').removeClass('active');
                }
            });
            $('.scroll-top-btn').click(function() {
                $('html, body').animate({
                    scrollTop: 0
                }, 500);
                return false;
            });
        });
    </script>

    <!-- <script>
        function showCategory(selectElement) {
            var selectedValue = selectElement.value;
            var contents = document.getElementsByClassName("sort");
            for (var i = 0; i < contents.length; i++) {
                var content = contents[i];
                if (content.id == selectedValue) {
                    content.style.display = "flex";
                } else {
                    content.style.display = "none";
                }
            }
            var url = new URL(window.location.href);
            url.searchParams.set('category_id', selectedValue);
            window.history.pushState(null, '', url);

            // クッキーにカテゴリーと並び順を保存
            document.cookie = "selectedCategory=" + selectedValue;
            document.cookie = "sortOrder=" + document.getElementById(selectedValue).getAttribute('data-sort');
        }

        // ページ読み込み時にクッキーを参照して初期表示を設定
        window.onload = function() {
            var categoryCookie = document.cookie.replace(/(?:(?:^|.*;\s*)selectedCategory\s*\=\s*([^;]*).*$)|^.*$/,
                "$1");
            var sortOrderCookie = document.cookie.replace(/(?:(?:^|.*;\s*)sortOrder\s*\=\s*([^;]*).*$)|^.*$/, "$1");

            if (categoryCookie && sortOrderCookie) {
                var selectElement = document.getElementsByName("category_id")[0];
                selectElement.value = categoryCookie;
                var contents = document.getElementsByClassName("sort");
                for (var i = 0; i < contents.length; i++) {
                    var content = contents[i];
                    if (content.id == categoryCookie) {
                        content.style.display = "flex";
                    } else {
                        content.style.display = "none";
                    }
                }
                var selectedSort = document.getElementById(categoryCookie + sortOrderCookie);
                if (selectedSort) {
                    selectedSort.style.display = "block";
                }
            }
        }
    </script> -->

    <!-- 昇順降順ソート切り替え -->
    {{-- <script>
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
    </script> --}}

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
        const testLink = document.getElementById("test-link");
        testLink.addEventListener("click", function(event) {
            event.preventDefault(); // デフォルトのリンク挙動をキャンセル
            testLink.style.color = "red"; // 文字色を変更
            return false;
        });
    </script>

    <script>
        function changeBackgroundColor(element) {
            var url = element.href;
            var category4Url = "http://localhost/main?category=full";
            var mainUrl = "http://localhost/main";

            if (url === category4Url || url === mainUrl) {
                element.style.backgroundColor = "#F0F8FF"; // 背景色を変更
            }
        }
    </script>

    {{-- <script>
        // URLから現在のクエリ文字列を取得
        var currentUrl = window.location.href;
        var queryIndex = currentUrl.indexOf('?');
        var currentQueryString = queryIndex !== -1 ? currentUrl.substring(queryIndex + 1) : '';

        // クエリ文字列からカテゴリの値を取得
        var selectedCategory = '';
        if (currentQueryString) {
            var queryParts = currentQueryString.split('&');
            for (var i = 0; i < queryParts.length; i++) {
                var queryParam = queryParts[i].split('=');
                if (queryParam[0] === 'category') {
                    selectedCategory = queryParam[1];
                    break;
                }
            }
        }

        // 選択されたボタンにselectedクラスを追加
        var buttons = document.getElementsByTagName('button');
        for (var i = 0; i < buttons.length; i++) {
            var button = buttons[i];
            var buttonUrl = button.getAttribute('onclick').split('=')[0].replace("location.href'", "");
            if (buttonUrl === '/main' && !selectedCategory) {
                button.classList.add('selected');
            } else if (buttonUrl === '/main?category=' + selectedCategory) {
                button.classList.add('selected');
            }
        }
    </script> --}}

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
            {{-- <div style="display: flex;">
                <select name="category_id" onchange="showCategory(this)">
                    <option value="full">全ジャンル</option>
                    <option value="0">冷蔵</option>
                    <option value="1">冷凍</option>
                    <option value="2">常温 </option>
                    <option value="3">賞味期限切れ </option>
                </select>

                <input type="radio" name="category_id" onchange="showCategory(this)" value="full">全ジャンル
                <input type="radio" name="category_id" onchange="showCategory(this)" value="0">冷蔵
                <input type="radio" name="category_id" onchange="showCategory(this)" value="1">冷凍
                <input type="radio" name="category_id" onchange="showCategory(this)" value="2">常温
                <input type="radio" name="category_id" onchange="showCategory(this)" value="3">賞味期限切れ --}}

            <!-- <select>
                <option value="">並び替え</option>
                <option value="">昇順</option>
                <option value="food">降順</option>
            </select> -->

            <!-- {{-- --}} で囲んで強制コメントアウトにしている  -->
            {{-- <a href="?sort_order={{ $sortOrder === 'asc' ? 'desc' : 'asc' }}">limit_date</a> --}}
            <!-- <a href="?sort_order={{ 'asc' ? 'desc' : 'asc' }}">limit</a> -->

            <!-- <div class="sort" id="full" style="display: none;">
                    <a href="#" class="sort-link" data-href="{{ url('/main?sort=asc') }}" onclick="updateSortLinks('asc'); return false;">昇順</a>
                    <a href="#" class="sort-link" data-href="{{ url('/main?sort=desc') }}" onclick="updateSortLinks('desc'); return false;">降順</a>
                </div>
                <div class="sort" id="0" style="display: none;">
                    <a href="#" class="sort-link" data-href="{{ url('/main?sort=asc0') }}" onclick="updateSortLinks('asc0'); return false;">昇順</a>
                    <a href="#" class="sort-link" data-href="{{ url('/main?sort=desc0') }}" onclick="updateSortLinks('desc0'); return false;">降順</a>
                </div>
                <div class="sort" id="1" style="display: none;">
                    <a href="#" class="sort-link" data-href="{{ url('/main?sort=asc1') }}" onclick="updateSortLinks('asc1'); return false;">昇順</a>
                    <a href="#" class="sort-link" data-href="{{ url('/main?sort=desc1') }}" onclick="updateSortLinks('desc1'); return false;">降順</a>
                </div>
                <div class="sort" id="2" style="display: none;">
                    <a href="#" class="sort-link" data-href="{{ url('/main?sort=asc2') }}" onclick="updateSortLinks('asc2'); return false;">昇順</a>
                    <a href="#" class="sort-link" data-href="{{ url('/main?sort=desc2') }}" onclick="updateSortLinks('desc2');return false;">昇順</a>
                </div> -->


            <div class="sort" id="full">
                <a href="{{ url('/main?sort=asc') }}">昇順</a>
                <a href="{{ url('/main?sort=desc') }}">降順</a>
            </div>
            <div class="sort" id="0" style="display: none;">
                <a href="{{ url('/main?sort=asc0') }}">昇順</a>
                <a href="{{ url('/main?sort=desc0') }}">降順</a>
            </div>
            <div class="sort" id="1" style="display: none;">
                <a href="{{ url('/main?sort=asc1') }}">昇順</a>
                <a href="{{ url('/main?sort=desc1') }}">降順</a>
            </div>
            <div class="sort" id="2" style="display: none;">
                <a href="{{ url('/main?sort=asc2') }}">昇順</a>
                <a href="{{ url('/main?sort=desc2') }}">降順</a>
            </div>

            <div class="sort" id="full" style="display: none;">
                <button type="button" onclick="location.href='/main?sort=asc'">昇順</button>
                <button type="button" onclick="location.href='/main?sort=desc'">降順</button>
            </div>
            <!-- <div class="sort" id="0" style="display: none;">
                    <button type="button" onclick="location.href='{{ url('/main?sort=asc0') }}'">昇順</button>
                    <button type="button" onclick="location.href='{{ url('/main?sort=desc0') }}'">降順</button>
                </div>
                <div class="sort" id="1" style="display: none;">
                    <button type="button" onclick="location.href='{{ url('/main?sort=asc1') }}'">昇順</button>
                    <button type="button" onclick="location.href='{{ url('/main?sort=desc1') }}'">降順</button>
                </div>
                <div class="sort" id="2" style="display: none;">
                <button type="button" onclick="location.href='{{ url('/main?sort=asc2') }}'">昇順</button>
                <button type="button" onclick="location.href='{{ url('/main?sort=desc2') }}'">降順</button>
                </div>  -->

            {{-- <button id="sort-button" onclick="toggleSort()">賞味期限短い順</button> --}}
            </div>
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
                <li><a href="/profile"><img src="kkrn_icon_user_8.png" alt="ユーザーアイコン" width="30"
                            height="30"></a></li>
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
            <!-- <div style="display: flex; flex-direction: row;">
                <div style="margin-right: 20px;">
                    <ul>
                        <ul>登録した食品{{ $count }}件(賞味期限切れ除く)</ul>
                        <ul>冷蔵食品{{ $count1 }}件</ul>
                        <ul>冷凍食品{{ $count2 }}件</ul>
                        <ul>常温食品{{ $count3 }}件</ul>
                        <ul>賞味期限切れの食品{{ $count4 }}件</ul>
                    </ul>
                </div>
            </div> -->
            <table class="tableCount">
                <tr>
                    <th class="borderCount" tabindex="0">
                        <button type="button" onclick="location.href='/main'"
                            class="{{ Request::url() == url('/main') ? 'green' : '' }}">
                            登録した全ての食品(賞味期限切れ除く)
                        </button>
                    </th>
                    <th class="borderCount">
                        <button type="button" onclick="location.href='/main?category=1'"
                            class="{{ Request::fullUrl() == url('/main?category=1') ? 'blue' : '' }}">
                            冷蔵食品(賞味期限切れ除く)
                        </button>
                    </th>
                    <th class="borderCount">
                        <button type="button" onclick="location.href='/main?category=2'"
                            class="{{ Request::fullUrl() == url('/main?category=2') ? 'blue2' : '' }}">
                            冷凍食品(賞味期限切れ除く)
                        </button>
                    </th>
                    <th class="borderCount">
                        <button type="button" onclick="location.href='/main?category=3'"
                            class="{{ Request::fullUrl() == url('/main?category=3') ? 'blown' : '' }}">
                            常温食品(賞味期限切れ除く)
                        </button>
                    </th>
                    <th class="borderCount">
                        <button type="button" onclick="location.href='/main?category=4'"
                            class="{{ Request::fullUrl() == url('/main?category=4') ? 'red' : '' }}">
                            賞味期限切れの食品
                        </button>
                    </th>
                    <th class="borderCount">
                        <button type="button" onclick="location.href='/main?category=5'"
                            class="{{ Request::fullUrl() == url('/main?category=5') ? 'green2' : '' }}">
                            通知日が本日の食品
                        </button>
                    </th>
                </tr>

                <tr>
                    <td class="borderCount">{{ $count }}件</td>
                    <td class="borderCount">{{ $count1 }}件</td>
                    <td class="borderCount">{{ $count2 }}件</td>
                    <td class="borderCount">{{ $count3 }}件</td>
                    <td class="borderCount">{{ $count4 }}件</td>
                    <td class="borderCount">{{ $count5 }}件</td>
                </tr>
                <br>
            </table><br>

            <div class="centerSort">
                    @if (preg_match('/^\/main(\?sort=.+)?$/i', url()->full()))
                        <button type="button" onclick="location.href='/main?sort=asc'">賞味期限が短い順</button>
                        <button type="button" onclick="location.href='/main?sort=desc'">賞味期限が長い順</button>
                    @endif
                    @if (preg_match('/^\/main\?category=1(&sort=.+)?$/i', url()->full()))
                        <button type="button" onclick="location.href='/main?category=1&sort=asc'">賞味期限が短い順1</button>
                        <button type="button" onclick="location.href='/main?category=1&sort=desc'">賞味期限が長い順1</button>
                    @endif
                @if (request()->is('main?category=2'))
                    <button type="button" onclick="location.href='/main?category=2'">賞味期限が短い順2 </button>
                    <button type="button" onclick="location.href='/main?category=2'">賞味期限が長い順2 </button>
                @endif
                @if (request()->is('main?category=3'))
                    <button type="button" onclick="location.href='/main?category=3'">賞味期限が短い順 </button>
                    <button type="button" onclick="location.href='/main?category=3'">賞味期限が長い順 </button>
                @endif
                @if (request()->is('main?category=4'))
                    <button type="button" onclick="location.href='/main?category=4'">賞味期限が短い順 </button>
                    <button type="button" onclick="location.href='/main?category=4'">賞味期限が長い順 </button>
                @endif
            </div>

            <div>
                @if (count($foodData) > 0)
                    <div id="full" class="wraptest sort">
                        @foreach ($foodData as $data)
                            <div class="item {{ $data->class }}">
                                <a href="/foods/update/{{ $data->id }}"><img class="size"
                                        src="{{ $data->image }}" alt="商品画像"></a>

                                <li>商品情報：{{ $data->info }}</li>
                                <li>賞味期限日：{{ $data->limit_date }}</li>
                                <li>賞味期限日まで残り{{ $remainingDays[$data->id] }}日</li>
                                <li>通知日：{{ $data->alert }}</li>
                            </div>
                        @endforeach
                    </div>

                    <div id="0" class="wraptest sort" style="display: none;">
                        @foreach ($foods1 as $data)
                            <div class="item {{ $data->class }}">
                                <a href="/foods/update/{{ $data->id }}"><img class="size"
                                        src="{{ $data->image }}" alt="商品画像"></a>
                                <li>商品情報：{{ $data->info }}</li>
                                <li>賞味期限日：{{ $data->limit_date }}</li>
                                <li>賞味期限日まで残り{{ $remainingDays[$data->id] }}日</li>
                                <li>通知日：{{ $data->alert }}</li>
                            </div>
                        @endforeach
                    </div>
                    <div id="1" class="wraptest sort" style="display: none;">
                        @foreach ($foods2 as $data)
                            <div class="item {{ $data->class }}">
                                <a href="/foods/update/{{ $data->id }}"><img class="size"
                                        src="{{ $data->image }}" alt="商品画像"></a>
                                <li>商品情報：{{ $data->info }}</li>
                                <li>賞味期限日：{{ $data->limit_date }}</li>
                                <li>賞味期限日まで残り{{ $remainingDays[$data->id] }}日</li>
                                <li>通知日：{{ $data->alert }}</li>
                            </div>
                        @endforeach
                    </div>
                    <div id="2" class="wraptest sort" style="display: none;">
                        @foreach ($foods3 as $data)
                            <div class="item {{ $data->class }}">
                                <a href="/foods/update/{{ $data->id }}"><img class="size"
                                        src="{{ $data->image }}" alt="商品画像"></a>
                                <li>商品情報：{{ $data->info }}</li>
                                <li>賞味期限日：{{ $data->limit_date }}</li>
                                <li>賞味期限日まで残り{{ $remainingDays[$data->id] }}日</li>
                                <li>通知日：{{ $data->alert }}</li>
                            </div>
                        @endforeach
                    </div>

                    <div id="3" class="wraptest sort" style="display: none;">
                        @foreach ($foods4 as $data)
                            <div class="item {{ $data->class }}">
                                <a href="/foods/update/{{ $data->id }}"><img class="size"
                                        src="{{ $data->image }}" alt="商品画像"></a>
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
        <!-- @foreach ($foods3 as $data)
<img src="{{ Storage::url($data->image) }}" alt="ttt">
    <img src="{{ asset('/storage/' . $data->image) }}" alt="test">
@endforeach -->



        <!-- @foreach ($foodData as $data)
<div class="item {{ $data->class }}">
        <a href="/foods/update/{{ $data->id }}"><img class="size" src="{{ $data->image }}" alt="商品画像"></a>

        <li>商品情報：{{ $data->info }}</li>
        <li>賞味期限日：{{ $data->limit_date }}</li>
        <li>通知日：{{ $data->alert }}</li>
    </div>
@endforeach -->

        {{-- <div class="scroll-top">
        <a href="#">↑</a>
    </div> --}}

        <a href="#" class="scroll-top-btn">↑</a>
    @else
        <p class="centered-text">現在商品の登録はありません。</p>
        @endif
        {{-- <p>通知日を{{ date('Y-m-d') }}にした食品は{{ $count }}件あります。</p> --}}

</body>

</html>
