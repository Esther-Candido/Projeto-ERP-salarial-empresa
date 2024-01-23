<?php 
include '../../validar/func_checar_admin.php'; //admin

function deletar_departamento($id_dep){
	include '../../conexao/conn.php';
	mysqli_query($conn, "DELETE FROM departamento WHERE id_dep = '$id_dep'");
	include '../../conexao/deconn.php';
	echo '<meta http-equiv="refresh" content="0;url=?p=utilizador&opt=admin">';

}
?>
