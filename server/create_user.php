<?php

require('database.php');
$con = new ConectorBD();

$error = "";

if ($con->initConexion()=='OK'){

  if ($resultado = $con->consultar(['usuarios'], ['id'], "email = 'user1@pruebas.com'")){
    if ($resultado->num_rows > 0) {
    }else {
      $datos['email'] = "user1@pruebas.com";
      $datos['nombre'] = "Usuario 1";
      $datos['fecha_nace'] = "19810204";
      $datos['contrasena'] = password_hash('12345', PASSWORD_DEFAULT);
      if ($con->insertData('usuarios', $datos)) {
      }else $error = "Error al insertar el usuario1";
    }
  }

  if ($resultado = $con->consultar(['usuarios'], ['id'], "email = 'user2@pruebas.com'")){
    if ($resultado->num_rows > 0) {
    }else {
      $datos['email'] = "user2@pruebas.com";
      $datos['nombre'] = "Usuario 2";
      $datos['fecha_nace'] = "19811214";
      $datos['contrasena'] = password_hash('12345', PASSWORD_DEFAULT);
      if ($con->insertData('usuarios', $datos)) {
      }else $error = "Error al insertar el usuario2";
    }
  }

  if ($resultado = $con->consultar(['usuarios'], ['id'], "email = 'user3@pruebas.com'")){
    if ($resultado->num_rows > 0) {
    }else {
      $datos['email'] = "user3@pruebas.com";
      $datos['nombre'] = "Usuario 3";
      $datos['fecha_nace'] = "19910510";
      $datos['contrasena'] = password_hash('12345', PASSWORD_DEFAULT);
      if ($con->insertData('usuarios', $datos)) {
      }else $error = "Error al insertar el usuario3";
    }
  }

  $con->cerrarConexion();
}else {
  $error = "Se presentó un error en la conexión";
}

if ($error == "") {
  $response['msg'] = "OK";
}else{
  $response['msg'] = $error;
}

echo json_encode($response);
?>
