
<?php 
/* // Dados do banco */
$dbhost = "200.53.221.234:1433"; // Nome do host -- protheus 172.18.0.101
                                   // $port = "1433";
$db = "MundialRelatorios"; // Nome do banco de dados
$user = "sistema"; // Nome do usuário
$password = "27#*!Seg*"; // Senha do usuário

/*
 * @mssql_connect($dbhost,$user,$password) or die("Não foi possível a conexão com o servidor!");
 * @mssql_select_db($db) or die("Não foi possível selecionar o banco de dados!");
 */

$con_ms = mssql_connect ( $dbhost, $user, $password ) or die ( 'No Connection - Sql Server' );
mssql_select_db ( $db, $con_ms );
mssql_query ( "SET ANSI_NULLS ON", $con_ms );
mssql_query ( "SET ANSI_WARNINGS ON", $con_ms );

error_reporting ( E_ALL & ~ E_NOTICE & ~ E_WARNING );

?>

