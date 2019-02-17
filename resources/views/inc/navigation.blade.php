<?php
//    $result = queryMysql("SELECT * FROM category");
?>

<div class="navigation">
    <div class="row ">
        <div class="container">
            <div class="pull-xs-left"> 
                <div class="nav nav-tabs ">
                    <div class="nav-item">
                        @guest
                        @else
                            <a class="nav-link" href="/edit">Create task</a>
                        @endguest
                    </div>
                </div>
            </div>
            <div class="pull-xs-right">
                <div class="nav nav-tabs">
                    <div class=" " style="vertical-align: right;">
                        
                    {{--  @guest
                        <a href="{{ route('login') }}">Login</a>
                        <a class="m-l-1" href="{{ route('register') }}">Register</a>
                    @else
                        <div class='nav-link dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>{{ Auth::user()->name }}</div>
                    @endguest
                    --}}

                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest

                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>

<?php
/*
    echo "SESSION ";
    print_r($_SESSION);
    echo "<br>COOKIES ";
    print_r($_COOKIE);
    echo "<br>";
    echo $usermail;
    echo "<br>";
    print_r($_FILES);
    echo "<br>";
    echo "REQUEST ";
    print_r($_REQUEST['_POST']);
*/
?>

