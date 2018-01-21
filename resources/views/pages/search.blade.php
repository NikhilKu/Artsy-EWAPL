@extends('layout.app')

@section('content')

<div class="background">
    <div class="container">
        @include('inc.messages')

        @if($searching == "cat")
        <div class="jumbotron">
            <h1 class="display-4">
                Category {{$searchQuery}}.
            </h1>
            @if(count($researches) <= 0)
            <p class="lead">No publications found.</p>
            @else
            <p class="lead">{{count($researches)}} publications found.</p>
            @endif
        </div>
        @elseif($searching == "title")
        <div class="jumbotron">
            <h1 class="display-4">

                You are searching "{{$searchQuery}}"
            </h1>
            @if(count($researches) <= 0)
            <p class="lead">No publications found.</p>
            @else
            <p class="lead">{{count($researches)}} publications found.</p>
            @endif
        </div>
        @endif

        <div class="row">
            @if(count($researches) > 0)
            @foreach($researches as $research)
            <!-- Card -->
            <div class="col-sm-6 col-md-4 col-lg-4 mt-4">
                <div class="card">
                    <div class="item">
                        <img class="card-img-top"
                             src="{{url('storage/cover_images/'.$research->cover_image)}}">
                    </div>
                    <div class="card-body bg-dark">
                        <h5 class="text-bold">
                            {{$research->title}} </h5>
                        <span class="badge badge-warning float-left">
                            {{$research->profile->school->abbreviation}}
                        </span>
                        <span class="badge badge-warning float-right">
                            {{$research->category->cat_name}}
                        </span>
                        <br/>
                        <div class="card-body-text">
                            <i class="fa fa-comment" aria-hidden="true"></i>
                            {{$count = DB::table('comment')->where('research_id', $research->id)->count()}}
                            &nbsp; &nbsp;&nbsp;&nbsp;
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                            @if(isset($research->profile))<a
                                href="{{url('/research')}}/{{$research->id}}"
                                style="color:white">{{$research->profile->name. ' ' .$research->profile->surname}}</a>
                            @endif

                            <div class="float-right"><i class="fa fa-clock-o"
                                                        aria-hidden="true"></i> {{$research->created_at->format('d-m-Y, H:i')}}
                            </div>
                        </div>
                        <br/>
                        <button type="button" class="btn btn-danger" data-toggle="modal"
                                data-target="#Modal{{$research->id}}">Summary
                        </button>
                        <a href="{{url('/research')}}/{{$research->id}}">
                            <button type="button" class="btn btn-primary float-right">More</button>
                        </a>
                        <br/>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="Modal{{$research->id}}" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{$research->title}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {{$research->summary}}
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                    Close
                                </button>
                                <a href="{{url('/research')}}/{{$research->id}}">
                                    <button type="button" class="btn btn-primary">More</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            @else
        </div>
        <div>
            @endif
        </div>
        @if(count($researches) > 0)
        <div class="float-right">
            {{ $researches->links() }}
        </div>
        <div class="clearfix"></div>
        @endif
    </div>
</div>
@endsection