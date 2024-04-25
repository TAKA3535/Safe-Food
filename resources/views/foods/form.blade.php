<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>申請画面</title>
</head>

<body>
    <p>申請画面</p>
    <form action={{ route('foods.application', ['id' => $id]) }} method="post">
        @csrf <!-- LaravelのCSRF保護トークン -->

        <label for="testText">テキスト入力:</label>
        <input type="text" id="testText" name="testText">
        <br>

        <button type="submit">申請する</button>
    </form>
</body>

</html>
