<?php

session_start();
require('database.php');

if ($_SESSION['id'] > 0) {
  $con = new ConectorBD();

  $error = "";

  if ($con->initConexion()=='OK'){
    if (strlen($_POST['start_date']) > 0) {
      $datos['fecha_ini'] = $_POST['start_date'];
      if (strlen($_POST['start_hour']) > 0) {
        $datos['fecha_ini'] = $datos['fecha_ini']." ".$_POST['start_hour'];
      }
    }

    if (strlen($_POST['end_date']) > 0) {
      $datos['fecha_fin'] = $_POST['end_date'];
      if (strlen($_POST['end_hour']) > 0) {
        $datos['fecha_fin'] = $datos['fecha_fin']." ".$_POST['end_hour'];
      }
    }
    
    if ($con->actualizarRegistro('eventos', $datos, 'id = '.$_POST['id'].' AND id_usuario = '.$_SESSION['id'])) {
    }else $error = "Error al modificar el Evento";

    $con->cerrarConexion();
  }else {
    $error = "Se presentó un error en la conexión";
  }

  if ($error == "") {
    $response['msg'] = "OK";
  }else{
    $response['msg'] = $error;
  }
}else {
  $response['msg'] = "No existe sessión activa";
}


echo json_encode($response);


 ?>
