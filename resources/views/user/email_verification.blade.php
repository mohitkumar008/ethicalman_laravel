<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h3>Welcome {{ $name }}</h3>
    <p><a href="{{ url('/verify_email/' . $rand_id . '') }}">Click here</a> to verify your email address.</p>
</body>

</html>
