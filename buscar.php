<html>
    <head>
        <title>
            Buscar 
        </title>
        <link rel="shortcut icon" href="data/logo - copia.ico.png">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body class="bodybus">
        <?php
        $permiso = $_REQUEST['var']; global $permiso; 
        $idusua = $_REQUEST['var2']; global $idusua; 
        $seccion = $_REQUEST['var3']; global $seccion;
        $psico = $_REQUEST['var4'];global $psico;
        $quien = $_REQUEST['var5'];global $quien;
        ?>
        <div class="buscar" name="buscarcita"<?php if($quien != 1){echo 'style="display:none"';} ?> >
            <form method="post" action="buscarb.php?<?php echo '?var='.$permiso.'&var2='.$idusua.'&var3='.$seccion.'&var4='.$psico.'&var5=1';?>">
                <l id="busdate">FECHA: <input autofocus name="fecha" type="date" min="2018-04-09" max="2018-06-30"></l><br><br>
                <l id="bustime">HORA: <input name="hora" type="time"></l><br><br>
                <l id="buspas">PACIENTE: <input type="text" list="pacientes" name="pacientes" placeholder="Nombre" pattern="[A-Z a-z ]{3-50}" ><datalist id="pacientes"><?php while($arraypaciente = mysqli_fetch_array($consultapacientes)){echo'<option value="'.$arraypaciente[1].'">'.$arraypaciente[0].'</option>';} ?></datalist></l><br>
                <li id="busbus"><input id="botonli"type="submit" value=" BUSCAR "></li><br><a  id="botonli" class="busq" href="inicio.php?<?php echo 'var='.$permiso.'&var2='.$idusua.'&var3='.$seccion.'&var4='.$psico; ?>">REGRESAR</a>
            </form>
        </div>
        <div class="buscar" name="buscarpaciente" <?php if($quien != 2){echo 'style="display:none"';} ?>>
            <form method="post" action="buscarb.php<?php echo '?var='.$permiso.'&var2='.$idusua.'&var3='.$seccion.'&var4='.$psico.'&var5=2';?>">
                <l>NOMBRE: <input autofocus name="nombre" type="text"></l>
                <l>TELEFONO: <input name="telefono" type="text"></l>
                <li><input id="botonli" type="submit" value=" BUSCAR "></li>
                <a id="botonli" class="busq" href="inicio.php?<?php echo 'var='.$permiso.'&var2='.$idusua.'&var3='.$seccion.'&var4='.$psico; ?>">REGRESAR</a>
            </form>
        </div>
        <div class="buscar" name="buscarnota" <?php if($quien != 3){echo 'style="display:none"';} ?>>
            <form method="post" action="buscarb.php<?php echo '?var='.$permiso.'&var2='.$idusua.'&var3='.$seccion.'&var4='.$psico.'&var5=3';?>">
                <l>TITULO: <input name="titulo" type="text"></l>
                <l>PACIENTE:  <input type="text" list="pacientes" name="pacientes"> </l>
                <li><input id="botonli" type="submit" value=" BUSCAR "></li>
                <a class="busq"  id="botonli"href="inicio.php?<?php echo 'var='.$permiso.'&var2='.$idusua.'&var3='.$seccion.'&var4='.$psico; ?>">REGRESAR</a>
            </form>
        </div>
    </body>
</html>