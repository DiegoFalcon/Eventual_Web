<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href=
"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
<?php

if (isset($_COOKIE['usuario'])) {
            unset($_COOKIE['usuarioid']);
            unset($_COOKIE['usuario']);
            unset($_COOKIE['password']);
             unset($_COOKIE['institucion']);
              setcookie('usuarioid', null, -1, '/');
            setcookie('usuario', null, -1, '/');
            setcookie('password', null, -1, '/');
            
			
			echo '<div align="center">
<META HTTP-EQUIV="refresh" content="1; URL=../index.php"/>
  <img src="../vistas/imagenes/loaderGif.gif" style="width:128px;height:128px;"></div>';
}
         else {
         echo '<div align="center">
<META HTTP-EQUIV="refresh" content="1; URL=../index.php"/>
  <img src="../vistas/imagenes/loaderGif.gif" style="width:128px;height:128px;"></div>';
        }
?>