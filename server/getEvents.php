<?php
  require('conector.php');

  $con=new ConectorBD('localhost','user_prueba','12345');
  $response['conexion']=$con->initConexion('agenda');

  if($response['conexion']=='OK'){
    session_start();
    $consulta=$con->consultar(['eventos'],['id','titulo as title','fecInicio as start','fecFin as end'],
                    'where idUser="'.$_SESSION['username'].'"');
    if($consulta->num_rows!=0){
      $i=0;
      while ($fila = $consulta->fetch_assoc()) {
        $response['eventos'][$i]['id']=$fila['id'];
        $response['eventos'][$i]['title']=$fila['title'];
        $response['eventos'][$i]['start']=$fila['start'];
        $response['eventos'][$i]['end']=$fila['end'];
        $i++;
      }
      $response['msg'] = 'OK';
    }
    else{
      $response['msg'] = 'No hay eventos para el usuario en la BD';
    }
  }

  echo json_encode($response);

  $con->cerrarConexion();
 ?>
