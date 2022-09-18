<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>A new post has been published</h1>
    <div>Title: {{$new_post->title}}</div>
    <br>
    <div>Click 
        <a href="{{ route('admin.posts.show', ['post' => $new_post->id]) }}">here</a>
        to view more information</div>
</body>
</html>