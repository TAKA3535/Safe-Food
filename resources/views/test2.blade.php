<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>ハンバーガーメニュー作成</title>
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    @vite(['resources/sass/app.scss', 'resources/js/test.js'])
    <!-- @vite( 'resources/js/app.js') -->
    <link rel="stylesheet" href="/css/test.css">
</head>

<body>
    <header>
        <div>Title</div>
        <nav class="nav">
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Menu</a></li>
                <li><a href="#">News</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
        <button type="button" id="navbtn"></button>
    </header>
</body>

</html>