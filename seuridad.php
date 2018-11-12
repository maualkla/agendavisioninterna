<?php
//Continuar Sesion}
@session_start();
if($_SESSION['sesion'] != '####%%')
{
    // En caso de no haber iniciado sesion, se le redirecciona.
    header("Location: index.html");
    exit();
}
?>