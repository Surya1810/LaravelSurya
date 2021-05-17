<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surya Media</title>
</head>
<body>
    <strong>New Message from</strong><br>
    <strong>Name : </strong>{{Auth::user()->name}}<br>
    <strong>Subject : </strong>Balasan untuk anda, {{$data['name']}}<br>
    <strong>Message : </strong>{{$data['message']}}<br>
</body>
</html>

