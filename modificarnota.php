<?php include("seuridad.php"); ?>
<html>
    <head>
        <title> MODIFICAR NOTA </title>
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
        $notas = 'SELECT * FROM notas WHERE id_nota = "'.$idreg.'"';
        require_once("conectar.php");
        $consultanota = mysqli_query($dbc,$notas) or die ("Error: ".mysqli_error($dbc)); $arraynota = mysqli_fetch_array($consultanota);
        $paciente = 'SELECT * FROM paciente WHERE id_pac = "'.$arraynota[1].'"';
        $consultapac = mysqli_query($dbc, $paciente) or die ("Error: ".mysqli_error($dbc)); $arraypac = mysqli_fetch_array($consultapac);
        mysqli_close($dbc);
        ?>
        <div class="buscar"name="modificarpaciente">
            <form method="post" action="mnota.php<?php echo '?var='.$permiso.'&var2='.$idusua.'&var3='.$seccion.'&var4='.$psico.'&var5='.$idreg.'&var6=1';?>">
                TITULO <input autofocus required name="titulo" type="text" value = "<?php echo $arraynota[2];?>"><br>
                PACIENTE  <input type="text" readonly="readonly" name="pacientes" value = "<?php echo $arraypac[1];?>"><br>          
                CONTENIDO <input name="contenido" type="textarea" value = "<?php echo $arraynota[3];?>"><br>

                <input id="botonli"type="submit" value="GUARDAR PACIENTE">
                <a id="botonli" href="inicio.php<?php echo '?var='.$permiso.'&var2='.$idusua.'&var3='.$seccion.'&var4='.$psico;?>"> VOLVER </a>
            </form>
        </div>
    </body>
</html>