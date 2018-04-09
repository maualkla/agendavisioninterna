<html>
    <head>
        <title>  
            <?php
            $permiso = $_REQUEST['var']; global $permiso;
            $idusua = $_REQUEST['var2']; global $idusua;
            $seccion = $_REQUEST['var3']; global $seccion;
            $psico = $_REQUEST['var4'];global $psico;
            
            if($permiso == 0)
            {
                $usuario = 'SELECT * FROM secretaria WHERE id_secretaria = "'.$idusua.'"';
                $psicolog = 'SELECT * FROM psicologo WHERE id_psc = "'.$psico.'"';
                $citas = 'SELECT * FROM citas WHERE id_psc = "'.$psico.'"';
                $pacientes = 'SELECT * FROM paciente WHERE id_psc = "'.$psico.'"';
                $notas = 'SELECT * FROM notas INNER JOIN paciente ON notas.id_pac = paciente.id_pac AND paciente.id_psc = "'.$psico.'"';
            }
            else
            {
                $usuario = 'SELECT * FROM psicologo WHERE id_psc = "'.$idusua.'"';
                $citas = 'SELECT * FROM citas WHERE id_psc = "'.$idusua.'"';
                $pacientes = 'SELECT * FROM paciente WHERE id_psc = "'.$idusua.'"';
                $notas = 'SELECT * FROM notas INNER JOIN paciente ON notas.id_pac = paciente.id_pac AND paciente.id_psc = "'.$idusua.'"';
            }
            
            require_once("conectar.php");
            if($permiso == 0)
            {
                $consultausuario = mysqli_query($dbc,$usuario) or die ("Error: ".mysqli_error($dbc)); global $consultausuario;
                $consultapsico = mysqli_query($dbc,$psicolog) or die ("Error: ".mysqli_error($dbc)); global $consultapsico;
                $consultacitas = mysqli_query($dbc,$citas) or die ("Error: ".mysqli_error($dbc)); global $consultacitas;
                $consultapacientes = mysqli_query($dbc,$pacientes) or die ("Error: ".mysqli_error($dbc)); global $consultapacientes;
                $consultanotas = mysqli_query($dbc,$notas) or die ("Error: ".mysqli_error($dbc)); global $consultanotas;
            }
            else
            {
                $consultausuario = mysqli_query($dbc,$usuario) or die ("Error: ".mysqli_error($dbc)); global $consultausuario;
                $consultacitas = mysqli_query($dbc,$citas) or die ("Error: ".mysqli_error($dbc)); global $consultacitas;
                $consultapacientes = mysqli_query($dbc,$pacientes) or die ("Error: ".mysqli_error($dbc)); global $consultapacientes;
                $consultanotas = mysqli_query($dbc,$notas) or die ("Error: ".mysqli_error($dbc)); global $consultanotas;
            }
            mysqli_close($dbc);
            $datosusua = mysqli_fetch_array($consultausuario);        
            if($seccion == 1)
            {
                echo 'Calendario - '.$datosusua[1];
            }
            if($seccion == 2)
            {
                echo 'Agenda - '.$datosusua[1];
            }
            if($seccion == 3)
            {
                echo 'Notas - '.$datosusua[1];
            }
            
            ?>
        </title>
        <link rel="shortcut icon" href="data/logo - copia.ico.png">
    </head>
    <body>
        <header>
            <p><?php $arraypsico = mysqli_fetch_array($consultapsico); echo $arraypsico[1];?></p>
            <nav>
                <ul> CALENDARIO </ul>
                <ul> AGENDA </ul>
                <ul> NOTAS </ul>
            </nav>
            <p><a href="index.html"> CERRAR SESION </a></p>
        </header>
        <div name="calendario">
            <div name="agregarcita">
                <form name="formagregarcita" method="post" action="agregarcita.php">
                    
                </form> 
            </div>
        </div>
    </body>
</html>