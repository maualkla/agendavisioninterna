<?php
$permiso = $_REQUEST['var']; global $permiso; 
$idusua = $_REQUEST['var2']; global $idusua; 
$seccion = $_REQUEST['var3']; global $seccion;
$psico = $_REQUEST['var4'];global $psico;
$paciente = 'SELECT * FROM paciente WHERE nombre = "'.$_POST['pacientes'].'"'; echo $paciente;
require_once("conectar.php");
$consultapac = mysqli_query($dbc,$paciente) or die ("Error: ".mysqli_error($dbc)); $arraypac = mysqli_fetch_array($consultapac);
$agregarnota = 'INSERT INTO notas (id_pac, titulo, contenido, id_secretaria) VALUES ("'.$arraypac[0].'","'.$_POST['titulo'].'","'.$_POST['contenido'].'","'.$idusua.'")'; echo $agregarnota;
$consultaagregarnota = mysqli_query($dbc,$agregarnota) or die (" Error: ".mysqli_error($dbc));
mysqli_close($dbc);
header('Location: inicio.php?var='.$permiso.'&var2='.$idusua.'&var3='.$seccion.'&var4='.$psico.'');
?>