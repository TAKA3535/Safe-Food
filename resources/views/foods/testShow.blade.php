<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <p>testShow</p>
    @foreach ($foods as $food)
        <div>{{ $food->info }}</div>
        <div>{{ $food->displayInfo }}</div>
    @endforeach
</body>

</html>
