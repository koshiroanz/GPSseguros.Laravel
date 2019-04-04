<!DOCTYPE html>
<html lang="es">
  	<head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <title>Seguros</title>
	    <meta name="description" content="Gestión de Seguros de Vehículos">
	  	<meta name="koshiroanz" content="John Doe">
	    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	    <!-- Bootstrap 3.3.5 -->
	    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
  		<link rel="stylesheet" href="{{asset('css/jquery-ui.min.css')}}">
	    <link rel="stylesheet" href="{{asset('css/style.css')}}">
	    <!-- Font Awesome -->
    	<link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
	    <link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}">
	    <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
	    <link rel="stylesheet" href="{{asset('css/_all-skins.min.css')}}">
	    <!-- Toastr CSS -->
	    <link rel="stylesheet" href="{{asset('css/toastr.min.css')}}">
	    <link rel="shortcut icon" href="{{asset('img/Gps/GPS.png')}}">
	    <!-- jQuery 3.3.1 -->
	    <script src="{{asset('js/jQuery-3.3.1.min.js')}}"></script>
	    <!-- jQuery-ui.1.12.1 -->
  		<script src="{{asset('js/jquery-ui.min.js')}}"></script>
  	</head>
  	<body class="hold-transition skin-blue sidebar-mini">
  		<!--<div id="contenedor_carga">
	  		<div id="carga"></div>
	  	</div>-->
    	<div class="wrapper">
      		<header class="main-header">
		        <!-- Logo -->
		        <a href="{{url('home')}}" class="logo" id="header-a-logo">
		          	<!-- mini logo for sidebar mini 50x50 pixels -->
		          	<span class="logo-mini">S</span>
		          	<!-- logo for regular state and mobile devices -->
		          	<span class="logo-lg">Seguros</span>
		        </a>
		        <!-- Header Navbar: style can be found in header.less -->
		        <nav class="navbar navbar-static-top" id="navbar-static-top" role="navigation">
		          	<!-- Sidebar toggle button -->
		          	<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
		            	<span class="sr-only">Navegación</span>
		          	</a>
		          	<!-- Navbar Right Menu -->
		          	<div class="navbar-custom-menu" style="padding: 15px; color: #fff;">
		            	<ul class="nav navbar-nav">
		              	<!-- Messages: style can be found in dropdown.less-->
		              
		              	<!-- User Account: style can be found in dropdown.less -->
		              		<li class="dropdown user user-menu">
		              			<i class="fa fa-user"></i>
	                  			<span class="hidden-xs">{{Auth()->user()->email}}</span>
		              		</li>
		            	</ul>
		          	</div>
		        </nav>
      		</header>
      		<!-- Left side column. contains the logo and sidebar -->
      		<aside class="main-sidebar">
	    		<!-- sidebar: style can be found in sidebar.less -->
	        	<section class="sidebar">
	          		<!-- Sidebar user panel -->
	                    
	          		<!-- sidebar menu: : style can be found in sidebar.less -->
	          		<ul class="sidebar-menu">
	            		<li class="header li-header"></li>
	            		<li class="treeview">
	              			<a href="{{url('/')}}" value="{{url('/')}}">
	                			<i class="fa fa-circle-thin"></i>
	                			<span>Inicio</span>
	              			</a>
	            		</li>
	            		<li class="treeview">
	              			<a href="{{url('localidad')}}">
	                			<i class="fa fa-circle-thin"></i>
	                			<span>Localidades</span>
	              			</a>
	            		</li>
	            		<li class="treeview">
	              			<a href="">
	                			<i class="fa fa-circle-thin"></i>
                				<span>Clientes</span>
	                			<i class="fa fa-angle-left pull-right"></i>
	              			</a>
	              			<ul class="treeview-menu">
	                			<li>
	                				<a href="{{url('cliente')}}">
                						<span>Clientes</span>
	                				</a>
	                			</li>
	                			<li>
	                				<a href="{{url('beneficiario')}}">
            							<span>Beneficiarios</span>
	                				</a>
	                			</li>
	              			</ul>
	            		</li>
	            		<li class="treeview">
	              			<a href="">
	                			<i class="fa fa-circle-thin"></i>
	                			<span>Vehículos</span>
	                 			<i class="fa fa-angle-left pull-right"></i>
	              			</a>
	              			<ul class="treeview-menu">
	                			<li><a href="{{url('carroceria')}}">Carrocerías</a></li>
	                			<li><a href="{{url('marca')}}">Marcas</a></li>
	                			<li><a href="{{url('modelo')}}">Modelos</a></li>
	                			<li><a href="{{url('modelo_carroceria')}}">Modelos y Carrocerías</a></li>
	                			<li><a href="{{url('vehiculo')}}">Vehículos</a></li>
	              			</ul>
	            		</li>
	            		<li class="treeview">
	             			 <a href="{{url('poliza')}}">
	                			<i class="fa fa-circle-thin"></i>
	                			<span>Pólizas</span>
                			</a>
	            		</li>
	            		<li class="treeview">
	              			 <a href="{{url('pago')}}">
	                			<i class="fa fa-circle-thin"></i>
	                			<span>Pagos</span>
                			</a>
	            		</li>
	            		<li class="treeview">
	             			 <a href="{{url('siniestro')}}">
	                			<i class="fa fa-circle-thin"></i>
                				<span>Siniestros</span>
	              			</a>
	            		</li>
	            		<li class="treeview">
	             			 <a href="#">
	                			<i class="fa fa-circle-thin"></i>
	                			<span>Reportes</span>
	                			<i class="fa fa-angle-left pull-right"></i>
	                			
	                			<ul class="treeview-menu">
	                				<li><a href="{{url('reporte/certificado')}}"><small class="label pull-right bg-red">PDF</small>Certificado</a></li>
	                				<li><a href="{{url('reporte/carnetprovisorio')}}"><small class="label pull-right bg-red">PDF</small>Carnet Provisorio</a></li>
	              				</ul>
	              			</a>
	            		</li>
	            		<li class="treeview">
	             			 <a href="{{url('pedido')}}">
	                			<i class="fa fa-circle-thin"></i>
	                			<span>Pedidos</span>
	                			<small class="label pull-right bg-red" id="notificacion"></small>
	              			</a>
	            		</li>
	            		@can('privilegio-alto',Auth::user())
	            		<li class="treeview">
	             			 <a href="#">
	                			<i class="fa fa-circle-thin"></i>
	                			<span>Seguros</span>
	                			<i class="fa fa-angle-left pull-right"></i>
	                			<ul class="treeview-menu">
		                			<li><a href="{{url('comp/compseguro')}}"></i> Compañia de seguro</a></li>
		                			<li><a href="{{url('comp/categoria')}}"></i> Categoría</a></li>
		                			<li><a href="{{url('comp/cobertura')}}"></i> Cobertura</a></li>
	              				</ul>
	              			</a>
	            		</li>
	            		<li class="treeview">
	             			 <a href="{{url('productor')}}">
	                			<i class="fa fa-circle-thin"></i>
	                			<span>Productores</span>
	              			</a>
	            		</li>
	            		@endcan
	            		<li>
	              			<a href="{{url('/logout')}}">
	                			<i class="fa fa-circle-thin"></i>
	                			<span>Salir</span>
	              			</a>
	            		</li>
	          		</ul>
	        	</section>
        		<!-- /.sidebar -->
      		</aside>
       		<!--Contenido-->
     		 <!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
	        	<!-- Main content -->
		        <section class="content">
		      		<div class="row">
		        		<div class="col-md-12">
		        			
					  		<!-- Toastr JS -->
    						<script src="{{asset('js/toastr.js')}}"></script>
		          			<!--Contenido-->
          					@yield('contenido')
      						<!--Fin Contenido-->
		        		</div><!-- /.box-body -->
		  			</div><!-- /.box -->
	  			</section><!-- /.content -->
			</div><!-- /.col -->
      	</div><!-- /.content-wrapper -->
      	<!--Fin-Contenido-->
      	<!--<footer class="main-footer">
    		<div class="pull-right hidden-xs">
         		 <b>v</b>1.0
        	</div>
      	</footer>-->
  		<script src="{{asset('js/dat-picker.min.js')}}"></script>
  		<!-- Bootstrap 3.3.5 -->
	    <script src="{{asset('js/bootstrap.min.js')}}"></script>
  		<!-- Bootstrap select -->
	    <script src="{{asset('js/bootstrap-select.min.js')}}"></script>
      	<!--<script src="{{asset('js/loading.js')}}"></script>-->
		<script src="{{asset('js/notificacion-pedido.js')}}"></script>	    
	    <!-- AdminLTE App -->
	    <script src="{{asset('js/app.min.js')}}"></script>
	    
    </body>
</html>
