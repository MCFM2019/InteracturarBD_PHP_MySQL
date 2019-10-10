<?php
  require('conector.php');

  $data['titulo']="'".$_POST['titulo']."'";
  $data['fecInicio']="'".$_POST['start_date']."'";
  $data['horaInicio']="'".$_POST['start_hour']."'";
  $data['fecFin']="'".$_POST['end_date']."'";
  $data['horaFin']="'".$_POST['end_hour']."'";
  if ($_POST['allDay']== true) {
    $data['diaCompleto']=1;
  }else {
    $data['diaCompleto']=0;
  }
  session_start();
  $data['idUser']="'".$_SESSION['username']."'";

  $con=new ConectorBD('localhost','user_prueba','12345');
  $response['conexion']=$con->initConexion('agenda');

  if($response['conexion']=='OK'){
    if($con->insertData('eventos', $data)){
      $response['msg']="OK";
    }else {
      $response['msg']= "Error al crear el evento";
    }
  }
  else{
    $response['msg']='No se pudo conectar a la BD';
  }

  echo json_encode($response);

  $con->cerrarConexion();
 ?>
