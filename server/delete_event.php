<?php

session_start();
if (isset($_SESSION['id'])) {
  require('database.php');
  $con = new ConectorBD();

  if ($con->initConexion()=='OK'){
    if ($resultado = $con->eliminarRegistro('eventos', "id = ".$_POST['id']." AND id_usuario = ".$_SESSION['id'])){
      $response['msg'] = "OK";
    }else {
      $response['msg'] = "Error al consultar el evento";
      $response['msg'] = $resultado;
    }
  }else {
    $response['msg'] = "Se presentó un error en la conexión";
  }
}else {
  $response['msg'] = "No se ha iniciado una sesión";
}

echo json_encode($response);
 ?>
