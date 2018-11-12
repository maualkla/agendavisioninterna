<?php
$lev = 0;
$paso = 0;
$user = $_REQUEST['user'];
$psico = $_REQUEST['psico'];
$pass = $_REQUEST['contra'];
$secre = 'SELECT * FROM secretaria';
$psicologo = 'SELECT * FROM psicologo';
require_once("conectar.php");
$consultasecre = mysqli_query($dbc,$secre) or die ("Error: ".mysqli_error($dbc));
$consultapsico = mysqli_query($dbc,$psicologo) or die ("Error: ".mysqli_error($dbc));
mysqli_close($dbc);
while($row2 = mysqli_fetch_array($consultasecre, MYSQLI_BOTH))
{
    if(($row2[4]==$user)&&($row2[5]==$pass))
    {
        while($row3 = mysqli_fetch_array($consultapsico, MYSQLI_BOTH))
        {
            if($psico == $row3[4])
            {
                $id = $row2[0];
                $psico = $row3[0];
                $paso = 1;
                $lev = 0;
            }
        }
    }
} 

if($paso == 0)
{
  
    while($row1 = mysqli_fetch_array($consultapsico, MYSQLI_BOTH))
    {
        if(($row1[4]==$user)&&($row1[5]==$pass))
        {
            $id = $row1[0];
            $paso = 1;
            $lev = 1;
        }
    }
}

if($paso == 1)
{
    if($lev == 0)
    {
        session_start();
        $_SESSION['sesion'] = '####%%';
        $_SESSION['status'] = $lev;
        $_SESSION['idusua'] = $id;
        $_SESSION['seccion'] = 1;
        $_SESSION['psico'] = $psico;
        header('Location: inicio.php?');   
    }
    else
    {
        session_start();
        $_SESSION['sesion'] = '####%%';
        $_SESSION['status'] = $lev;
        $_SESSION['idusua'] = $id;
        $_SESSION['psico'] = 0;
        header('Location: inicio.php?var='.$lev.'&var2='.$id.'&var3=1&var4=0');
    }
}
else
{
    header('Location: index.html');
}
?>