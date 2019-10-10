<?php
  require('conector.php');

  $data['fecInicio']="'".$_POST['start_date']."'";
  $data['horaInicio']="'".$_POST['start_hour']."'";
  $data['fecFin']="'".$_POST['end_date']."'";
  $data['horaFin']="'".$_POST['end_hour']."'";

  $con=new ConectorBD('localhost','user_prueba','12345');
  $response['conexion']=$con->initConexion('agenda');

  if($response['conexion']=='OK'){
    if($con->actualizarRegistro('eventos', $data,'id="'.$_POST['id'].'"')){
      $response['msg']="OK";
    }else {
      $response['msg']= "Error al actualizar el evento";
    }
  }
  else{
    $response['msg']='No se pudo conectar a la BD';
  }

  echo json_encode($response);

  $con->cerrarConexion();
?>
