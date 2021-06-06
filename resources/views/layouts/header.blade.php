<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="/">BDT BLOG</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Category</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Tags</a>
          </li>
        </ul>
        <ul class="navbar-nav">
          @auth
            <li class="nav-item">
              <form action="{{route('logout')}}" method="POST">
                @csrf
                <button class="nav-link btn">LOGOUT</button>
              </form>
            </li>
          @endauth
            @guest
            <li class="nav-item">
                <a href="{{route('login')}}" class="nav-link">Login</a>
            </li>
            <li class="nav-item">
                <a href="{{route('register')}}" class="nav-link">Register</a>
            </li>
            @endguest
        </ul>
        <form class="d-flex" method="GET" action="{{route('blog.search')}}">
          <input class="form-control me-2" type="search" placeholder="Search" name="search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>