    <!-- navigation -->
    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    @if (Auth::check())
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }} <span
                                    class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href={{ route('logout') }}
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit()"> logout </a></li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none">
                                    @csrf
                                </form>
                            </ul>
                        </li>
                    @else
                        <li><a href={{ route('register') }}>Signup</a></li>
                        <li><a href={{ route('login') }}>Login</a></li>
                    @endif
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
