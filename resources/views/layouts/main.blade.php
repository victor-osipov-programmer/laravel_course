<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <header class="container">
        <div class="row">


            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">Navbar</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav">
                            <a class="nav-link" href="{{route('main.index')}}">Main</a>
                            <a class="nav-link" href="{{route('post.index')}}">Posts</a>
                            <a class="nav-link" href="{{route('about.index')}}">About</a>
                            <a class="nav-link" href="{{route('contact.index')}}">Contacts</a>
                            
                            @can('view', auth()->user())
                                <a class="nav-link" href="{{route('admin.post.index')}}">Admin Panel</a>
                            @endcan
                        </div>
                    </div>
                </div>
            </nav>
        </div>

    </header>

    @yield('content')
</body>

</html>