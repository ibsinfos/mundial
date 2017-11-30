
<!DOCTYPE html>
<meta http-equiv="Refresh" content="1800"> 

 <?php 

 include("config/conexao.php");

$cnpj 	 = $_POST['cnpj'];

$query=("Select * from Vw_trackingPedido_new where CNPJ='$cnpj'");

//echo $query; 

$consulta = mssql_query($query);
//print_r($consulta);


if(mssql_num_rows ($consulta) > 0 ){
	
			// $resultTrack = mssql_fetch_array($consulta); 		




?>


    <head>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <meta name="description" content="interface para usuario preecher informaçõe do tracking">
    <meta name="author" content="Ana Dantas">

        <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <title>Tracking | Mundial Logistics Group</title>
    
        <!-- bootstrap 3.0.2 -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- DATA TABLES -->
        <link href="css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link rel="stylesheet" href="css/bootstrap.cerulean.min.css" type="text/css"  />

        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
		
     

    </head>
    <body class="skin-black">
        
 <header>
         <div class="row">
         			<br/><br/>
				<ul id="gn-menu" class="gn-menu-main">
					
					 <a href="index.php"> <img src="images/home.png" title="Home"/></a>
							
						</ul>
          <div class="col-xs-12" align="center">
       			 <img src="images/logo-mlg_color_transp_400px.png" class="img-responsive" alt="" width="200" height="200" />
		  </div>
		 </div>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                  
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                    	<!--<li><a href="#">Depositante:</a></li>
                        <li><a href="list_nf.php">Atualiza Status</a></li>
                        <li><a href="PrevEntrega.php">Prev Entrega</a></li>
                        <li><a href="DtEntrega.php">Data Entrega</a></li>-->
                    </ul>
                </div>
            </div>
        </nav>
        <h1 align="center">Status Tracking</h1>
    </header>
               <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                                                   
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Baixe um periodo (Emissão NF)</h3>                                    
                                </div><!-- /.box-header -->
						
						 <form class="form-inline" id="tracking" action="tracking.php"  method="post" name="tracking">
                                <div class="form-group">
                                  <label for="data1">Data Inico:</label>
                                  <input type="date" class="form-control" id="data1"  name="data1"placeholder="Data Inicio">
                                </div>
                                <div class="form-group">
                                  <label for="data2">Data Fim:</label>
                                  <input type="date" class="form-control" id="data2" name="data2" placeholder="Data Fim">
                                  <input type="hidden" name="cnpj" value="<?php echo $cnpj; ?>">	
                                </div>                            
                                <button type="submit" class="btn btn-warning">Gerar</button>
                              </form>
                                                                    
										<br/>
                                        <br/>
                                        
												</div>
										  
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
											<tr>
											   	<th>Campanha / Job</th>											  
												<th>Pedido</th>
												<th>Nota</th>
												<th>Emissao NF</th>
												<th>Modalidade</th>						
												<th>Status</th>
                                                <th>Dt. Prev Entrega</th>
                                                <th>Dt. Entrega</th>  
											</tr>
										</thead>
                                        <tbody>
                                        	 <?php  
												
												while ($row = mssql_fetch_array($consulta)) {
												    
						
											  ?>
             
                                         <tr>						
											<td><?php echo $row['Campanha']; ?></td>
											<td align="center"><?php echo $row['Pedido']; ?></td>
											<td align="center"><?php echo $row['NF']; ?></td>
											<td align="center"><?php echo $row['dtEmissaoNF']; ?></td>
											<td align="center"><?php echo $row['MODALIDADE_ND']; ?></td>							
											<td align="center"><?php echo $row['StatusEntrega']; ?></td>
                                            <td align="center"><?php echo $row['dtPrevisaoEntrega']; ?></td>
                                            <td align="center"><?php echo $row['dtEntrega']; ?></td>
									   </tr>
                                            <?php }?>
                                        </tbody>
                                        <tfoot>
                                           <tr>
											   
                                               <th>Campanha / Job</th>											  
												<th>Pedido</th>
												<th>Nota</th>
												<th>Emissao NF</th>
												<th>Modalidade</th>									
												<th>Status</th>
                                                <th>Dt. Prev Entrega</th>
                                                <th>Dt. Entrega</th>          
                                                
											</tr>
                                        </tfoot>
                                    </table>   
                       
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                            
                              <div class="modal-footer no-margin-top">
            <p>&copy; 2017 Todos os direitos reservados à <strong>Mundial Logistics Group</strong> | Desenvolvido por <a href="#">Ana Dantas</a></p>
            </div>
                        </div>
                    </div>

                </section><!-- /.content -->
           


        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
              <script src="js/ajax_libs_jquery_2.0.2_jquery.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <!-- DATA TABES SCRIPT -->
        <script src="js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
<!--        <script src="js/AdminLTE/app.js" type="text/javascript"></script>
-->
        <!-- page script -->
        <script type="text/javascript">
            $(function() {
                $("#example1").dataTable();
                $('#example2').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": false
                });
            });
			
	 </script>
     
			<?php }else{

					print"<script>alert('CNPJ: ( $cnpj) nao existe na base');window.location.href='index.php'</script>";
				  }?>

   
       
    </body>
</html>