<?php include("seuridad.php"); ?>
<html>
    <head>
        <title> MODIFICAR CITA </title>
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
        $cita = 'SELECT fecha,hora, (SELECT nombre FROM paciente WHERE id_pac = citas.id_pac), tarifa, pagado, presencial, confirmacion FROM citas WHERE id_cita = "'.$idreg.'"';
        require_once("conectar.php");
        $consultacita = mysqli_query($dbc,$cita) or die ("Error: ".mysqli_error($dbc));
        mysqli_close($dbc);
        $arraycita = mysqli_fetch_array($consultacita); global $arraycita;
        ?>
        <div class="buscar"name="modificarcita">
            <form method="post" action="mcita.php<?php echo '?var='.$permiso.'&var2='.$idusua.'&var3='.$seccion.'&var4='.$psico.'&var5='.$idreg.'&var6=1';?>">
                FECHA <input autofocus required name="fecha" type="date" value="<?php echo $arraycita[0]; ?>"><br>
                HORA <input required name="hora" type="time" value="<?php echo $arraycita[1]; ?>"><br>
                PACIENTE<input type="text" readonly="readonly" name = "pacientes" value = "<?php echo $arraycita[2]; ?>"><br>
                TARIFA <input required name="tarifa" type="text" value="<?php echo $arraycita[3]; ?>"><br>
                PAGADO <input type="radio" name="pagado" value="0" <?php if($arraycita['pagado'] == 0){echo 'checked';}?>> NO <input type="radio" name="pagado" value="1" <?php if($arraycita['pagado'] == 1){echo 'checked';} ?>> SI <br>
                PRESENCIAL <input type="radio" name="presencial" value="0" <?php if($arraycita['presencial'] == 0){echo 'checked';} ?>> NO <input type="radio" name="presencial" value="1" <?php if($arraycita['presencial'] == 1){echo 'checked';} ?>> SI <br>
                CONFIRMADO <input type="radio" name="confirmado" value="0" <?php if($arraycita['confirmacion'] == 0){echo 'checked';} ?>> NO <input type="radio" name="confirmado" value="1" <?php if($arraycita['confirmacion'] == 1){echo 'checked';} ?>> SI <br>
                <input id="botonli" type="submit" value="MODIFICAR CITA">
                <a  id="botonli" href="inicio.php<?php echo '?var='.$permiso.'&var2='.$idusua.'&var3='.$seccion.'&var4='.$psico;?>"> VOLVER </a>
            </form>
        </div>
    </body>
</html>