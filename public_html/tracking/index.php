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
<script>
	var completes = document.querySelectorAll(".complete");
var toggleButton = document.getElementById("toggleButton");


function toggleComplete(){
  var lastComplete = completes[completes.length - 1];
  lastComplete.classList.toggle('complete');
}

toggleButton.onclick = toggleComplete;
	</script>

</head>
<body>
	<!-- Piwik -->
	<script type="text/javascript">
  var _paq = _paq || [];
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u="http://cluster-piwik.locaweb.com.br/";
    _paq.push(['setTrackerUrl', u+'piwik.php']);
    _paq.push(['setSiteId', 19219]);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
  })();
</script>
	<!-- End Piwik Code -->

	<div class="container">
		<header class="row">
			<a href="../"><img src="images/voltar.png" width="45" height="45"></a><br />
			<br />
		</header>
		<div align="center">
			<img src="images/logo-mlg_color_transp_400px.png"
				class="img-responsive" alt="" width="200" height="200" />
		</div>

		<h2 class="steps-header" align="center">Tracking Mundial</h2>
		<p class="steps-header" align="center">Escolha uma opção</p>

		<!-- Main content -->

		<div class="container">

			<div class="row" id="pwd-container">
				<div class="col-md-4"></div>

				<div class="col-md-4">
					<section class="login-form">

						<form name="form1" method="post" action="validaTracking.php"
							onSubmit="return valida()" role="login">

							<div class="pwstrength_viewport_progress"></div>
							<a href="pedido.php" class="btn btn-lg btn-warning btn-block">Pesquisar
								Pedido</a>
							<!--pedido.php-->

							<div class="pwstrength_viewport_progress">
								<br />
							</div>

							<a href="listPedido.php" class="btn btn-lg btn-warning btn-block">Pesquisar
								CPF/CNPJ Destinatario</a>
							<!--listPedido.php-->

							<div class="pwstrength_viewport_progress">
								<br />
							</div>

							<a href="ClientePedido.php"
								class="btn btn-lg btn-warning btn-block">Pesquisar Codigo
								Cliente</a>
							<!--ClientePedido.php-->

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