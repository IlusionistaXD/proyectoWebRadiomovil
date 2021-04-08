@extends('layouts.app')

@section('content')
<head>
    <title>Home Admin</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- vendor css -->
    <link rel="stylesheet" href="files/style.css">
    
</head>
<body class="">
	<!-- [ Pre-loader ] start -->
	<div class="loader-bg">
		<div class="loader-track">
			<div class="loader-fill"></div>
		</div>
	</div>
	<!-- [ Pre-loader ] End -->
	<!-- [ navigation menu ] start -->
	<nav class="pcoded-navbar menu-light ">
		<div class="navbar-wrapper ">
			<div class="navbar-content scroll-div" >

				<ul class="nav pcoded-inner-navbar ">
					<li class="nav-item pcoded-menu-caption">
					    <label>Casos de Usos</label>
					</li>
					<li class="nav-item">
					    <a href="https://www.tecnoweb.org.bo/inf513/grupo12sa/proy2/public/menu" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Home Admin</span></a>
					</li>
					<li class="nav-item pcoded-hasmenu">
					    <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-layout"></i></span><span class="pcoded-mtext">Administración</span></a>
					    <ul class="pcoded-submenu">
					        <li><a href="{{ route('users') }}" class="ml-4 text-sm text-gray-700 underline">Usuarios</a></li>
					        <li><a href="{{ route('movils') }}" class="ml-4 text-sm text-gray-700 underline" >Moviles</a></li>
                            <li><a href="{{ route('promocions') }}" class="ml-4 text-sm text-gray-700 underline">Promociones</a></li>
                            <li><a href="{{ route('tarifas') }}" class="ml-4 text-sm text-gray-700 underline">Tarifas</a></li>
                            <li><a href="{{ route('servicios') }}" class="ml-4 text-sm text-gray-700 underline">Servicios</a></li>
                            <li><a href="{{ route('permisos') }}" class="ml-4 text-sm text-gray-700 underline">Permisos</a></li>
                            <li><a href="{{ route('paradas') }}" class="ml-4 text-sm text-gray-700 underline">Paradas</a></li>
					    </ul>
					</li>
					<li class="nav-item pcoded-hasmenu">
                        <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-layout"></i></span><span class="pcoded-mtext">Gestion</span></a>
					    <ul class="pcoded-submenu">
					        <li><a href="" target="_blank">Reportes</a></li>
					        <li><a href="" target="_blank">Estadisticas</a></li>
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
						<img src="files/logo.png" id="logo" width="50" alt="" class="logo">
						<img src="files/logo-icon.png" alt="" class="logo-thumb">
					</a>
					<a href="#!" class="mob-toggler">
						<i class="feather icon-more-vertical"></i>
					</a>
				</div>
	</header>
	<!-- [ Header ] end -->
	

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">

            <!-- seo start -->
            <div class="col-xl-4 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <h3>756</h3>
                                <h6 class="text-muted m-b-0">Visitas<i class="fa fa-caret-down text-c-red m-l-10"></i></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </div>
</div>

<!-- Required Js -->
<script src="files/vendor-all.min.js"></script>
<!--<script src="files/bootstrap.min.js"></script>-->
<script src="files/ripple.js"></script>
<script src="files/pcoded.min.js"></script>
<!-- Apex Chart -->
<script src="files/apexcharts.min.js"></script>
<!-- custom-chart js -->
<script src="files/dashboard-main.js"></script>
</body>
@endsection
