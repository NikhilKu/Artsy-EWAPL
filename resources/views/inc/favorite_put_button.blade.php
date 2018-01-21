{{--A button that is used for favoriting researches--}}
<div id="favoriteButton">
{!!Form::open(['action' => 'FavoriteController@store','method' => 'POST']) !!}
{{Form::hidden('user_id', Auth::user()->id)}}
{{Form::hidden('research_id', $research->id)}}
{{Form::hidden('_method','PUT')}}
<input type="submit" class="fa btn btn-warning" value="&#xf006;"/>
{!!Form::close() !!}
</div>