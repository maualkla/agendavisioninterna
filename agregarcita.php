<?php
$permiso = $_REQUEST['var']; global $permiso; 
$idusua = $_REQUEST['var2']; global $idusua; 
$seccion = $_REQUEST['var3']; global $seccion;
$psico = $_REQUEST['var4'];global $psico;
$paciente = 'SELECT * FROM paciente WHERE nombre = "'.$_POST['pacientes'].'"';
require_once("conectar.php");
$consultapaciente = mysqli_query($dbc,$paciente) or die ("Error: ".mysqli_error($dbc)); $arraypaciente = mysqli_fetch_array($consultapaciente);
if($_POST['pagado'] == 0)
{
    $saldoactual = $arraypaciente[3] + $_POST['tarifa'];
    $saldo = 'UPDATE paciente SET saldo = "'.$saldoactual.'" WHERE id_pac="'.$arraypaciente[0].'"';
    $consultasaldo = mysqli_query($dbc,$saldo) or die (" NO SE ACTUALIZO EL SALDO. ".mysqli_error($dbc));
}
$insercion = 'INSERT INTO citas (fecha, hora, id_pac, id_psc, id_secretaria, tarifa, pagado, presencial, confirmacion) VALUES ("'.$_POST['fecha'].'","'.$_POST['hora'].'","'.$arraypaciente[0].'","'.$psico.'","'.$idusua.'","'.$_POST['tarifa'].'","'.$_POST['pagado'].'","'.$_POST['presencial'].'","'.$_POST['confirmado'].'")';
echo $insercion;
$consultainsersion = mysqli_query($dbc,$insercion) or die (" NO SE INSERTO. ".mysqli_error($dbc));
mysqli_close($dbc);
header('Location: inicio.php?var='.$permiso.'&var2='.$idusua.'&var3='.$seccion.'&var4='.$psico.'');   
?>