<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
<?php

require_once ("../modelos/modelo.php");
include_once("claseLogin.php");
include_once("claseInstitucion.php");

$institucion = new Institucion(); // pedir usar el modelo
	$target_path="../vistas/imagenes/";

	$result = $institucion->Consecutivo();
	$jsondecode = json_decode($result,true);
	$consecutivoid = $jsondecode[0]["Consecutivo"];
	$consecutivoid++;
	$RandomString = $institucion->generateRandomString(5);
	$nombreImagen= "INST".$consecutivoid."_".$RandomString.".jpg";
	$target_path=$target_path.$nombreImagen;

	if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'],$target_path) == false)
		echo "There was an error uploading the file, please try again.";



$institucion->insertarInstitucion($_POST['usuario'],$_POST['password'],$_POST['institucion'],$nombreImagen); //usar la funcion designada

$user = $_POST['usuario'];
$pass = $_POST['password'];
	
		
$login=new Login();

$bandera = $login->login($user,$pass);

//echo"<div align=center><META HTTP-EQUIV='refresh' content='3; URL=../view/Lobby.php'/>//<br>";	
//echo"Conectando...</div>";
if($bandera==1){
echo '<div align="center">
<META HTTP-EQUIV="refresh" content="1; URL=../index.php"/>
  <img src="../vistas/imagenes/loaderGif.gif" style="width:128px;height:128px;"></div>';
}

if($bandera==0){
echo '<div align="center">
<META HTTP-EQUIV="refresh" content="1; URL=../index.php"/>
  <img src="../vistas/imagenes/loaderGif.gif" style="width:128px;height:128px;"></div>';
}
?>