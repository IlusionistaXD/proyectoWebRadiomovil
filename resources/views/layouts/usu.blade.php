<head>

    <title>RadioMovil UAGRM</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- vendor css -->
    <link rel="stylesheet" href="files/style.css">
	@yield('scripts')
	<style>
		#app{ padding-left: 270px;}

		#output{ 
		color: black;
		border: 1px solid #888;
		background-color: white
		}

		#output p{ 
			border: 1px solid #888;
		}

		#output a{ 
			color: black;
		}

		footer {
		background-color: transparent;
		position: absolute;
		bottom: 0;
		width: 75%;
		color: white;
		}
		footer {
		background: #222;
		color: #aaa;
		padding-top: 10px;
		}
		footer a {
		color: #aaa;
		}
		footer a:hover {
		color: #fff;
		}

		footer .copyright span {
		color: #0894d1;
		}
	</style>
</head>

<body class="">
	@if (Auth::user())
        <input value="{{Auth::user()->is_admin}}" name="rolvalue" id="rolvalue"></input>
    @endif
	
    <!-- [ navigation menu ] start -->
	<nav class="pcoded-navbar menu-light ">
		<div class="navbar-wrapper ">
			<div class="navbar-content scroll-div" >

				<ul class="nav pcoded-inner-navbar ">
					<li class="nav-item pcoded-menu-caption">
					    <label>Casos de Usos</label>
					</li>
					<li class="nav-item">
					    <a href="{{ route('welcome_user') }}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Pagina Bienvenida</span></a>
					</li>

					<li class="nav-item pcoded-hasmenu">
					    <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-layout"></i></span><span class="pcoded-mtext">Cuenta de usuario</span></a>
					    <ul class="pcoded-submenu">
							@guest
								@if (Route::has('login'))
									<li class="nav-item">
										<a class="nav-link" href="{{ route('login') }}">{{ __('Ingresar') }}</a>
									</li>
								@endif
								
								@if (Route::has('register'))
									<li class="nav-item">
										<a class="nav-link" href="{{ route('register') }}">{{ __('Registrarse') }}</a>
									</li>
								@endif
							@else
								<li class="nav-item">
									<a id="navbarDropdown" class="ml-4 text-sm text-gray-700 underline" >
										{{ Auth::user()->name }}
									</a>
								</li>
								<li class="nav-item">
										<a class="ml-4 text-sm text-gray-700 underline" href="{{ route('logout') }}" onclick="event.preventDefault();
														document.getElementById('logout-form').submit();">
											{{ __('Cerrar Sesion') }}
										</a>>
								</li>
							@endguest
					    </ul>
					</li>

					<li class="nav-item pcoded-hasmenu">
					    <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-layout"></i></span><span class="pcoded-mtext">Contratar viaje</span></a>
					    <ul class="pcoded-submenu">
					        <li><a href="{{ route('viajes') }}" class="ml-4 text-sm text-gray-700 underline">Viajes</a></li>
							<li><a href="{{ route('uservicios') }}" class="ml-4 text-sm text-gray-700 underline">Servicios</a></li>
							<li><a href="{{ route('umovils') }}" class="ml-4 text-sm text-gray-700 underline">Moviles</a></li>
							<li><a href="{{ route('utarifas') }}" class="ml-4 text-sm text-gray-700 underline">Tarifas</a></li>
							<li><a href="{{ route('uparadas') }}" class="ml-4 text-sm text-gray-700 underline">Paradas</a></li>
        				</ul>
					</li>
					
				</ul>
			
			</div>
		</div>
	</nav>
	<!-- [ navigation menu ] end -->
	
    <!-- [ Header ] start -->
	<header class="navbar pcoded-header navbar-expand-lg navbar-light header-blue">
				<div class="m-header">
					<a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
					<a href="#!" class="b-brand">
						<!-- ========   change your logo hear   ============ -->
						<img src="{{ asset('files/logo.png') }}" id="logo" width="50" alt="" class="logo">
						<img src="{{ asset('files/logo-icon.png') }}" alt="" class="logo-thumb">
					</a>
					<a href="#!" class="mob-toggler">
						<i class="feather icon-more-vertical"></i>
					</a>
				</div>
				<section class="search-sec">
    				<div class="container">
						<form action="#!" method="get" id="form_busqueda">
							<div class="row">
								<div class="col-lg-12">
									<div class="row">
										<div class="col-lg-8 col-md-8 col-sm-12 p-0">
											<input type="text" name="dato" id="dato"class="form-control search-slt" placeholder="Introducir Dato">
										</div>

							
										<div class="col-lg-4 col-md-4 col-sm-12 p-0">
											<button type="button" name ="boton_busqueda" id="boton_busqueda"class="btn btn-danger wrn-btn">Buscar</button>
										</div>
									</div>
									

									</div >
								</div>
							</div>
        				</form>
    				</div>

					<div class="column" id="output" name="output"></div>
				</section>
	</header>
	<!-- [ Header ] end -->
	                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar Sesion') }}</a>
                                </li>
                            @endif
                            
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registrase') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Cerrar Sesion') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
    <div id="app">
    <td>
        <main class="py-4">
            @yield('content')
			@if( $tot ?? '')
			<footer>
			<div class="copyright text-center">
				Visitas: <span>{{ $tot ?? '' }}</span>
			</div>
			</footer>
			@endif
        </main>
        </td>
    </div> 
<!-- [ Main Content ] start -->


 <!-- Required Js -->
 <script src="{{ asset('files/vendor-all.min.js') }}"></script>
<!--<script src="files/bootstrap.min.js"></script>-->
<script src="{{ asset('files/ripple.js') }}"></script>
<script src="{{ asset('files/pcoded.min.js') }}"></script>
<!-- Apex Chart -->
<script src="{{ asset('files/apexcharts.min.js') }}"></script>
<!-- custom-chart js -->
<!--<script src="{{ asset('files/dashboard-main.js') }}"></script>-->
<script src="{{ asset('files/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('js/checkBusqueda.js') }}"></script>
</body>
</html>