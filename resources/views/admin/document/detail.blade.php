<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <h2><b>{{$file->title}}</b></h2>
    <h4>{{$file->description}}</h4>
    <p>
        <iframe src="{{url('storage/document/'.$file->file)}}"></iframe>
    </p>
</body>
</html>

