<?php
  require('conector.php');

  $con=new ConectorBD('localhost','user_prueba','12345');
  $response['conexion']=$con->initConexion('agenda');

  if($response['conexion']=='OK'){
    session_start();
    if($con->eliminarRegistro('eventos','id="'.$_POST['id'].'"')){
      $response['msg']="OK";
    }
    else{
      $response['msg']= "Error al eliminar el evento";
    }
  }
  else{
    $response['msg']='No se pudo conectar a la BD';
  }

  echo json_encode($response);

  $con->cerrarConexion();
 ?>
