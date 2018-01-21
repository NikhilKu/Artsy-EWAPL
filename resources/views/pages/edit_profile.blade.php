@extends('layout.app')

@section('content')
<div class="container">
    @include('inc.messages')
    {!! Form::open(['action' => ['ProfileController@update', $profile->user_id],'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="row">
        <div class="mx-auto">
            <img src="{{url('storage/pictures/'.$profile->picture)}}" width="200" height="200" class="mx-auto rounded-circle d-block" alt="avatar"/>
            <div class="form-group">
                {{Form::file('picture')}};
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 order-lg-2">
            <div class="tab-content py-4">
                <div class="tab-pane active" id="profile">
                    <div class="row">
                        <div class="col-md-6">
                            {{Form::label('name', 'Name', ['class' => 'h6'])}}
                            {{Form::text('name', $profile->name, ['class' => 'form-control'])}}
                            {{Form::label('surname', 'Surname', ['class' => 'h6'])}}
                            {{Form::text('surname', $profile->surname, ['class' => 'form-control'])}}
                            {{Form::label('birth', 'Birthdate', ['class' => 'h6'])}}
                            {{Form::date('birth', $profile->birth, ['class' => 'form-control'])}}
                            {{Form::label('school', 'School', ['class' => 'h6'])}}
                            {{-- School selection generation --}}
                            <select name="school" id="schoolSelection" class="form-control">
                                @foreach($schools as $school)
                                @if ($school->id == $profile->school_id)
                                <option value="{{$school->id}}" selected="selected">{{$school->name}}</option>
                                @else
                                <option value="{{$school->id}}">{{$school->name}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            {{Form::label('biography', 'Biography', ['class' => 'h6'])}}
                            {{Form::textarea('biography', $profile->biography, ['class' => 'form-control'])}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Submit',['class' => 'btn btn-primary mx-auto'])}}
    </div>
    {!! Form::close() !!}
</div>
@endsection