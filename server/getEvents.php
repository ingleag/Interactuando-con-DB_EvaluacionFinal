<?php

session_start();
if (isset($_SESSION['id'])) {
  require('database.php');
  $con = new ConectorBD();

  if ($con->initConexion()=='OK'){
    if ($resultado = $con->consultar(['eventos'], ['*'], "id_usuario = ".$_SESSION['id'])){
      $i=0;
      while ($fila = $resultado->fetch_assoc()) {
        $response['eventos'][$i]['id'] = $fila['id'];
        $response['eventos'][$i]['title'] = $fila['titulo'];
        $response['eventos'][$i]['start'] = $fila['fecha_ini'];
        if ($fila['todo_dia'] == 1) {
          $response['eventos'][$i]['allDay'] = true;
        }else {
          $response['eventos'][$i]['allDay'] = false;
        }
        $response['eventos'][$i]['end'] = $fila['fecha_fin'];
        $i++;
      }
      $response['msg'] = "OK";
    }else {
      $response['msg'] = "Error al consultar los eventos";
    }
  }else {
    $response['msg'] = "Se presentó un error en la conexión";
  }
}else {
  $response['msg'] = "No se ha iniciado una sesión";
}

echo json_encode($response);


 ?>
