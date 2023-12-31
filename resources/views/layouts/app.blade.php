<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Bebras">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Bebras')</title>

    <!-- Icon -->
    <link rel="apple-touch-icon" sizes="180x180" href="/icon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/icon/favicon-16x16.png">
    <link rel="manifest" href="/icon/site.webmanifest">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('js/share.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    @yield('link')
    <style>
        .dmenu a {
            width: 250px;
        }
    </style>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm sticky-top">
            <div class="container">
                <img class="mx-auto d-block mb-0"
                    src="https://github.com/Estomihi100103/HelpDesk-Applicaion/assets/89466828/e1c6b6d5-33a6-4f84-86f0-058f812c3e32"
                    alt="Your Company" height="40">
                <a class="navbar-brand mr-5" href="{{ route('home') }}">
                    <b class="px-3 text-danger" style="font-weight: bold; font-style: italic;">Bebras Help Desk</b>
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @guest
                        @else
                            <li class="nav-item ml-4">
                                <a href="{{ route('home') }}"
                                    class="{{ request()->route()->named('home')? 'text-danger': 'text-dark' }} "><i
                                        class="bi bi-house-door" style="font-size: 1.5rem;"></i></a>
                            </li>

                            @can('isAdmin')
                                <x-admin-answers />
                                <x-admin-questions />
                                <x-admin-comments />
                                <x-admin-topics />
                                <x-admin-users />
                                <x-admin-faqs />
                            @else
                                <li class="nav-item ml-4">
                                    <a href="{{ route('answer.index') }}"
                                        class="{{ request()->route()->named('answer.index') ||request()->route()->named('question.show')? 'text-danger': 'text-dark' }}"><i
                                            class="bi bi-pencil-square" style="font-size: 1.5rem;"></i></a>
                                </li>
                                <li class="nav-item ml-4 mt-1">
                                    <select name="livesearch" class="form-control livesearch" style="width: 500px;"></select>
                                </li>
                            @endcan

                        @endguest

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link ml-4" href="javascript: void(0)" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <div class="q-box qu-borderRadius--circle qu-borderAll qu-borderColor--darken Photo___StyledBox-sc-1x7c6d3-0"
                                    style="box-sizing: border-box; position: relative; width: 30px; height: 30px; overflow: hidden;">
                                    <img src="{{ (strpos(Auth::user()->avatar, 'https') === 0) ? Auth::user()->avatar : asset('img/' . Auth::user()->avatar) }}"
                                        alt="Profile Image" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                                </div>
                            </a>
                            
                                <div class="dropdown-menu dropdown-menu-right dmenu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('profile.index', Auth::user()->name_slug) }}" class="text-dark">
                                        <div class="q-box qu-borderRadius--circle qu-borderAll qu-borderColor--darken Photo___StyledBox-sc-1x7c6d3-0" style="box-sizing: border-box; position: relative; width: 40px; height: 40px; overflow: hidden; margin-right: 8px;">
                                            <img src="{{ (strpos(Auth::user()->avatar, 'https') === 0) ? Auth::user()->avatar : asset('img/' . Auth::user()->avatar) }}" alt="Profile Image" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                                        </div>
                                        <b style="font-size: 15px">{{ Auth::user()->name }} <i class="bi bi-chevron-right ml-2"></i></b>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('stats.index') }}"><i class="bi bi-bar-chart mr-2"></i>Stats</a>
                                    <a class="dropdown-item" href="{{ route('content.index') }}"><i class="bi bi-journals mr-2"></i>Your Content</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('settings.index') }}">Settings</a>
                                    @if (Auth::user()->role != 'admin')
                                        <a class="dropdown-item" href="{{ route('faq.index') }}">FAQ</a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>

                            <button class="btn btn-sm btn-outline-danger ml-2 " data-toggle="modal"
                                data-target="#add-questionModal">Tambah Pertanyaan</button>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>


        <main class="py-4">
            @guest
            @else
                <x-question />
            @endguest

            @yield('content')
        </main>
    </div>

    {{-- <script>
        let $q = $('.livesearch');

        $q.select2({
            placeholder: 'Search user',
            ajax: {
                url: "/search",
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                id: item.id,
                                text: item.name,
                                name_slug: item.name_slug,
                            }
                        })
                    };
                },
                cache: true
            }
        });

        $q.on('select2:select', function(e) {
            window.location.href = "/profile/" + e.params.data.name_slug + "/show";
        })

        $('#formTopic').hide();
        $("#btnTopic").click(function() {
            $('#formTopic').toggle();
        })
    </script> --}}

    <script>
        let $q = $('.livesearch');

        $q.select2({
            placeholder: 'Search question',
            ajax: {
                url: "/search",
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                id: item.title_slug, // Gunakan title_slug sebagai nilai value
                                text: item.title // Gunakan title sebagai teks pilihan
                            }
                        })
                    };
                },
                cache: true
            }
        });

        $q.on('select2:select', function(e) {
            // Cek apakah ada nilai yang dipilih sebelum melakukan redirect
            if (e.params.data.id) {
              //Route::get('/{question:title_slug}', [QuestionController::class, 'show'])->name('question.show');
              window.location.href = "/"+ e.params.data.id
            }
        });

        $('#formTopic').hide();
        $("#btnTopic").click(function() {
            $('#formTopic').toggle();
        });
    </script>


    @yield('script')

</body>

</html>
