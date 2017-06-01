<?php 

$_SESSION['token'] = securePHP::csrf(1); 

 ?>
<!DOCTYPE HTML>
<html>
<head>
<title>Gretong a Ecommerce Admin Panel Category Flat Bootstrap Responsive Web Template | Home :: w3layouts</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Gretong Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Bootstrap Core CSS -->
<link href="view/layout/css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="view/layout/css/style.css" rel='stylesheet' type='text/css' />
<link href="view/layout/css/style2.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="view/layout/css/alertify/alertify.min.css" /> 
<link rel="stylesheet" href="view/layout/css/alertify/themes/default.min.css" />
<!-- Graph CSS -->
<link href="view/layout/css/font-awesome.css" rel="stylesheet"> 
<!-- jQuery -->
<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'/>
<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<!-- lined-icons -->
<link rel="stylesheet" href="view/layout/css/icon-font.min.css" type='text/css' />
<script src="view/layout/js/amcharts.js"></script>
<script src="view/layout/js/serial.js"></script>
<script src="view/layout/js/light.js"></script>
<script src="view/layout/js/alertify.min.js"></script>
<!-- //lined-icons -->
<script src="view/layout/js/jquery-1.10.2.min.js"></script>
<body>
	
</body>
<div class="forms">
	<div class="form-two widget-shadow">
		<div class="form-title">
			<h4>Ingreso de usuario</h4>
		</div>
		<div class="form-body" data-example-id="simple-form-inline">
			<center>
				<form class="form-inline" action="?view=login" method="post"> 
					<div class="form-group"> 
						<label for="exampleInputName2">Sucursal</label> 
						<input type="text" class="form-control" id="exampleInputName2" placeholder="Sucursal" name="sucursal" id="sucursal">  
					</div>
					<div class="form-group"> 
						<label for="exampleInputName2">Usuario</label> 
						<input type="text" class="form-control" id="exampleInputName2" placeholder="Usuario" name="usuario" id="usuario"> <?php securePHP::csrf(2); ?> 
					</div> 
					<div class="form-group"> 
						<label for="exampleInputEmail2">Contraseña</label> 
						<input type="password" class="form-control" id="exampleInputEmail2" placeholder="contraseña" name="password" id="password">  
					</div> 
					<p><?php echo $_SESSION['token']; ?></p>
					<?php 
					
					
//securePHP::csrf(2);
 ?>
					<button type="submit" class="btn btn-default">Ingresar</button> 
				</form>
			</center> 
		</div>
	</div>
</div>
<footer class="footerlogin">
	
</footer>
</html>
 <script>
 <?php
  if (isset($msg)) 
  { ?>
  		alertify.alert("<?php echo $msg; ?>");
  <?php } ?>

 	
 </script>