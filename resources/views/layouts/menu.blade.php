<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
      {{-- <a class="navbar-brand" href="#">Navbar scroll</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button> --}}
      <div class="collapse navbar-collapse" id="navbarScroll">
        <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ url('admin') }}">Admin</a>
          </li>
          {{-- <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li> --}}
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Categories
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="{{ route('categories.create') }}">Add Category</a></li>
              <li><a class="dropdown-item" href="{{ route('categories.index') }}">Categories</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Comics
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="{{ route('comics.create') }}">Add Comic</a></li>
              <li><a class="dropdown-item" href="{{ route('comics.index') }}">Comics</a></li>
            </ul>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Books
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="{{ route('books.create') }}">Add Book</a></li>
              <li><a class="dropdown-item" href="{{ route('books.index') }}">Books</a></li>
            </ul>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Chapters
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="{{ route('chapters.create') }}">Add Chapter</a></li>
              <li><a class="dropdown-item" href="{{ route('chapters.index') }}">Chapters</a></li>
            </ul>
          </li>
        </ul>
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-primary" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>