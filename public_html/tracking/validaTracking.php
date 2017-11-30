
<?php
@$pedido = $_POST ['pedido'];
@$cnpj = $_POST ['cnpj'];

$validaPedido = strlen ( $pedido );
$validaCnpj = strlen ( $cnpj );

// echo $validaPedido.'-';
// echo $validaCnpj;

// CNPJ/CPF com pedido
if ($validaCnpj >= 11) {
	if ($validaPedido != 0) {
		
		echo 'CNPJ/CPF com pedido ';
		
		echo "<meta http-equiv='Refresh' content=0;URL=TrackingPedido.php?pedido=$pedido>;";
	}
}
// Pedido sem CPF/CNPJ
if ($validaPedido >= 7) {
	if ($validaCnpj == 0) {
		
		echo 'Pedido sem CPF/CNPJ ';
		echo "<meta http-equiv='Refresh' content=0;URL=TrackingPedido.php?pedido=$pedido>;";
	}
}
// CPF/CNPJ sem Pedido
if ($validaCnpj >= 11) {
	if ($validaPedido == 0) {
		
		echo 'CPF/CNPJ sem Pedido ';
		echo "<meta http-equiv='Refresh' content=0;URL=list_nf.php?cnpj=$cnpj>;";
	}
} else {
	echo 'invalido';
}

?>