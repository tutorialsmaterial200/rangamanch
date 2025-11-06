@php
$languages = \App\Models\Language::where('status', 1)->get();
$FeaturedCategories = \App\Models\Category::where(['status' => 1, 'language' => getLangauge(), 'show_at_nav' => 1])->get();

$categories = \App\Models\Category::where(['status' => 1, 'language' => getLangauge(), 'show_at_nav' => 0])->get();

$activeMenu = request()->route()->getName();
@endphp

<header class="modern-header">
    <!-- Modern Topbar -->
    <div class="modern-topbar d-none d-sm-block">
        <div class="container py-3">
            <!-- <div class="row align-items-center py-2">
                <div class="col-md-6">
                    <div class="topbar-left d-flex align-items-center gap-3">
                        <ul class="topbar-socials d-flex m-0 p-0">
                            @foreach ($socialLinks as $link)
                            <li><a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer" title="Follow us"><i class="{{ $link->icon }}"></i></a></li>
                            @endforeach
                        </ul>
                        <div class="topbar-date-time ms-3">
                            @php
                                $currentDate = now();
                                $nepaliDays = [
                                    'Sunday' => 'आइतबार',
                                    'Monday' => 'सोमबार', 
                                    'Tuesday' => 'मंगलबार',
                                    'Wednesday' => 'बुधबार',
                                    'Thursday' => 'बिहीबार',
                                    'Friday' => 'शुक्रबार',
                                    'Saturday' => 'शनिबार'
                                ];
                                $dayName = $nepaliDays[$currentDate->format('l')];
                                try {
                                    $nepaliDateObj = \Anuzpandey\LaravelNepaliDate\LaravelNepaliDate::from($currentDate->format('Y-m-d'));
                                    $nepaliDateStr = $nepaliDateObj->toNepaliDate('j F Y', 'np');
                                } catch (\Exception $e) {
                                    $nepaliDateStr = $currentDate->format('j') . ' असोज ' . $currentDate->format('Y');
                                }
                                $nepaliDate = str_replace(
                                    ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'],
                                    ['०', '१', '२', '३', '४', '५', '६', '७', '८', '९'],
                                    $nepaliDateStr . ' | ' . $dayName
                                );
                            @endphp
                            <i class="fas fa-calendar-alt"></i> {{ $nepaliDate }}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="topbar-right d-flex align-items-center justify-content-end gap-3">
                        <div class="language-selector">
                            <select id="site-language" class="form-select form-select-sm">
                                @foreach ($languages as $language)
                                    <option value="{{ $language->lang }}" {{ getLangauge() === $language->lang ? 'selected' : '' }}>{{ $language->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="auth-links">
                            @if (!auth()->check())
                            <a href="{{ route('login') }}" class="auth-link"><i class="fas fa-sign-in-alt"></i> {{ __('frontend.Login') }}</a>
                            <span class="divider">|</span>
                            <a href="{{ route('register') }}" class="auth-link"><i class="fas fa-user-plus"></i> {{ __('frontend.Register') }}</a>
                            @else
                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="auth-link"><i class="fas fa-sign-out-alt"></i> {{ __('frontend.Logout') }}</a>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div> -->


            <div class="text-center">
                <a href="{{ url('/') }}">
                    <img src="{{ asset($settings['site_logo']) }}" alt="Site Logo"

                        class="site-logo-img">

                </a>
                <div class="topbar-left d-flex align-items-center gap-3">

                    <div class="ok-current-time ms-3">
                        @php
                        $currentDate = now();
                        $nepaliDays = [
                        'Sunday' => 'आइतबार',
                        'Monday' => 'सोमबार',
                        'Tuesday' => 'मंगलबार',
                        'Wednesday' => 'बुधबार',
                        'Thursday' => 'बिहीबार',
                        'Friday' => 'शुक्रबार',
                        'Saturday' => 'शनिबार'
                        ];
                        $dayName = $nepaliDays[$currentDate->format('l')];
                        try {
                        $nepaliDateObj = \Anuzpandey\LaravelNepaliDate\LaravelNepaliDate::from($currentDate->format('Y-m-d'));
                        // Get date in Nepali format with Nepali month names
                        $nepaliDateStr = $nepaliDateObj->toNepaliDate('j F Y', 'np');
                        } catch (\Exception $e) {
                        $nepaliDateStr = $currentDate->format('j') . ' असोज ' . $currentDate->format('Y');
                        }
                        // Convert only the numbers to Nepali numerals (0-9 to ०-९)
                        $nepaliDate = str_replace(
                        ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'],
                        ['०', '१', '२', '३', '४', '५', '६', '७', '८', '९'],
                        $nepaliDateStr . ', ' . $dayName
                        );
                        @endphp
                        {{ $nepaliDate }}
                    </div>
                </div>


            </div>
        </div>
    </div>
    </div>
    <!-- End Modern Topbar -->


    <!-- Navbar  -->
    <!-- Navbar menu  -->
    <div class="navigation-wrap navigation-shadow bg-white">
        <nav class="navbar navbar-hover navbar-expand-lg navbar-soft">
            <div class="container">
                <div class="offcanvas-header">
                    <div data-toggle="modal" data-target="#modal_aside_right" class="btn-md">
                        <span class="navbar-toggler-icon"></span>
                    </div>

                </div>

                <a href="{{ url('/') }}">
                    <img src="{{ asset(@$footerInfo->logo) }}" alt="Rangamanch" width="45" height="24">
                </a>


                <!-- <figure class="mb-0 mx-auto">
                    <a href="{{ url('/') }}" class="navbar-brand">
                       
                              <img src="{{ asset($settings['site_logo']) }}"" width="300px" height="250px" alt="">
                            
                  
                    </a>
                </figure> -->

                <div class="collapse navbar-collapse justify-content-between">
                    <ul class="navbar-nav ml-auto ">
                        @foreach ($FeaturedCategories as $category)
                        <li class="nav-item">
                            <a class="nav-link {{ request()->category === $category->slug ? 'active' : '' }}"
                                href="{{ route('news', ['category' => $category->slug]) }}">{{ $category->name }}</a>
                        </li>
                        @endforeach
                        <!-- <li class="nav-item">
                            <a class="nav-link {{ $activeMenu === 'video-gallery' ? 'active' : '' }}" 
                               href="{{ route('video-gallery') }}">
                               <i class="fas fa-video"></i> {{ __('frontend.Video Gallery') }}
                            </a>
                        </li> -->

                        @if (count($categories) > 0)
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown"> {{ __('frontend.More') }} </a>
                            <ul class="dropdown-menu animate fade-up">
                                @foreach ($categories as $category)
                                <li><a class="dropdown-item icon-arrow" href="{{ route('news', ['category' => $category->slug]) }}"> {{ $category->name }}
                                    </a></li>
                                @endforeach

                            </ul>
                        </li>
                        @endif
                        <!-- <li class="nav-item"><a class="nav-link" href="{{ route('about') }}"> {{ __('frontend.About Us') }} </a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}"> {{ __('frontend.contact') }} </a></li> -->

                    </ul>


                    <!-- Search bar.// -->
                    <ul class="navbar-nav ">
                        <li class="nav-item search hidden-xs hidden-sm "> <a class="nav-link" href="#">
                                <i class="fa fa-search"></i>
                            </a>
                        </li>

                    </ul>

                    <!-- Search content bar.// -->
                    <div class="top-search navigation-shadow">
                        <div class="container">
                            <div class="input-group ">
                                <form action="{{ route('news') }}" method="GET">

                                    <div class="row no-gutters mt-3">
                                        <div class="col">
                                            <input class="form-control border-secondary border-right-0 rounded-0"
                                                type="search" value="" placeholder="Search "
                                                id="example-search-input4" name="search">
                                        </div>
                                        <div class="col-auto">
                                            <button type="submit" class="btn btn-outline-secondary border-left-0 rounded-0 rounded-right"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>


                    <!-- Search content bar.// -->
                </div>

                <!-- navbar-collapse.// -->
                <!-- <div class="auth-links">
                            @if (!auth()->check())
                            <a href="{{ route('login') }}" class="auth-link"><i class="fas fa-sign-in-alt"></i> {{ __('frontend.Login') }}</a>
                            <span class="divider">|</span>
                            <a href="{{ route('register') }}" class="auth-link"><i class="fas fa-user-plus"></i> {{ __('frontend.Register') }}</a>
                            @else
                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="auth-link"><i class="fas fa-sign-out-alt"></i> {{ __('frontend.Logout') }}</a>
                            </form>
                            @endif
                        </div> -->

            </div>

        </nav>
    </div>
    <!-- End Navbar menu  -->


    <!-- Navbar sidebar menu  -->
    <div id="modal_aside_right" class="modal fixed-left fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-aside" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="widget__form-search-bar  ">
                        <form action="{{ route('news') }}" method="GET">
                            <div class="row no-gutters">
                                <div class="col">
                                    <input class="form-control border-secondary border-right-0 rounded-0" value=""
                                        placeholder="Search" type="search" name="search">
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-outline-secondary border-left-0 rounded-0 rounded-right">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <nav class="list-group list-group-flush">
                        <ul class="navbar-nav ">
                            @foreach ($FeaturedCategories as $category)
                            <li class="nav-item">
                                <a class="nav-link active text-dark" href="{{ route('news', ['category' => $category->slug]) }}"> {{ $category->name }}</a>
                            </li>
                            @endforeach

                            @if (count($categories) > 0)
                            <li class="nav-item">
                                <a class="nav-link active dropdown-toggle  text-dark" href="#"
                                    data-toggle="dropdown">More </a>
                                <ul class="dropdown-menu dropdown-menu-left">
                                    @foreach ($categories as $category)
                                    <li><a class="dropdown-item" href="{{ route('news', ['category' => $category->slug]) }}">{{ $category->name }}</a></li>
                                    @endforeach

                                </ul>
                            </li>
                            @endif

                            <li class="nav-item"><a class="nav-link text-dark" href="{{ route('about') }}"> {{ __('frontend.About Us') }} </a>
                            </li>
                            <li class="nav-item"><a class="nav-link text-dark" href="{{ route('contact') }}"> {{ __('frontend.contact') }} </a>
                            </li>
                            <!-- <li class="nav-item">
                                <a class="nav-link text-dark {{ $activeMenu === 'video-gallery' ? 'active' : '' }}" 
                                   href="{{ route('video-gallery') }}">
                                   <i class="fas fa-video"></i> {{ __('frontend.Video Gallery') }}
                                </a>
                            </li> -->
                        </ul>

                    </nav>
                </div>

            </div>
        </div>
    </div>
</header>