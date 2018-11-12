<?php include("seuridad.php"); ?>
<html>
    <head>
        <title> MODIFICAR PACIENTE </title>
        <link rel="shortcut icon" href="data/logo - copia.ico.png">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body class="bodybus">
        <?php
        $permiso = $_REQUEST['var']; global $permiso; 
        $idusua = $_REQUEST['var2']; global $idusua; 
        $seccion = $_REQUEST['var3']; global $seccion;
        $psico = $_REQUEST['var4'];global $psico;
        $idreg = $_REQUEST['var5'];global $idreg;
        $psicologo = 'SELECT nombre FROM psicologo WHERE id_psc = "'.$psico.'"';
        $pacientes = 'SELECT * FROM paciente WHERE id_pac = "'.$idreg.'"';
        require_once("conectar.php");
        $consultapacientes = mysqli_query($dbc,$pacientes) or die ("Error: ".mysqli_error($dbc)); global $consultapacientes;
        $consultpsicologo = mysqli_query($dbc,$psicologo) or die ("Error: ".mysqli_error($dbc)); 
        mysqli_close($dbc);
        $arraypaciente = mysqli_fetch_array($consultapacientes); global $arraypaciente;
        $arraypsico = mysqli_fetch_array($consultpsicologo); global $arraypsico;
        ?>
        <div class="buscar" name="modificarpaciente">
            <form method="post" action="mpaciente.php<?php echo '?var='.$permiso.'&var2='.$idusua.'&var3='.$seccion.'&var4='.$psico.'&var5='.$idreg.'&var6=1';?>">
                NOMBRE <input autofocus required name="nombre" readonly="readonly" type="text" value ="<?php echo $arraypaciente[1]; ?>"><br>
                TELEFONO <input required name="telefono" type="text" value ="<?php echo $arraypaciente[2]; ?>"><br>
                SALDO <input name="saldo" type="text" value ="<?php echo $arraypaciente[3]; ?>"><br>
                REFERENCIA <input required type="text" name="referencia" value ="<?php echo $arraypaciente[4]; ?>"><br>
                PSICOLOGO <input type="text" readonly="readonly" value="<?php echo $arraypsico[0]; ?>"><br>

                <input id="botonli"type="submit" value="GUARDAR PACIENTE   ">
                <a id="botonli"href="inicio.php<?php echo '?var='.$permiso.'&var2='.$idusua.'&var3='.$seccion.'&var4='.$psico;?>"> VOLVER </a>
            </form>
        </div>
    </body>
</html>