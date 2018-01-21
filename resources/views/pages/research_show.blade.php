@extends('layout.app')

<script>$(document).on('click', '.social-share', function(event){
event.preventDefault();

var vPosition = Math.floor(($(window).width() - popupMeta.width) / 2),
hPosition = Math.floor(($(window).height() - popupMeta.height) / 2);

var url = $(this).attr('href');
var popup = window.open(url, 'Social Share',
'width='+popupMeta.width+',height='+popupMeta.height+
',left='+vpPsition+',top='+hPosition+
',location=0,menubar=0,toolbar=0,status=0,scrollbars=1,resizable=1');

if (popup) {
popup.focus();
return false;
}
});</script>

@section('content')
<div class="container-fluid">
    <div class="row content">
        <!--Short information about main research poster-->
        <div class="col-sm-3 sidenav">
            <div class="card">
                <div class="card-body">
                    <center>
                        <small>Posted by</small>
                        <h3 class="media-heading"> 
                            @if(isset($research->profile))
                            <a href="{{url('/profile')}}/{{$research->profile->user_id}}" style="color:black">
                                {{$research->profile->name. ' ' .$research->profile->surname}}
                            </a>
                            @endif
                        </h3>
                        <img src="{{url('storage/pictures/'.$research->profile->picture)}}" name="aboutme"
                             width="140" height="140" border="0" class="rounded-circle">
                        <br/>
                        <small>
                            {{($research->profile->school->abbreviation)}}
                            -
                            {{($research->profile->rank->name)}}
                        </small>
                        <br/>
                        <span class="badge badge-success">
                            {{$research::where('user_id',$id =$research->profile->user->id)->count()}}
                            Researches <i class="fa fa-bars" aria-hidden="true"></i>
                        </span>
                        <span class="badge badge-danger">
                            {{--get the count of comments from the database--}}
                            {{$count = DB::table('comment')->where('user_id', $research->profile->user->id)->count() }}
                            Comments <i class="fa fa-comment" aria-hidden="true"></i>
                        </span>
                        <span class="badge badge-info"> 
                            <!--get the right number of likes.-->
                            @if ($research->profile->aantalLikes == 0)
                            0
                            @else
                            {{$research->profile->aantalLikes}} 
                            @endif 
                            Likes <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                        </span>
                    </center>
                </div>
            </div>
            <!--Social media share-->
            <center>
                <a class ="fa fa-facebook-official btn btn-primary" href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::fullUrl()) }}"
                   target="_blank">
                </a>
                <a class="fa fa-twitter btn btn-info" href="https://twitter.com/intent/tweet?url={{ urlencode(Request::fullUrl()) }}"
                   target="_blank">
                </a>
                <a class="fa fa-google-plus-official btn btn-danger" href="https://plus.google.com/share?url={{ urlencode(Request::fullUrl()) }}"
                   target="_blank">
                </a>
            </center>
        </div>
        
        <!--Main part of the research page-->
        <div class="col-sm-9">
            <div class="card">
                <div class="card-body">
                    <!--project categories-->
                    @if(isset($research->cat_id))
                    <span class="badge badge-warning float-right" style="padding:10px">
                        {{$research->category->cat_name}}
                    </span>
                    <span class="badge badge-warning float-right" style="margin-right: 10px ; padding:10px">
                        @if(isset($research->finished))
                        Finished
                        @else
                        Not yet finished
                        @endif
                    </span>
                    @endif

                    <!--poster and timestamp-->
                    <h2>{{$research->title}}</h2>
                    <small> Posted by
                        @if(isset($research->profile))
                        <a href="{{url('/profile')}}/{{$research->profile->user_id}}" style="color:black">
                            {{$research->profile->name. ' ' .$research->profile->surname}}
                        </a>

                        @endif
                        <span class="fa fa-pencil"></span>
                        {{$research->created_at->format('d-m-Y, H:i')}}
                        <span class="fa fa-clock-o"></span>
                    </small>
                    
                    <!--favorite, delete and pdf buttons-->
                    @if(Auth::user() != NULL)
                    <div class="text-right">
                        <a href='{{url('research/'.$research->id.'/exportPDF')}}'>
                            <span  class="btn btn-primary"style="margin-bottom: 12px ;">
                                <div class="fa fa-file-pdf-o" aria-hidden="true"></div>
                            </span>
                        </a>
                        @if($research->profile->user_id == Auth::user()->profile->user_id)
                        {{--user is owner of research; show edit/delete, omit favorite--}}
                        <a href='{{url('research/'.$research->id.'/edit')}}'>
                           <span class="btn btn-primary">
                               <div class="fa fa-pencil" aria-hidden="true"></div>
                            </span>
                        </a>
                        <a data-toggle="modal" data-target="#Delete{{$research->id}}">
                            <span class="btn btn-danger">
                                <div class="fa fa-trash-o" aria-hidden="true"></div>
                            </span>
                        </a>
                        <!-- Modal for delete button -->
                        <div class="modal fade" id="Delete{{$research->id}}" tabindex="-1"
                             role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Delete research</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body text-left">
                                        Are you sure that you want to delete this research?
                                        "{{$research->title}}" ?
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close
                                            </button>
                                            {!!Form::open(['action' => ['ResearchController@destroy', $research->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                                            {{Form::hidden('_method', 'DELETE')}}
                                            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                            {!!Form::close()!!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                            {{--user is not owner of research; hide edit/delete, show (un)favorite--}}
                            @if(Auth::user()->profile->favorite->isEmpty())
                                {{--show favorite button--}}
                                @include('inc.favorite_put_button')
                            @else
                                @foreach(Auth::user()->profile->favorite as $entry)
                                    @if($entry->research->id == $research->id)
                                    {{--show unfavorite buntton--}}
                                    {!! Form::open(['action' => ['FavoriteController@destroy', $entry->id], 'method' => 'POST']) !!}
                                    {{--{{Form::hidden('id',$entry->id)}}--}}
                                    {{Form::hidden('_method','DELETE')}}
                                    <input type="submit" class="fa btn btn-warning" value="&#xf005;"/>
                                    {!! Form::close() !!}
                                        @break
                                    @endif
                                    @if($loop->last)
                                        {{--show favorite button--}}
                                        @include('inc.favorite_put_button')
                                    @endif
                                @endforeach
                            @endif
                        @endif
                    </div>
                    {{--Nothing should happen if the user has no account/profile--}}
                    @endif

                    <!--youtube embed if research links to a video-->
                    @if (isset($research->youtube_url))
                    <div class="text-left">
                        <iframe
                            width="630"
                            height="315"
                            src="http://www.youtube.com/embed/{{$research->youtube_url}}"
                            frameborder="0" allowfullscreen></iframe>
                    </div>
                    @endif
                    
                    <!--Full research context (styled text)-->
                    <p class="main-content-project">{!!$research->content!!}</p>
                    
                    <!--all comments come after this part (generated content)-->
                    <hr>
                    @foreach($research->comments as $comment)

                    <div class="row">
                        <div class="col-sm-2 col-md-2 col-lg-2 text-left">
                            <img src="{{url('storage/pictures/'.$comment->profile->picture)}}" width="100"
                                 height="100" border="0" alt="Avatar"/>
                        </div>
                        <div class="col-sm-2 col-md-8 col-lg-4 text-left">
                            <h4>{{$comment->profile->name."  ".$comment->profile->surname }}</h4>
                            <small>{{$comment->profile->school->abbreviation}} - Student</small>
                            <br/>
                            <span class="badge badge-success">
                                {{$research::where('user_id',$id =$comment->profile->user->id)->count()}} Researches 
                                <i class="fa fa-bars" aria-hidden="true"></i>
                            </span>
                            <span class="badge badge-danger">  
                                {{$comment::where('user_id',$id =$comment->profile->user->id)->count()}} Comments
                                <i class="fa fa-comment" aria-hidden="true"></i>
                            </span>
                            <span class="badge badge-info">
                                @if ($comment->profile->aantalLikes == 0)
                                0
                                @else
                                {{$comment->profile->aantalLikes}} 
                                @endif 
                                Likes <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="col-sm-2 col-md-8 col-lg-6 text-right">
                            <small>{{$comment->created_at->format('d-m-Y, H:i')}}</small>
                            <br/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-9  col-lg-12">
                            <div class="comment">
                                <br/>{{$comment->content}}
                            </div>
                        </div>
                    </div>
                    <hr>
                    @endforeach
                    
                    @guest
                    <!--cannot comment as user!-->
                    @else
                    <!--comment box-->
                    <h4>Leave a Comment:</h4>
                    @include('inc.messages')
                    {!! Form::open(['action' => ['CommentController@store'], 'method' => 'POST']) !!}


                    <div class="form-group">
                        {{Form::label('content', 'Content')}}
                        {{Form::textarea('content', '', ['id' => 'article-ckeditor', 'class' => 'form-control ckeditor','rows' => '5', 'placeholder' => 'Content'])}}
                    </div>


                    {{Form::hidden('id', $research->id)}}
                    {{Form::submit('Submit',['class' => 'btn btn-primary'])}}
                    {!! Form::close() !!}
                    @endguest
                </div>
            </div>
        </div>
    </div>
</div>
@endsection