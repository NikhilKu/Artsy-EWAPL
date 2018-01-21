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
                <h4 class="card-title">Upload</h4>
                @include('inc.messages')
                {!! Form::open(['action' => 'ResearchController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data' ]) !!}
                <div class="form-group">
                    {{Form::label('title', 'Title')}}<font color="red">*</font>
                    {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}
                </div>
                <div class="form-group">
                    {{Form::label('summary', 'Summary')}}<font color="red">*</font>
                    {{Form::textarea('summary', '', ['class' => 'form-control','rows' => '5', 'placeholder' => 'Summary'])}}
                </div>
                <div class="form-group">
                    {{Form::label('content', 'Content')}}<font color="red">*</font>
                    {{Form::textarea('content', '', ['id' => 'article-ckeditor', 'class' => 'form-control ckeditor','rows' => '5', 'placeholder' => 'Content'])}}
                </div>
                <div class="form-group">
                    {{Form::label('youtube_url', 'Youtube URL')}}
                    {{Form::text('youtube_url', '', ['class' => 'form-control', 'placeholder' => 'Youtube URL'])}}                
                </div>
                <div class="form-group">
                    {{Form::label('finished', 'Project finished: ')}}
                    <select name="fin" size="1">
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
                {{Form::submit('Submit',['class' => 'btn btn-primary'])}}
                {!! Form::close() !!}
                <div>
                    <font color="red">* = required</font>
                </div>
            </div>
        </div>
    </div>
    <br/>
</div>
@endsection