<?php include("seuridad.php"); ?>
<html>
    <head>
        <title>
            Buscar 
        </title>
        <link rel="shortcut icon" href="data/logo - copia.ico.png">
    </head>
    <body class="bodybus">
    <link rel="stylesheet" href="css/style.css">
        <?php 
        echo '<p style="display:none">';
        $permiso = $_REQUEST['var']; global $permiso; 
        $idusua = $_REQUEST['var2']; global $idusua; 
        $seccion = $_REQUEST['var3']; global $seccion;
        $psico = $_REQUEST['var4'];global $psico;
        $quien = $_REQUEST['var5'];global $quien;
        require_once("conectar.php");
        if($quien == 1)
        {
            $paciente = 'SELECT * FROM paciente WHERE nombre = "'.$_REQUEST['pacientes'].'"';
            $consultap = mysqli_query($dbc, $paciente) or die ("Error ".mysqli_error($dbc));
            $arrayp = mysqli_fetch_array($consultap);
            $busqueda = 'SELECT * FROM citas WHERE fecha = "'.$_POST['fecha'].'" OR hora = "'.$_REQUEST['hora'].'" OR id_pac = "'.$arrayp[0].'"';
            $consultab = mysqli_query($dbc,$busqueda) or die ("Error ".mysqli_error($dbc));
            echo '</p>';
            echo '<table id="citatable" >
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
                 </thead>';
            $arrayb = mysqli_fetch_array($consultab);
            
                 echo
                     '<tr><td>'.$arrayb[0].'</td><td>'.$arrayb[1].'</td><td>'.$arrayb[2].'</td><td>'.$arrayb[3].'</td><td>'.$arrayb[4].'</td><td>'.$arrayb[5].'</td>
                     <td>'.$arrayb[6].'</td>
                     <td>'.$arrayb[7].'</td>
                     <td>'.$arrayb[8].'</td>
                     <td>'.$arrayb[9].'</td>
                     <td><a href="modificarcita.php?var='.$permiso.'&var2='.$idusua.'&var3='.$seccion.'&var4='.$psico.'&var5='.$arrayb[0].'"><i class="fas fa-pen-square"></i></a></td><td><a href="mcita.php?var='.$permiso.'&var2='.$idusua.'&var3='.$seccion.'&var4='.$psico.'&var5='.$arrayb[0].'&var6=2"><i class="fas fa-trash-alt"></i></a></td></tr>';
            
            echo'</table> <br><br><br><a id="botonli" href="inicio.php?var='.$permiso.'&var2='.$idusua.'&var3='.$seccion.'&var4='.$psico.'">REGRESAR</a>';
        }
        
        if($quien == 2)
        {
            echo '<p style="display:none">';
            $paciente = 'SELECT * FROM paciente WHERE nombre = "'.$_REQUEST['nombre'].'" OR telefono = "'.$_REQUEST['telefono'].'"';
            $consultap = mysqli_query($dbc,$paciente) or die ("Error: ".mysqli_error($dbc));
            echo '</p>';
            echo '<table>
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
                 </thead>';
            while($arrayp = mysqli_fetch_array($consultap))
            {
                echo'<tr><td>'.$arrayp[0].'</td><td>'.$arrayp[1].'</td><td>'.$arrayp[2].'</td><td>'.$arrayp[3].'</td><td>'.$arrayp[4].'</td><td>'.$arrayp[5].'</td><td><a href="modificarpaciente.php?var='.$permiso.'&var2='.$idusua.'&var3='.$seccion.'&var4='.$psico.'&var5='.$arrayp[0].'>E<i class="fas fa-pen-square"></i></a></td><td><a href="mpaciente.php?var='.$permiso.'&var2='.$idusua.'&var3='.$seccion.'&var4='.$psico.'&var5='.$arrayp[0].'&var6=2"><i class="fas fa-trash-alt"></i></a></td></tr>';
            }
            echo '</table> <br><br><br><a id="botonli" href="inicio.php?var='.$permiso.'&var2='.$idusua.'&var3='.$seccion.'&var4='.$psico.'">REGRESAR</a>';
        }
        
        if($quien == 3)
        {
            echo '<p style="display:none">';
            $pac = 'SELECT * FROM paciente WHERE nombre = "'.$_REQUEST['pacientes'].'"';
            $cpac = mysqli_query($dbc,$pac) or die ("Error: ".mysqli_error($dbc));
            $arrayp = mysqli_fetch_array($cpac);
            $nota = 'SELECT * FROM notas WHERE titulo LIKE "%'.$_REQUEST['titulo'].'%" OR id_pac = "'.$arrayp[0].'"';
            $consultan = mysqli_query($dbc,$nota) or die ("Error: ".mysqli_error($dbc));
            echo '</p>';
            echo '<table>
                <thead>
                      <tr>
                        <th>ID</th>
                        <th>Paciente</th>
                        <th>Titulo</th>
                        <th>Contenido</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                      </tr>
                 </thead>';
            while($arrayn = mysqli_fetch_array($consultan))
            {
                echo'<tr><td>'.$arrayn[0].'</td><td>'.$arrayn[1].'</td><td>'.$arrayn[2].'</td><td>'.$arrayn[3].'</td><td><a href="modificarnota.php?var='.$permiso.'&var2='.$idusua.'&var3='.$seccion.'&var4='.$psico.'&var5='.$arrayn[0].'"><i id="editicon" class="fas fa-pen-square"></i></a></td><td><a href="mnota.php?var='.$permiso.'&var2='.$idusua.'&var3='.$seccion.'&var4='.$psico.'&var5='.$arrayn[0].'&var6=2"><i id="trashicon" class="fas fa-trash-alt"></i></a></td></tr>';
            }
            echo '</table><br><br><br> <a id="botonli" href="inicio.php?var='.$permiso.'&var2='.$idusua.'&var3='.$seccion.'&var4='.$psico.'">REGRESAR</a>';
        }
        
        mysqli_close($dbc);
        ?>
        
    </body>
</html>