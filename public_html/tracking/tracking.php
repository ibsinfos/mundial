<?php include("config/conexao.php"); 

$data1  =  str_replace('-','',$_POST['data1']);
$data2  =  str_replace('-','',$_POST['data2']);
$cnpj	=  $_POST['cnpj'];

$query = "	SELECT     
				   [CAMPANHA] 
				  ,[PEDIDO]	 
				  ,([NF]+'-'+[SERIE_NF]) NF  
				  ,convert(varchar,(convert(date, [DTEMINF],103)),103) dtEmissaoNF
				  ,[CNJP]    
				  ,[CLIENTE] 
				  ,[MUNICIPIO_DESTINO] 
				  ,[LOGRA_DESTINO] 
				  ,[UF_DESTINO] 
				  ,convert(varchar,(convert(date,[DT_PREVISTA],103)),103) as dtPrevisaoEntrega
				  ,convert(varchar,(convert(date,[DT_ENTREGA],103)),103)  as dtEntrega  
				  ,[STATUS_TRACKING] 		  
				  ,[MODALIDADE_ND]
				  ,[VALOR_NF]
				  ,[TRANSPORTADORA]
				  ,[DT_CARREGAMENTO] 				
			  FROM [MundialRelatorios].[dbo].[tbTrackTotvs]

	        WHERE DTEMINF >= '$data1'
			  and DTEMINF <= '$data2'
			  and CNJP ='$cnpj'
			  ORDER BY DTEMINF
			  ";
		   //echo $query;
	 
$executar_query = mssql_query($query);
$contar = mssql_num_rows($executar_query);


  for($i=0;$i<1;$i++){   
	$html[$i] = "";
    $html[$i] .= " <table border='1'>";
	//$html[$i] .= "<thead>";
    $html[$i] .= "<tr>";
    $html[$i] .= "<td><strong>CAMPANHA</strong></td>";
	$html[$i] .= "<td><strong>PEDIDO</strong></td>";
	$html[$i] .= "<td><strong>NF</strong></td>";
	$html[$i] .= "<td><strong>DT EMISSSAO NF</strong></td>";
	$html[$i] .= "<td><strong>MODALIDADE</strong></td>";
	$html[$i] .= "<td><strong>STATUS TRACKING</strong></td>";
	$html[$i] .= "<td><strong>DT PREV ENTREGA</strong></td>";
	$html[$i] .= "<td><strong>DT ENTREGA</strong></td>";
    $html[$i] .= "</tr>";
	//$html[$i] .= "</thead>";
    $html[$i] .= "</table>";
}
$i = 1;
while($ret = mssql_fetch_array($executar_query)){
	$CAMPANHA  			=  $ret['CAMPANHA'];
	$PEDIDO 			=  $ret['PEDIDO'];
	$NF  				=  $ret['NF'];
	$dtEmissaoNF 		=  $ret['dtEmissaoNF'];
	$MODALIDADE_ND 	 	=  $ret['MODALIDADE_ND'];
	$STATUS_TRACKING	=  $ret['STATUS_TRACKING'];
	$dtPrevisaoEntrega	=  $ret['dtPrevisaoEntrega']; 
	$dtEntrega			=  $ret['dtEntrega']; 

	 		
    $html[$i] .= "<table border='1'>";
    $html[$i] .= "<tr>";
    $html[$i] .= "<td>$CAMPANHA</td>";
    $html[$i] .= "<td>$PEDIDO </td>";
	$html[$i] .= "<td>$NF</td>";
	$html[$i] .= "<td>$dtEmissaoNF</td>";
	$html[$i] .= "<td>$MODALIDADE_ND</td>";
	$html[$i] .= "<td>$STATUS_TRACKING</td>";
	$html[$i] .= "<td>$dtPrevisaoEntrega</td>";
	$html[$i] .= "<td>$dtEntrega</td>";
    $html[$i] .= "</tr>";
	//$html[$i] .= "</tbody>";
    $html[$i] .= "</table>";
    $i++;
}
$arquivo = 'Tracking.xls';
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/x-msexcel");
header ("Content-Disposition: attachment; filename={$arquivo}" );
header ("Content-Description: PHP Generated Data" );

for($i=0;$i<=$contar;$i++){  
    echo $html[$i];
}

?>
