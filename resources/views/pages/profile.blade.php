@extends('layout.app')

@section('content')
<div class="container">
    <div class="row my-2">

        <div class="col-lg-4 order-lg-1 text-center">
            <img class="mx-auto rounded-circle d-block" src="{{url('storage/pictures/'.$profile->picture)}}"
                 width="200" height="200">
            <br/>
            <h4>{{$profile->name}} {{$profile->surname}}</h4>
            @if(Auth::user() != NULL)
            @if($profile->user_id == Auth::user()->id)
            <a href="{{ url('/profile/'.$profile->user_id.'/edit') }}" class="btn btn-primary">Edit</a>
            @endif
            @endif
        </div>

        <div class="col-lg-8 order-lg-2">

            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a href="" data-target="#profile" data-toggle="tab" class="nav-link active">Profile</a>
                </li>
            </ul>

            <div class="tab-content py-4">
                <div class="row">
                    <div class="col-md-6">
                        <h6><b>Complete name:</b></h6>
                        <p>
                            {{$profile->name}} {{$profile->surname}}
                        </p>
                        @if($profile->birth != null)
                        <h6><b>Birthdate:</b></h6>
                        <p>
                            {{$profile->birth}}
                        </p>
                        @endif

                        <h6><b>Studentnumber:</b></h6>
                        <p>
                            {{$profile->student_id}}
                        </p>
                    </div>

                    <div class="col-md-6">
                        <h6><b>Role:</b></h6>
                        <p>
                            {{$profile->rank->name}}
                        </p>

                        <h6><b>School:</b></h6>
                        <p>
                            Hogeschool van Amsterdam
                        </p>
                        <h6><b>Account created at:</b></h6>
                        <p>
                            {{$profile->created_at->format("Y/m/d")}}
                        </p>

                    </div>
                </div>
            </div>

            @if($profile->biography != null)

            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a href="" data-target="#profile" data-toggle="tab" class="nav-link active">Biography</a>
                </li>
            </ul>

            <div class="tab-content py-4">
                <p>
                    {{$profile->biography}}
                </p>
            </div>
            @endif

            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a href="" data-target="#profile" data-toggle="tab" class="nav-link active">Skills</a>
                </li>
            </ul>

            <div class="tab-content py-4">
                <div class="col-md-6">
                    <a href="#" class="badge badge-dark badge-pill">html5</a>
                    <a href="#" class="badge badge-dark badge-pill">react</a>
                    <a href="#" class="badge badge-dark badge-pill">codeply</a>
                    <a href="#" class="badge badge-dark badge-pill">angularjs</a>
                    <a href="#" class="badge badge-dark badge-pill">css3</a>
                    <a href="#" class="badge badge-dark badge-pill">jquery</a>
                    <a href="#" class="badge badge-dark badge-pill">bootstrap</a>
                    <a href="#" class="badge badge-dark badge-pill">responsive-design</a>
                    <hr>
                    <span class="badge badge-success">{{
                            \App\Research::where('user_id',$id = $profile->user_id)->count()}}
                        Researches <i class="fa fa-bars" aria-hidden="true"></i></span>
                    <span class="badge badge-danger">
                        {{
                              $count = DB::table('comment')->where('user_id', $profile->user_id)->count() }}
                        Comments <i class="fa fa-comment" aria-hidden="true"></i></span>
                    <span class="badge badge-info"> @if ($profile->aantalLikes == 0)
                        0
                        @else
                        {{$profile->aantalLikes}} @endif Likes <i class="fa fa-thumbs-up"
                                                                  aria-hidden="true"></i></span>
                </div>
            </div>

            <div class="col-md-12">
                <h5 class="mt-2"><span class="fa fa-clock-o ion-clock float-right"></span> Recent Researches</h5>

                <table class="table table-sm table-hover table-striped">

                    <tbody>
                        @foreach($recentResearches as $research)
                        <tr>
                            <td>
                                <a class="table-link"
                                   href="{{url("research/".$research->id)}}"><strong>{{$research->title}}</strong></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <h5 class="mt-2" data-target="#favorites"><span class="fa fa-star float-right"></span> Favorite publications</h5> 
                <table class="table table-sm table-hover table-striped"> 
                    <tbody> 
                        @if($profile->favorite->isEmpty()) 
                        <tr> 
                            <td> 
                                No favorite publications. 
                            </td> 
                        </tr> 
                        @else 
                        @foreach($profile->favorite as $favResearch) 
                        <tr> 
                            <td> 
                                <a class="table-link" href="{{'public/research/' . $favResearch->research->id}}"> 
                                    <strong>{{$favResearch->research->title}}</strong> 
                                </a> 
                            </td> 
                        </tr> 
                        @endforeach 
                        @endif 
                    </tbody> 
                </table> 
            </div>
        </div>
    </div>
</div>

<br></br>

@endsection

