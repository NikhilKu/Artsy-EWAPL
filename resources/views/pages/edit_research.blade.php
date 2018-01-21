@extends('layout.app')

@section('content')
<script src="../../../vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script src="../../../vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
<script>
    $('textarea').ckeditor();
//         $('.textarea').ckeditor(); // if class is prefered.
</script>
<div id="achtergrondupload">
    <div class="container ">
        <br/>
        <div class="card text-left"  id="uploadscreen">
            <div class="card-body">
                <h4 class="card-title">Edit research</h4>
                @include('inc.messages')
                {!! Form::open(['action' => ['ResearchController@update', $research->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                <div class="form-group">
                    {{Form::label('title', 'Title')}}
                    {{Form::text('title', $research->title, ['class' => 'form-control', 'placeholder' => 'Title'])}}
                </div>
                <div class="form-group">
                    {{Form::label('summary', 'Summary')}}
                    {{Form::textarea('summary', $research->summary, ['class' => 'form-control','rows' => '5', 'placeholder' => 'Summary'])}}
                </div>
                <div class="form-group">
                    {{Form::label('content', 'Content')}}
                    {{Form::textarea('content', $research->content, ['id' => 'article-ckeditor', 'class' => 'form-control ckeditor','rows' => '5', 'placeholder' => 'Content'])}}
                </div>
                <div class="form-group">
                    {{Form::label('youtube_url', 'Youtube URL')}}
                    {{Form::text('youtube_url', $research->youtube_url, ['class' => 'form-control', 'placeholder' => 'youtube URL'])}}                
                </div>
                <div class="form-group">
                    {{Form::label('fin', 'Project finished: ')}}
                    <select name="category_id" size="0">
                        <option value="0">Yes</option>
                        <option value="1">Not yet</option>
                    </select>
                </div>
                <div class="form-group">
                    {{Form::label('Categorie', 'Category: ')}}
                    <select name="category_id" size="1">
                        @foreach($categorys as $category)
                        <option value="{{$category->id}}">{{$category->cat_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    {{Form::file('cover_image')}};
                </div>
                {{Form::hidden('_method','PUT')}}
                {{Form::submit('Save Changes',['class' => 'btn btn-primary'])}}
                {!! Form::close() !!}
                <div>
                    <font color="red">* = required</font>
                </div>
            </div>
        </div>
    </div>
    <br>
</div>
@endsection