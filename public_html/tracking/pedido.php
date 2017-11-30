<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
<title>Tracking | Mundial Logistics Group</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<!-- <link href="css/style.css" rel="stylesheet">-->
<link href="css/style_in.css" rel="stylesheet">
<link href="css/AdminLTE.css" rel="stylesheet">

<!--[if lt IE 9]> 
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
	<script language='JavaScript'>
function SomenteNumero(e){
    var tecla=(window.event)?event.keyCode:e.which;   
    if((tecla>47 && tecla<58)) return true;
    else{
    	if (tecla==8 || tecla==0) return true;
	else  return false;
    }
}
	</script>
	<!-- End Piwik Code -->

	<div class="container">
		<header class="row">
			<br /> <a href="index.php"> <img src="images/home.png" title="Home" /></a>
		</header>
		<div align="center">
			<img src="images/logo-mlg_color_transp_400px.png"
				class="img-responsive" alt="" width="200" height="200" />
		</div>

		<h2 class="steps-header" align="center">Tracking Pedido</h2>

		<!-- Main content -->

		<div class="container">

			<div class="row" id="pwd-container">
				<div class="col-md-4"></div>

				<div class="col-md-4">
					<section class="login-form">

						<form name="form1" method="post" action="TrackingPedido.php"
							role="login">
							<input type="text" class="form-control" id="pedido" name="pedido"
								maxlength="10" onkeypress='return SomenteNumero(event)'
								required="required"
								placeholder="Digite aqui o numero do seu pedido.">
							<!--  <input type="number" class="form-control"  id="cnpj" name="cnpj" maxlength="14"placeholder=" ou o numero do seu CPF / CNPJ.">-->

							<div class="pwstrength_viewport_progress"></div>
							<button type="submit" class="btn btn-lg btn-warning btn-block">Pesquisar</button>

						</form>
					</section>
				</div>
				<div class="col-md-4"></div>
			</div>

		</div>

		<footer>
			<div class="container">
				<div class="row">
					<div class="col-md-12"></div>

					<br />
					<br />
					<br />
					<br />

					<p align="center">
						&copy; 2017 Todos os direitos reservados &agrave; <strong>Mundial
							Logistics Group</strong> | Desenvolvido por <a
							href="https://www.linkedin.com/in/ana-carolina-oliveira-dantas-b48ab294?trk=hp-identity-photo">Ana
							Dantas</a>
					</p>


				</div>
			</div>
		</footer>




		</section>

	</div>
	<script src="js/jquery.min.js"></script>
	<script src="js/style_in.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>