<ul class="navbar-nav mr-auto">
    <li class="nav-item active">
        <a class="nav-link" href="{{ url('/') }}">Home </a>
    </li>

    <!--Categories-->
    <li class="nav-item active dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
           aria-haspopup="true" aria-expanded="false">
            Categories
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            @foreach (\App\Category::all() as $category)
            <a class="dropdown-item" href="{{url("search?category=".$category->id)}}">{{$category->cat_name}}</a>
            @endforeach
        </div>
    </li>
    @guest
    @else
    <li class="nav-item active">
        <a class="nav-link" href="{{ url('/research/create') }}">Upload</a>
    </li>
    @endguest
    <form action="{{url("search")}}">
        <input class="search" type="text" name="search" placeholder="Search..">
    </form>
</ul>