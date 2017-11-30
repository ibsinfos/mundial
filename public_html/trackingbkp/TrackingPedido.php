<!DOCTYPE html>
<?php
include ("config/conexao.php");
$pedido = $_POST ['pedido'];
// $cnpj = $_POST['cnpj'];

if ($pedido != '') {
	// IMPRESS�O pedido site
	$query = ("Select * from Vw_trackingPedido_new where Pedido='$pedido'");
	
	// echo $query;
	
	$consulta = mssql_query ( $query );
	// print_r($consulta);
	
	if (mssql_num_rows ( $consulta ) == 1) {
		
		$resultTrack = mssql_fetch_array ( $consulta );
	} else {
		
		print "<script>alert('Pedido: ( $pedido ) não existe na base');window.location.href='index.php'</script>";
	}
}

$StatusEntrega = $resultTrack ['StatusEntrega'];

?>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
<title>Mundial Logistics Group</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
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
	<div class="container">


		<!-- STEPS -->
		<section id="Steps" class="steps-section">
			<br />
			<br />
			<ul id="gn-menu" class="gn-menu-main">

				<a href="index.php"> <img src="images/home.png" title="Home" /></a>

			</ul>
			<h2 class="steps-header">Tracking Pedido | Mundial Logistics Group</h2>
			<!-- Box (with bar chart) -->


			<div class="box box-danger" id="loading-example">
				<div class="box-header">
					<!-- tools box -->

					<i class="ion ion-clipboard"></i>
					<div class="row">
						<div class="col-sm-2">
							<h3 class="box-title">
								Pedido: <b><?php echo $resultTrack['Pedido']; ?></b>
							</h3>
						</div>
						<div class="col-sm-6">
							<h3 class="box-title">
								Campanha: <b><?php echo $resultTrack['Campanha']; ?></b>
							</h3>
						</div>
						<div class="col-sm-3 text-Right">
							<h3 class="box-title">
								Status: <b><?php
								
echo $resultTrack ['StatusEntrega'];
								if ($StatusEntrega == 'ENTREGUE') {
									?>
											<img src="images/check.png" />
											<?php }else{ ?>
											<img src="images/time.png" /> 
											<?php } ?></b>
							</h3>
						</div>
					</div>
				</div>
				<!-- /.box-header -->
				<div class="box-body no-padding">
					<div class="row"></div>
					<!--/.row - inside box -->

				</div>
				<!-- /.box-body -->
				<div class="box-footer">
					<div class="row">

						<div class="col-xs-4 text-center"
							style="border-right: 1px solid #f4f4f4">
							<p><?php echo $resultTrack['Nome']; ?> </p>
						</div>
						<!-- ./col -->

						<div class="col-xs-4 text-center"
							style="border-right: 1px solid #f4f4f4">
							<p><?php echo $resultTrack['Cidade']; ?></p>
						</div>
						<!-- ./col -->

						<div class="col-xs-4 text-center"
							style="border-right: 1px solid #f4f4f4">
							<p> <?php echo $resultTrack['UF']; ?></p>
						</div>
						<!-- ./col -->
					</div>
					<!-- /.row1 -->
					<div class="row">
						<div class="col-xs-4 text-center"
							style="border-right: 1px solid #f4f4f4">
							<p>NF: <?php echo $resultTrack['NF']; ?></p>
						</div>
						<!-- ./col -->

						<div class="col-xs-4 text-center"
							style="border-right: 1px solid #f4f4f4">
							<p>Data Despacho: <?php echo $resultTrack['dt_despacho']; ?></p>
						</div>
						<!-- ./col -->

						<div class="col-xs-4 text-center"
							style="border-right: 1px solid #f4f4f4">
							<p>Previsao Entrega: <?php echo $resultTrack['dtPrevisaoEntrega']; ?></p>
						</div>
						<!-- ./col -->
					</div>
					<!-- /.row2 -->
				</div>
				<!-- /.box-footer -->

			</div>
			<!-- /.box  fim -->

			<div class="steps-timeline">

				<div class="steps-one">
					<?php if($StatusEntrega=='EM TRANSITO'){ ?>
					<img class="steps-img" src="images/pedido.png"
						alt="Pedido está em  preparo para ser transportado" />
					 <?php }elseif($StatusEntrega=='DESPACHO'){ ?>
						<img class="steps-img" src="images/pedido2.png"
						alt="Seu pedido esta acaminho do destino. " />        
					 <?php }else{?>
						  
					 <img class="steps-img" src="images/pedido.png"
						alt="Pedido saiu para entrega ao destinatario  Seu pedido esta em andamento" />
					<?php }?>
					<h3 class="steps-name">Despacho</h3>
					<p class="steps-description">O pedido esta em andamento, periodo de
						separa&ccedil;&atilde;o e preparo para transportar.</p>
				</div>

				<div class="steps-two">
					 <?php if($StatusEntrega=='DESPACHO'){ ?>
						<img class="steps-img" src="images/transporte1.png"
						alt="Seu pedido esta acaminho do destino. " />  
					  
					   <?php }elseif($StatusEntrega=='EM TRANSITO'){ ?>
						<img class="steps-img" src="images/transporte2.png"
						alt="Seu pedido esta acaminho do destino. " />
					<h3 class="steps-name">Em tr&acirc;nsito</h3>
					<p class="steps-description">O pedido esta a caminho do destino</p>            
					 <?php }else{?>
					 <img class="steps-img" src="images/transporte.png"
						alt="Seu pedido esta acaminho do destino. " />
					<h3 class="steps-name">Em tr&acirc;nsito</h3>
					<p class="steps-description">O pedido esta a caminho do destino</p>            
					 <?php }?>
					
				  </div>

				<div class="steps-three">
				   <?php if($StatusEntrega=='ENTREGUE'){ ?>
						 <img class="steps-img" src="images/entregue.png"
						alt="Seu pedido foi entregue com Sucesso." />

					<h3 class="steps-name">
						   <?php echo $StatusEntrega ; ?>
							</h3>
					<p class="steps-description">Pedido foi entregue com Sucesso.</p>
					  
					 <?php }elseif($StatusEntrega=='RETORNO AO REMETENTE'){?>       
						 <img class="steps-img" src="images/remetente.png"
						alt="Pedido Pedido retornou ao remetente." />
					<h3 class="steps-name">
						   <?php echo $StatusEntrega ; ?>
							</h3>
					<p class="steps-description">Endereço ou pessoa não encontrada.</p>
							  
								 
					 <?php }elseif($StatusEntrega=='POSTO FISCAL'){?>       
						 <img class="steps-img" src="images/fiscal.png" alt="Fiscal" />
					<h3 class="steps-name">
						   <?php echo $StatusEntrega ; ?>
							</h3>
					<p class="steps-description">Parado no posto fiscal.</p>
							  
							   <?php }elseif($StatusEntrega=='DEVOLUCAO'){?>       
						 <img class="steps-img" src="images/devolucao.png"
						alt="Pedido Pedido retornou ao remetente." />
					<h3 class="steps-name">
						   <?php echo $StatusEntrega ; ?>
							</h3>
					<p class="steps-description">Devolvido pelo destinatário.</p>
							  
							  
					<?php }else{?> 
					
						 <img class="steps-img" src="images/entregue1.png"
						alt="Seu pedido foi entregue com Sucesso." />
					<h3 class="steps-name">Entrega</h3>
						   
						 
					<?php }?>      
				  

				</div>
				<!-- /.steps-timeline -->
		
		</section>

		<footer>
			<div class="container">
				<div class="row">
					<div class="col-md-12 col-lg-12">
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
			</div>
		</footer>

	</div>
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>