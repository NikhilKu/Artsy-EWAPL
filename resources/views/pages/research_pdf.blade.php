<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>PDF</title>
    </head>
    <body>
        <h2> Titel: {{$research->title}}</h2> 
        <h3> Posted by: {{$research->profile->name. ' ' .$research->profile->surname}}</h3>
        <h4> Summary: {{$research->summary}}</h4> 
        <div> Content: {!! $research->content!!} </div>
        <img src="{{url('/storage/cover_images/'.$research->cover_image)}}"/>
    </body>
</html>