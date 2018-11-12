<?php include("seuridad.php"); ?>
<html>
    <head>
        <link rel="stylesheet" href="css/style.css" type="text/css">
        <script src="js/fontawesome-all.js"></script>
        <script type = "text/javascript" src="js/inicio.js"></script>
        <script src="js/jquery-3.3.1.min.js"></script>
        <title>  
            <?php
            $permiso = $_SESSION['status']; global $permiso; 
            $idusua = $_SESSION['idusua']; global $idusua; 
            $seccion = $_SESSION['seccion']; global $seccion;
            $psico = $_SESSION['psico'];global $psico; 
            
            if($permiso == 0)
            {
                $usuario = 'SELECT * FROM secretaria WHERE id_secretaria = "'.$idusua.'"';
                $psicolog = 'SELECT * FROM psicologo WHERE id_psc = "'.$psico.'"';
                $citas = 'SELECT id_cita, fecha, hora, (SELECT nombre FROM paciente WHERE id_pac = citas.id_pac), (SELECT nombre FROM psicologo WHERE id_psc = citas.id_psc), (SELECT nombre FROM secretaria WHERE id_secretaria = citas.id_secretaria), tarifa, pagado, presencial, confirmacion FROM citas WHERE id_psc = "'.$psico.'" ORDER BY fecha ASC';
                $pacientes = 'SELECT * FROM paciente WHERE id_psc = "'.$psico.'"';
                $notas = 'SELECT * FROM notas WHERE id_secretaria = "'.$idusua.'"';
            }
            else
            {
                $usuario = 'SELECT * FROM psicologo WHERE id_psc = "'.$idusua.'"';
                $citas = 'SELECT * FROM citas WHERE id_psc = "'.$idusua.'"';
                $pacientes = 'SELECT * FROM paciente WHERE id_psc = "'.$idusua.'" ORDER BY fecha ASC';
                $notas = 'SELECT * FROM notas ';
            }
            
            require_once("conectar.php");
            if($permiso == 0)
            {
                $consultausuario = mysqli_query($dbc,$usuario) or die ("Error: ".mysqli_error($dbc)); global $consultausuario;
                $consultapsico = mysqli_query($dbc,$psicolog) or die ("Error: ".mysqli_error($dbc)); global $consultapsico;
                $consultacitas = mysqli_query($dbc,$citas) or die ("Error: ".mysqli_error($dbc)); global $consultacitas;
                $consultapacientes = mysqli_query($dbc,$pacientes) or die ("Error: ".mysqli_error($dbc)); global $consultapacientes;
                $consultapacientes2 = mysqli_query($dbc,$pacientes) or die ("Error: ".mysqli_error($dbc)); global $consultapacientes2;
                $consultanotas = mysqli_query($dbc,$notas) or die ("Error: ".mysqli_error($dbc)); global $consultanotas;
            }
            else
            {
                $consultausuario = mysqli_query($dbc,$usuario) or die ("Error: ".mysqli_error($dbc)); global $consultausuario;
                $consultacitas = mysqli_query($dbc,$citas) or die ("Error: ".mysqli_error($dbc)); global $consultacitas;
                $consultapacientes = mysqli_query($dbc,$pacientes) or die ("Error: ".mysqli_error($dbc)); global $consultapacientes;
                $consultapacientes2 = mysqli_query($dbc,$pacientes) or die ("Error: ".mysqli_error($dbc)); global $consultapacientes2;
                $consultanotas = mysqli_query($dbc,$notas) or die ("Error: ".mysqli_error($dbc)); global $consultanotas;
            }
            mysqli_close($dbc);
            $datosusua = mysqli_fetch_array($consultausuario);        
            if($seccion == 1)
            {
                echo 'Calendario - ';
            }
            if($seccion == 2)
            {
                echo 'Agenda - ';
            }
            if($seccion == 3)
            {
                echo 'Notas - ';
            }
            
            ?>
        </title>
        <link rel="shortcut icon" href="data/logo - copia.ico.png">
    </head>
    <body class="bodyin" onload="nobackbutton();">
        <header>
            <div class="navbar">
            <span id="title">VISIÓN</span> 
            <img src="data/logo.png" id="logo1" height="45px">
            <span id="title2">INTERNA</span>
            <p id="pscname">
                <?php 
                if($permiso == 0)
                {
                    $arraypsico = mysqli_fetch_array($consultapsico); 
                    echo $arraypsico[1];
                }
                else
                {
                    $arrayusuario = mysqli_fetch_array($consultausuario); 
                    echo $arrayusuario[1];
                }
                ?>
            </p>
            <p id="plogout"><a href="close.php"> <i id="logout" class="fas fa-sign-out-alt"></i></a></p>
            </div>
            
            <div class="navbarlat">
                <ul id="cal" onclick="calendario()" > <i class="far fa-calendar-alt" id="laticon"></i> <br>CALENDARIO </ul>
                <ul id="age" onclick="agenda()" > <i class="fas fa-address-book" id="laticon"></i> <br>AGENDA </ul>
                <ul id="not" onclick="notas()"> <i class="fas fa-sticky-note" id="laticon"></i><br>NOTAS </ul>
            </div>
            
        </header>
        <div class="rectsup"></div>
        <div name="calendario" class="contenido" id="calendario">
            <div name="agregarcita">
                <form id="formcita" name="formagregarcita" method="post" action="agregarcita.php<?php echo '?var='.$permiso.'&var2='.$idusua.'&var3='.$seccion.'&var4='.$psico;?>">
                    <l>FECHA: <input autofocus required name="fecha" type="date" min="2018-04-09" max="2018-06-30"></l>
                    <l>HORA: <input required name="hora" type="time"></l>
                    <l>PACIENTE: <input required type="text" list="pacientes" name="pacientes" placeholder="Nombre" pattern="[A-Z a-z ]{3-50}" ><datalist id="pacientes"><?php while($arraypaciente = mysqli_fetch_array($consultapacientes)){echo'<option value="'.$arraypaciente[1].'">'.$arraypaciente[0].'</option>';} ?></datalist></l>
                    <l>TARIFA: <input required name="tarifa" type="text" placeholder="0.0" pattern="[0-9 .]{2-6}"></l>
                    <l>PAGADO: <input type="radio" name="pagado" value="0"> NO <input type="radio" name="pagado" value="1"> SI </l>
                    <l>PRESENCIAL: <input type="radio" name="presencial" value="0"> NO <input type="radio" name="presencial" value="1"> SI </l>
                    <l>CONFIRMADO: <input type="radio" name="confirmado" value="0"> NO <input type="radio" name="confirmado" value="1"> SI </l>
                    <l><input class="botonform" type="submit" name="agregar" value="CREAR CITA" ></l>
                    <l><a href="buscar.php<?php echo '?var='.$permiso.'&var2='.$idusua.'&var3='.$seccion.'&var4='.$psico.'&var5=1';?>"><input class="botonform" type="button" name="buscar" value="BUSCAR CITA" ></a></l>
                </form>
            </div>
            <div class="list" name="contenidocita">
                <table id="citatable" >
                 <thead>
                      <tr>
                        <th>ID</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Paciente</th>
                        <th>Psicologo</th>
                        <th>Secretaria</th>
                        <th>Tarifa</th>
                        <th>Pagado</th>
                        <th>Presencial</th>
                        <th>Confirmación</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                          
                      </tr>
                 </thead>
                <?php 
                while($arraycita = mysqli_fetch_array($consultacitas))
                {
                    echo'<tr><td>'.$arraycita[0].'</td><td>'.$arraycita[1].'</td><td>'.$arraycita[2].'</td><td>'.$arraycita[3].'</td><td>'.$arraycita[4].'</td><td>'.$arraycita[5].'</td><td>'.$arraycita[6].'</td><td>';if($arraycita[7] == 1){echo "<p id='si'>SI</p>";}else{echo"<p id='no'>NO</p>";}echo'</td><td>';if($arraycita[8] == 1){echo "<p id='si'>SI</p>";}else{echo"<p id='no'>NO</p>";}echo'</td><td>';if($arraycita[9] == 1){echo "<p id='si'>SI</p>";}else{echo"<p id='no'>NO</p>";}echo'</td><td><a href="modificarcita.php?var='.$permiso.'&var2='.$idusua.'&var3='.$seccion.'&var4='.$psico.'&var5='.$arraycita[0].'"><i id="editicon" class="fas fa-pen-square"></i></a></td><td><a href="mcita.php?var='.$permiso.'&var2='.$idusua.'&var3='.$seccion.'&var4='.$psico.'&var5='.$arraycita[0].'&var6=2"><i id="trashicon" class="fas fa-trash-alt"></i></a></td></tr>';
                }
                ?>
                </table>
            </div>
        </div>
        <div name="agenda" class="contenido" id="agenda">
            <div name="agregarpaciente">
                <form id="formpaciente" name="formagregarpaciente" method="post" action="agregarpaciente.php<?php echo '?var='.$permiso.'&var2='.$idusua.'&var3='.$seccion.'&var4='.$psico;?>">
                    <l>NOMBRE: <input autofocus required name="nombre" type="text" placeholder="Nombre" pattern="[A-Z a-z ]{3-50}"></l>
                    <l>TELEFONO: <input required name="telefono" type="text" placeholder="Telefono" pattern="[0-9]{10}"></l>
                    <l>SALDO: <input name="saldo" placeholder="0.0" pattern="[0-9 .]{3-6}"type="text"></l>
                    <l>REFERENCIA: <input required type="text" name="referencia" placeholder="De donde viene este paciente" pattern="[A-Z a-z ]{3-50}"></l>
                    <l><input class="botonform" type="submit" name="agregar" value="AGREGAR PACIENTE" ></l>
                    <l><a href="buscar.php<?php echo '?var='.$permiso.'&var2='.$idusua.'&var3='.$seccion.'&var4='.$psico.'&var5=2';?>"><input class="botonform" type="button" name="buscar" value="BUSCAR PACIENTE" ></a></l>
                </form> 
            </div>
            <div class="list" name="contenidopaciente">
                <table>
                <thead>
                      <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Tel.</th>
                        <th>Saldo</th>
                        <th>Referencia</th>
                        <th>Psicologa</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                      </tr>
                 </thead>
                <?php while($arraypaciente = mysqli_fetch_array($consultapacientes2)){echo'<tr><td>'.$arraypaciente[0].'</td><td>'.$arraypaciente[1].'</td><td>'.$arraypaciente[2].'</td><td>'.$arraypaciente[3].'</td><td>'.$arraypaciente[4].'</td><td>'.$arraypaciente[5].'</td><td><a href="modificarpaciente.php?var='.$permiso.'&var2='.$idusua.'&var3='.$seccion.'&var4='.$psico.'&var5='.$arraypaciente[0].'"><i id="editicon" class="fas fa-pen-square"></i></a></td><td><a href="mpaciente.php?var='.$permiso.'&var2='.$idusua.'&var3='.$seccion.'&var4='.$psico.'&var5='.$arraypaciente[0].'&var6=2"><i id="trashicon" class="fas fa-trash-alt"></i></a></td></tr>';}?>
                </table>
            </div>
        </div>
        <div name="notas" class="contenido" id="notas">
            <div name="agregarnota">
                <form id="formnota" name="formagregarnota" method="post" action="agregarnota.php<?php echo '?var='.$permiso.'&var2='.$idusua.'&var3='.$seccion.'&var4='.$psico;?>">
                    <l>TITULO: <input autofocus required name="titulo" type="text" placeholder="Titulo" pattern="[A-Z a-z 0-9 *]{1-25}"></l>
                    <l>PACIENTE:  <input type="text" list="pacientes" name="pacientes" placeholder="Elige un paciente"> </l>                                   
                    <l>CONTENIDO: <input required name="contenido" type="text" placeholder="Escribe aqui el contenido" pattern="[A-Z a-z 0-9 *]{1-280}" ></l>
                    <l><input class="botonform" type="submit" name="agregar" value="AGREGAR NOTA" ></l>
                    <!--l><a href="buscar.php<!--?php echo '?var='.$permiso.'&var2='.$idusua.'&var3='.$seccion.'&var4='.$psico.'&var5=3';?>"><input class="botonform" type="button" name="buscar" value="BUSCAR NOTA" ></a></l -->
                </form> 
            </div>
            <div class="list" name="contenidonota">
                <table>
                <thead>
                      <tr>
                        <th>ID</th>
                        <th>Paciente</th>
                        <th>Titulo</th>
                        <th>Contenido</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                      </tr>
                 </thead>
                <?php while($arraynota = mysqli_fetch_array($consultanotas)){echo'<tr><td>'.$arraynota[0].'</td><td>'.$arraynota[1].'</td><td>'.$arraynota[2].'</td><td>'.$arraynota[3].'</td><td><a href="modificarnota.php?var='.$permiso.'&var2='.$idusua.'&var3='.$seccion.'&var4='.$psico.'&var5='.$arraynota[0].'"><i id="editicon" class="fas fa-pen-square"></i></a></td><td><a href="mnota.php?var='.$permiso.'&var2='.$idusua.'&var3='.$seccion.'&var4='.$psico.'&var5='.$arraynota[0].'&var6=2"><i id="trashicon" class="fas fa-trash-alt"></i></a></td></tr>';}?>
                </table>
            </div>
        </div>
    </body>
</html>