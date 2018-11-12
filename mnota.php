<?php
$permiso = $_REQUEST['var']; global $permiso; 
$idusua = $_REQUEST['var2']; global $idusua; 
$seccion = $_REQUEST['var3']; global $seccion;
$psico = $_REQUEST['var4'];global $psico;
$idreg = $_REQUEST['var5'];global $idreg;
$accion = $_REQUEST['var6'];global $accion;
if($accion == 1)
{
    $nota = 'UPDATE notas SET titulo = "'.$_POST['titulo'].'", contenido = "'.$_POST['contenido'].'" WHERE id_nota = "'.$idreg.'"'; 
    require_once("conectar.php");
    $consultapaciente = mysqli_query($dbc,$nota) or die ("Error no se realizo la actualización. ".mysqli_error($dbc)); 
    mysqli_close($dbc);
}
else
{
    require_once("conectar.php");
    $consulta = 'DELETE FROM notas WHERE id_nota = "'.$idreg.'"';
    $ejecutar = mysqli_query($dbc,$consulta) or die ("Error: No se ha eliminado el registro.".mysqli_error($dbc));
    mysqli_close($dbc);
}

header('Location: inicio.php?var='.$permiso.'&var2='.$idusua.'&var3='.$seccion.'&var4='.$psico.'');
?>