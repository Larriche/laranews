<!DOCTYPE html>
<html>
<head>
	<title>The Gong</title>
	{!! Html::style('bootstrap/css/bootstrap.min.css') !!}
	{!! Html::style('css/style.css') !!}
	{!! Html::script('bootstrap/js/jquery.min.js') !!}
	{!! Html::script('bootstrap/js/bootstrap.min.js') !!}
</head>
<body>
    <header class="site-header">
        <nav class="navbar-inverse  main-nav">
        <div class="container-fluid">
            <!-- Logo -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mainNavBar">
                	<span class="icon-bar"></span>
                	<span class="icon-bar"></span>
                	<span class="icon-bar"></span>
                </button>
                <a href="#" class="navbar-brand"><span class="site-logo">The Gong</span></a>
            </div>

            <!-- Menu Items -->
            <div class="collapse navbar-collapse" id="mainNavBar">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="/">Home</a></li>
                    <li><a href="/news/create">Publish News</a></li>
                    @if(Auth::guest())
	                    <li><a href="/auth/register">Sign Up</a></li>
	                    <li><a href="/auth/login">Sign In</a></li>
                    
                    @else
                        <li><a href="/auth/logout">Log out</a></li>
                    @endif
                </ul>
            </div>
         </div>
       </nav>
	</header>

    <div id="body-container">
    @yield('content')
    </div>

    <footer>
    </footer>
</body>
</html>

