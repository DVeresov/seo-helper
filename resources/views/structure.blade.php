<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Structure</title>
</head>
<body>
@foreach($structure as $page)
    <div>
        <p>id: {{$page['id']}}</p>
        <p>title: {{$page['pagetitle']}}</p>
        <p>parent: {{$page['parent']}}</p>
    </div>
@endforeach
</body>
</html>
