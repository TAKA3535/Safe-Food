<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>SafeFood</title>
</head>

<body>
    <!-- メール本文 -->
    <p>おはようございます。</p>
    <p>通知日のお知らせです。<p>
    <p>{{ date('Y-m-d') }}に指定した食品は{{ $count }}件あります。</p>
    <a href="http://localhost/main?category=5">詳細はこちら</a>
</body>

</html>
