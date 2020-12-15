<header class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 bg-dark border-bottom shadow-sm">
    <p class="h5 my-0 me-md-auto text-white fw-normal">Music download</p>
    <nav class="my-2  my-md-0  me-md-3">
        <a class="p-2 text-white" href="{{ route('home') }}">Home</a>
    </nav>
</header>
<div class="header">
    <a class="nav-link text-dark" href="{{route('home')}}">
        <h1 class="text-center my-5">Youtube music downloader</h1>
    </a>

    <div class="bg-dark  py-2 ps-1 pe-2 mb-2">
        <form action="{{ route("search") }}" class="row mx-0" method="post">
            @csrf
            <div class="col-md-10 ps-1">
                <div class="search px-3">
                    <i class="fas fa-search"></i>
                    <label for="search"></label>
                    <input type="text" id="search" name="search" class="w-100 form-control"
                           placeholder="search for music">
                </div>
            </div>
            <button type="submit" class="btn btn-light col-md-2">Search</button>
        </form>
    </div>
</div>
