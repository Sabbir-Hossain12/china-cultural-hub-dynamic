<!-- Header Start -->
<header class="main-header header-gold"
        @if(Route::currentRouteName() != 'home') style="background-color: #ee1c25" @endif>
    <div class="header-sticky bg-section">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <!-- Logo Start -->
                <a class="navbar-brand" href="#">
                    <!--						<img src="images/logo.svg" alt="Logo">-->
                    <span class="text-light">China Cultural Hub</span>
                </a>
                <!-- Logo End -->

                <!-- Main Menu Start -->
                <div class="collapse navbar-collapse main-menu">
                    <div class="nav-menu-wrapper">
                        <ul class="navbar-nav mr-auto" id="menu">
                            <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a>

                            </li>


                            <li class="nav-item submenu"><a class="nav-link" href="javascript:void(0)">Category</a>
                                <ul>
                                    @forelse($categories as $category)
                                        <li class="nav-item"><a class="nav-link" href="{{ route('categoryDetails',$category->slug) }}">{{ $category->name ?? '' }}</a></li>
                                    @empty
                                    @endforelse
                                </ul>
                            </li>

                            <li class="nav-item submenu"><a class="nav-link" href="#">Content</a>
                                <ul>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('geography') }}">The Geographical Environment and
                                            Chinese Culture</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('history') }}">The History and Society of
                                            China</a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('tradition') }}">Chinese Traditional Thoughts</a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('lives') }}">The Lives of Ancient Chinese</a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('technology') }}">China's Contribution to Worlds
                                            Science and Technology</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('chinaMigration') }}">Migration and China's Social
                                            Changes</a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('collision') }}">Collision Between China and the
                                            West</a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('modern') }}">China in Modern Times and Western
                                            Civilisation</a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('contemporary') }}">Life About Contemporary Chinese
                                            People</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('community') }}">International Community</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('political') }}">Political System and Basic
                                            Policies</a></li>
                                </ul>
                            </li>

                            <li class="nav-item"><a class="nav-link" href="#">About Us</a>
                            <li class="nav-item"><a class="nav-link" href="{{ route('ai-assistant') }}">AI Assistant</a></li>
                        </ul>
                    </div>

                    <!-- Header Btn Start -->
                    <div class="header-btn">
                        {{--                        <a href="#" class="btn-default btn-highlighted">Get Started</a>--}}
                        <form action="{{ route('search') }}" method="post" class="d-flex">
                            @csrf
                            <input type="text" placeholder="Search" class="form-control" style="border-radius: 0">
                            <button type="submit" class="btn-search">Search</button>
                        </form>
                    </div>
                    <!-- Header Btn End -->
                </div>
                <!-- Main Menu End -->
                <div class="navbar-toggle"></div>
            </div>
        </nav>
        <div class="responsive-menu"></div>
    </div>
</header>
<!-- Header End -->

