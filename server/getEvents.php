<?php
  require('conector.php');

  $con=new ConectorBD('localhost','user_prueba','12345');
  $response['conexion']=$con->initConexion('agenda');

  if($response['conexion']=='OK'){
    session_start();
    $consulta=$con->consultar(['eventos'],['id','titulo','fecInicio'],
                    'where idUser="'.$_SESSION['username'].'"');
    if($consulta->num_rows!=0){
      $fila=$consulta->fetch_assoc();
      $response['eventos']=$fila;
      $response['msg'] = 'OK';
    }
    else{
      $response['msg'] = 'No hay eventos para el usuario en la BD';
    }
  }

  echo json_encode($response);

  $con->cerrarConexion();
 ?>
