<?php
$permiso = $_REQUEST['var']; global $permiso; 
$idusua = $_REQUEST['var2']; global $idusua; 
$seccion = $_REQUEST['var3']; global $seccion;
$psico = $_REQUEST['var4'];global $psico;
$idreg = $_REQUEST['var5'];global $idreg;
$accion = $_REQUEST['var6'];global $accion;
if($accion == 1)
{
    $paciente = 'SELECT * FROM paciente WHERE nombre = "'.$_POST['pacientes'].'"';
    require_once("conectar.php");
    $consultapaciente = mysqli_query($dbc,$paciente) or die ("Error: ".mysqli_error($dbc)); $arraypaciente = mysqli_fetch_array($consultapaciente);
    
    if($_POST['pagado'] == 0)
    {
        $saldoactual = $arraypaciente[3] + $_POST['tarifa'];
        $saldo = 'UPDATE paciente SET saldo = "'.$saldoactual.'" WHERE id_pac="'.$arraypaciente[0].'"';
        $consultasaldo = mysqli_query($dbc,$saldo) or die (" NO SE ACTUALIZO EL SALDO. ".mysqli_error($dbc));
    }
    else if($_POST['pagado']==1)
    {
        $saldoactual = $arraypaciente[3] - $_POST['tarifa'];
        $saldo = 'UPDATE paciente SET saldo = "'.$saldoactual.'" WHERE id_pac="'.$arraypaciente[0].'"';
        $consultasaldo = mysqli_query($dbc,$saldo) or die (" NO SE ACTUALIZO EL SALDO. ".mysqli_error($dbc));
    }
    $consulta = 'UPDATE citas SET fecha = "'.$_POST['fecha'].'", hora = "'.$_POST['hora'].'", id_pac = "'.$arraypaciente[0].'", tarifa = "'.$_POST['tarifa'].'", pagado = "'.$_POST['pagado'].'", presencial = "'.$_POST['presencial'].'", confirmacion = "'.$_POST['confirmado'].'" WHERE id_cita="'.$idreg.'"';
    $ejecutar = mysqli_query($dbc,$consulta) or die ("Error: No se ha realizado la consulta".mysqli_error($dbc));
    mysqli_close($dbc);
}
else
{
    require_once("conectar.php");
    $consulta = 'DELETE FROM citas WHERE id_cita = "'.$idreg.'"';
    $ejecutar = mysqli_query($dbc,$consulta) or die ("Error: No se ha realizado la consulta".mysqli_error($dbc));
    mysqli_close($dbc);
}

header('Location: inicio.php?var='.$permiso.'&var2='.$idusua.'&var3='.$seccion.'&var4='.$psico.'');
?>