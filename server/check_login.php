<?php

require('database.php');
$con = new ConectorBD();

if ($con->initConexion()=='OK'){

  if ($resultado = $con->consultar(['usuarios'], ['*'], "email = '".$_POST['username']."'")){
    if ($resultado->num_rows > 0) {
      $fila = $resultado->fetch_assoc();
      if (password_verify($_POST['password'], $fila['contrasena'])) {
        session_start();
        $_SESSION['username']=$fila['email'];
        $_SESSION['id']=$fila['id'];
        $response['msg'] = "OK";
      }else {
        $response['msg'] = "Contraseña incorrecta";
      }
    }else {
      $response['msg'] = "Usuario no existe";
    }
  }else {
    $response['msg'] = "Error al consultar el usuario";
  }
}else {
  $response['msg'] = "Se presentó un error en la conexión";
}

echo json_encode($response);
 ?>
