<?php
$permiso = $_REQUEST['var']; global $permiso; 
$idusua = $_REQUEST['var2']; global $idusua; 
$seccion = $_REQUEST['var3']; global $seccion;
$psico = $_REQUEST['var4'];global $psico;
$agregarpac = 'INSERT INTO paciente (nombre, telefono, saldo, referencia, id_psc) VALUES ("'.$_POST['nombre'].'","'.$_POST['telefono'].'","'.$_POST['saldo'].'","'.$_POST['referencia'].'","'.$psico.'")';
require_once("conectar.php");
$consultaagregarpac = mysqli_query($dbc,$agregarpac) or die (" Error, no se agrego al usuario. ".mysqli_error($dbc));
mysqli_close($dbc);
header('Location: inicio.php?var='.$permiso.'&var2='.$idusua.'&var3='.$seccion.'&var4='.$psico.''); 
?>