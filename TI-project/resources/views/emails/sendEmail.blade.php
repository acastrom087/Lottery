<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="flex justify-center">
        <div class="text-center uppercase">
            <h1>{{$details ['tittle'] }}</h1>
        </div>
        <div class="py-2">
            <h3>{{$details ['greeting'] }}</h3>
        </div>
        <div class="py-2">
            <p>{{$details ['body'] }}</p>
            <p>Thanks for using our app!</p>
        </div>
    </div>
</body>
</html>