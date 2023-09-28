<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <!-- Tailwind CSS-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css','resources/js/app.js'])

    <title>@yield('meta_title')</title>
</head>

<body style="font-family: Open Sans, sans-serif">
<!-- Responsive navbar -->
<section class="max-w-6xl mx-auto mt-1 lg:mt-20">
    <nav class="md:flex md:justify-between md:items-center bg-gray-200 py-6 px-5 rounded-full">
        <div>
            <p class="text-xl font-bold"><a href="{{route('home')}}"> BRAINDUMP</a></p>
        </div>

        <div class="mt-8 md:mt-0">
            <a href="{{route('home')}}" class="text-xs font-bold uppercase"> Blog</a>

            @if(Auth::user())
                <a href="{{route('admin')}}" class="text-xs font-bold uppercase ml-3"> Dashboard</a>
                <a class="bg-blue-500 ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-5" href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
                       {{ __('Logout') }}
                </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
            @endif

            @if(empty(Auth::user()))
                <a href="{{ route('login') }}" class="bg-blue-500 ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-5"> Login </a>
            @endif
        </div>
    </nav>

    @yield('header')


    <!-- Page content -->
    <div class="container mt-5">
        <div class="row">

            @yield('content')
            @yield('comments')
        </div>
    </div>



    <!-- Footer-->
    <footer class="py-5">
            <p class="text-center text-xs">Hannah-Marie Hermans - Laravel Blog</p>
    </footer>
</section>
    <!-- from node_modules -->
    <script src="../../../node_modules/@material-tailwind/html/scripts/collapse.js"></script>
    <!-- from cdn -->
    <script src="https://unpkg.com/@material-tailwind/html@latest/scripts/collapse.js"></script>

    <script src="../../../node_modules/flowbite/dist/flowbite.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.js"></script>

</body>
</html>
