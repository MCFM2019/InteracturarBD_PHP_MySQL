<?php
  require('conector.php');

  $con=new ConectorBD('localhost','user_prueba','12345');
  $response['conexion']=$con->initConexion('agenda');

  if($response['conexion']=='OK'){
    $consulta=$con->consultar(['usuarios'],['email','password'],
                    'where email="'.$_POST['username'].'"');
    if($consulta->num_rows!=0){
        $fila=$consulta->fetch_assoc();
        $hash=password_hash($fila['password'],PASSWORD_DEFAULT);
        if (password_verify($_POST['password'],$hash )) {
          $response['msg'] = 'OK';
          session_start();
          $_SESSION['username']=$fila['email'];
        }
        else{
          $response['msg'] = 'Contraseña incorrecta';
        }
    }
    else{
      $response['msg'] = 'Usuario no encontrado en la BD';
    }
  }

  echo json_encode($response);

  $con->cerrarConexion();
 ?>
