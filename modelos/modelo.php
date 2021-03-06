<?php
require_once("../modelos/connection.php");


class Model{

	//------FUNCION PARA LOGIN----
	public function login($user,$pass){
	$conn=new Connection();
	$query="";
	$result=NULL;
	$query = "SELECT * FROM institucion where Usuario='$user'";	
	
	//llamamos el metodo EjecutarQuery de la clase Conexion, enviando la variable $query
		$result=$conn->EjecutaQuery($query);
		
		while ($row = mysqli_fetch_row($result)){
			if($row[2]==$pass){
			$array_usuario["id"] = $row[0];
			$array_usuario["usuario"] = $row[1];
			$array_usuario["password"] = $row[2];
			$array_usuario["nombre"] = $row[3];
			$array_usuario["imagen"] = $row[4];

			}
		}
		if(!isset($array_usuario)){
		$array_usuario["usuario"] = -1;
			$array_usuario["password"] = -1;
			$array_usuario["nombre"] = -1;
			$array_usuario["imagen"] = -1;
		}
		
		return $array_usuario;
	}
	//------FUNCIONES PARA EVENTOS----
	public function eventosPresentes($FechaHoraCliente){
		$conn=new Connection();
		$query="";
		$result=NULL;
		$dt = $FechaHoraCliente->format('Y-m-d H:i:s');
		$query="SELECT eventos.EventosID,eventos.Nombre As NombreEvento,eventos.FechaHoraInicial,eventos.FechaHoraFinal,eventos.Descripcion,eventos.Imagen,categorias.Nombre As NombreCategoria,institucion.Nombre As NombreInstitucion, categorias.CategoriasID, institucion.InstitucionID,
			(SELECT AVG(Calificacion) From asistencias where asistencias.EventosID = eventos.EventosID and asistencias.Calificacion > 0) As Rating
			from eventos
			inner join categorias On categorias.CategoriasID = eventos.CategoriasID
			inner join institucion On institucion.InstitucionID = eventos.InstitucionID
			where FechaHoraInicial<='$dt' and FechaHoraFinal>='$dt'
			order by FechaHoraFinal";
		$result=$conn->EjecutaQuery($query);
	
	return $result;
	}
	public function eventosPresentes_X_InstitucionID($FechaHoraCliente,$institucionid){
		$conn=new Connection();
		$query="";
		$result=NULL;
		$dt = $FechaHoraCliente->format('Y-m-d H:i:s');
		$query="SELECT eventos.EventosID,eventos.Nombre As NombreEvento,eventos.FechaHoraInicial,eventos.FechaHoraFinal,eventos.Descripcion,eventos.Imagen,categorias.Nombre As NombreCategoria,institucion.Nombre As NombreInstitucion, categorias.CategoriasID, institucion.InstitucionID,
			(SELECT AVG(Calificacion) From asistencias where asistencias.EventosID = eventos.EventosID and asistencias.Calificacion > 0) As Rating
			from eventos
			inner join categorias On categorias.CategoriasID = eventos.CategoriasID
			inner join institucion On institucion.InstitucionID = eventos.InstitucionID
			where FechaHoraInicial<='$dt' and FechaHoraFinal>='$dt' and eventos.InstitucionID = '$institucionid'
			order by FechaHoraFinal";
		$result=$conn->EjecutaQuery($query);
	
	return $result;
	}
	public function eventosPasados($FechaHoraCliente){
		$conn=new Connection();
		$query="";
		$result=NULL;
		$dt = $FechaHoraCliente->format('Y-m-d H:i:s');
		$query="SELECT eventos.EventosID,eventos.Nombre As NombreEvento,eventos.FechaHoraInicial,eventos.FechaHoraFinal,eventos.Descripcion,eventos.Imagen,categorias.Nombre As NombreCategoria,institucion.Nombre As NombreInstitucion, categorias.CategoriasID, institucion.InstitucionID,
			(SELECT AVG(Calificacion) From asistencias where asistencias.EventosID = eventos.EventosID and asistencias.Calificacion > 0) As Rating
			from eventos
			inner join categorias On categorias.CategoriasID = eventos.CategoriasID
			inner join institucion On institucion.InstitucionID = eventos.InstitucionID
			where FechaHoraInicial<='$dt' and FechaHoraFinal<='$dt'
			order by FechaHoraFinal DESC";

		$result=$conn->EjecutaQuery($query);
	
	return $result;
	}
	public function eventosPasados_X_InstitucionID($FechaHoraCliente,$institucionid){
		$conn=new Connection();
		$query="";
		$result=NULL;
		$dt = $FechaHoraCliente->format('Y-m-d H:i:s');
		$query="SELECT eventos.EventosID,eventos.Nombre As NombreEvento,eventos.FechaHoraInicial,eventos.FechaHoraFinal,eventos.Descripcion,eventos.Imagen,categorias.Nombre As NombreCategoria,institucion.Nombre As NombreInstitucion, categorias.CategoriasID, institucion.InstitucionID,
			(SELECT AVG(Calificacion) From asistencias where asistencias.EventosID = eventos.EventosID and asistencias.Calificacion > 0) As Rating
			from eventos
			inner join categorias On categorias.CategoriasID = eventos.CategoriasID
			inner join institucion On institucion.InstitucionID = eventos.InstitucionID
			where FechaHoraInicial<='$dt' and FechaHoraFinal<='$dt' and eventos.InstitucionID = '$institucionid'
			order by FechaHoraFinal DESC";

		$result=$conn->EjecutaQuery($query);
	
	return $result;
	}
	public function eventosFuturos($FechaHoraCliente){
		$conn=new Connection();
		$query="";
		$result=NULL;
		$dt = $FechaHoraCliente->format('Y-m-d H:i:s');
		$query="SELECT eventos.EventosID,eventos.Nombre As NombreEvento,eventos.FechaHoraInicial,eventos.FechaHoraFinal,eventos.Descripcion,eventos.Imagen,categorias.Nombre As NombreCategoria,institucion.Nombre As NombreInstitucion, categorias.CategoriasID, institucion.InstitucionID,
			(SELECT AVG(Calificacion) From asistencias where asistencias.EventosID = eventos.EventosID and asistencias.Calificacion > 0) As Rating
			from eventos
			inner join categorias On categorias.CategoriasID = eventos.CategoriasID
			inner join institucion On institucion.InstitucionID = eventos.InstitucionID
			where FechaHoraInicial>='$dt' and FechaHoraFinal>='$dt'
			order by FechaHoraInicial";
		$result=$conn->EjecutaQuery($query);
	
	return $result;
	}
	public function eventosFuturos_X_InstitucionID($FechaHoraCliente,$institucionid){
		$conn=new Connection();
		$query="";
		$result=NULL;
		$dt = $FechaHoraCliente->format('Y-m-d H:i:s');
		$query="SELECT eventos.EventosID,eventos.Nombre As NombreEvento,eventos.FechaHoraInicial,eventos.FechaHoraFinal,eventos.Descripcion,eventos.Imagen,categorias.Nombre As NombreCategoria,institucion.Nombre As NombreInstitucion, categorias.CategoriasID, institucion.InstitucionID,
			(SELECT AVG(Calificacion) From asistencias where asistencias.EventosID = eventos.EventosID and asistencias.Calificacion > 0) As Rating
			from eventos
			inner join categorias On categorias.CategoriasID = eventos.CategoriasID
			inner join institucion On institucion.InstitucionID = eventos.InstitucionID
			where FechaHoraInicial>='$dt' and FechaHoraFinal>='$dt' and eventos.InstitucionID = '$institucionid'
			order by FechaHoraInicial";
		$result=$conn->EjecutaQuery($query);
	
	return $result;
	}

	public function eventos_X_InstitucionID($InstitucionID){
		$conn=new Connection();
		$query="";
		$result=NULL;
		$query="SELECT eventos.EventosID,eventos.Nombre As NombreEvento,eventos.FechaHoraInicial,eventos.FechaHoraFinal,eventos.Descripcion,eventos.Imagen,categorias.Nombre As NombreCategoria,institucion.Nombre As NombreInstitucion, categorias.CategoriasID, institucion.InstitucionID,
			(SELECT AVG(Calificacion) From asistencias where asistencias.EventosID = eventos.EventosID and asistencias.Calificacion > 0) As Rating
			from eventos
			inner join categorias On categorias.CategoriasID = eventos.CategoriasID
			inner join institucion On institucion.InstitucionID = eventos.InstitucionID
			where eventos.InstitucionID=$InstitucionID
			order by FechaHoraFinal";
		$result=$conn->EjecutaQuery($query);
	
	return $result;
	}
	public function getEvento_X_EventoID($EventosID){
		$conn=new Connection();
		$query="";
		$result=NULL;
		$query="SELECT eventos.EventosID,eventos.Nombre As NombreEvento,eventos.FechaHoraInicial,eventos.FechaHoraFinal,eventos.Descripcion,eventos.Imagen,categorias.Nombre As NombreCategoria,institucion.Nombre As NombreInstitucion, categorias.CategoriasID, institucion.InstitucionID,
			(SELECT AVG(Calificacion) From asistencias where asistencias.EventosID = eventos.EventosID and asistencias.Calificacion > 0) As Rating
			from eventos
			inner join categorias On categorias.CategoriasID = eventos.CategoriasID
			inner join institucion On institucion.InstitucionID = eventos.InstitucionID
			where eventos.EventosID=$EventosID";
		$result=$conn->EjecutaQuery($query);
	
	return $result;
	}
	public function eventos_X_CategoriasID($CategoriasID){
		$conn=new Connection();
		$query="";
		$result=NULL;
		$query="SELECT eventos.EventosID,eventos.Nombre As NombreEvento,eventos.FechaHoraInicial,eventos.FechaHoraFinal,eventos.Descripcion,eventos.Imagen,categorias.Nombre As NombreCategoria,institucion.Nombre As NombreInstitucion, categorias.CategoriasID, institucion.InstitucionID,
			(SELECT AVG(Calificacion) From asistencias where asistencias.EventosID = eventos.EventosID and asistencias.Calificacion > 0) As Rating
			from eventos
			inner join categorias On categorias.CategoriasID = eventos.CategoriasID
			inner join institucion On institucion.InstitucionID = eventos.InstitucionID
			where eventos.CategoriasID=$CategoriasID
			order by FechaHoraFinal";
		$result=$conn->EjecutaQuery($query);
	
	return $result;
	}

	public function eventos_X_UsuariosID($UsuariosID){
		$conn=new Connection();
		$query="";
		$result=NULL;
		$query="SELECT eventos.EventosID,eventos.Nombre As NombreEvento,eventos.FechaHoraInicial,eventos.FechaHoraFinal,eventos.Descripcion,eventos.Imagen,categorias.Nombre As NombreCategoria,institucion.Nombre As NombreInstitucion, categorias.CategoriasID, institucion.InstitucionID,
		(SELECT AVG(Calificacion) From asistencias where asistencias.EventosID = eventos.EventosID and asistencias.Calificacion > 0) As Rating
		FROM eventos, asistencias, categorias, institucion WHERE categorias.categoriasid = eventos.categoriasid and institucion.institucionid = eventos.institucionid and eventos.EventosID = asistencias.EventosID AND asistencias.UsuariosID = $UsuariosID";
		$result=$conn->EjecutaQuery($query);
	
	return $result;
	}

	public function insertarEvento($Nombre,$FechaHoraInicial,$FechaHoraFinal,$Descripcion,$CategoriasID,$imagennombre,$institucionid)
	{
	//Conexion a la base de datos
	$conn=new Connection();
	$query="";
	$result=NULL;
	
	//creamos el query
	$query= "insert into eventos  (Nombre,FechaHoraInicial,FechaHoraFinal,Descripcion,CategoriasID,Imagen,InstitucionID) VALUES ('".$Nombre."','".$FechaHoraInicial."','".$FechaHoraFinal."','".$Descripcion."','".$CategoriasID."','".$imagennombre."','".$institucionid."')";
	
	//llamamos el metodo EjecutarQuery de la clase Conexion, enviando la variable $query
	$result=$conn->EjecutaQuery($query);
	
	return $result;
	}
	public function editarEvento($Nombre,$FechaHoraInicial,$FechaHoraFinal,$Descripcion,$CategoriasID,$imagennombre,$institucionid,$eventoid)
	{
	//Conexion a la base de datos
	$conn=new Connection();
	$query="";
	$result=NULL;
	
	//creamos el query
	if($imagennombre!=""){
	$query= "UPDATE eventos 
		SET Nombre = '$Nombre', FechaHoraInicial = '$FechaHoraInicial', FechaHoraFinal = '$FechaHoraFinal', Descripcion = '$Descripcion', CategoriasID = '$CategoriasID', Imagen = '$imagennombre', InstitucionID = '$institucionid'
		WHERE EventosID = '$eventoid'";
	}
	else{
		$query= "UPDATE eventos 
		SET Nombre = '$Nombre', FechaHoraInicial = '$FechaHoraInicial', FechaHoraFinal = '$FechaHoraFinal', Descripcion = '$Descripcion', CategoriasID = '$CategoriasID', InstitucionID = '$institucionid'
		WHERE EventosID = '$eventoid'";
	}
	
	//llamamos el metodo EjecutarQuery de la clase Conexion, enviando la variable $query
	$result=$conn->EjecutaQuery($query);
	
	return $result;
	}
	public function eliminarEvento($eventoid)
	{
	//Conexion a la base de datos
	$conn=new Connection();
	$query="";
	$result=NULL;
	$query = "DELETE FROM eventos WHERE EventosID = $eventoid";
	//llamamos el metodo EjecutarQuery de la clase Conexion, enviando la variable $query
	$result=$conn->EjecutaQuery($query);
	
	return $result;
	}
	public function ConsecutivoEventos(){
		//Conexion a la base de datos
	$conn=new Connection();
	$query="";
	$result=NULL;
	$query = "SELECT MAX(EventosID) as Consecutivo FROM eventos";
	//llamamos el metodo EjecutarQuery de la clase Conexion, enviando la variable $query
	$result=$conn->EjecutaQuery($query);
	
	return $result;
	}
	public function ConsecutivoInstitucion(){
		//Conexion a la base de datos
	$conn=new Connection();
	$query="";
	$result=NULL;
	$query = "SELECT MAX(InstitucionID) as Consecutivo FROM institucion";
	//llamamos el metodo EjecutarQuery de la clase Conexion, enviando la variable $query
	$result=$conn->EjecutaQuery($query);
	
	return $result;
	}
	public function ConsecutivoFotos(){
		//Conexion a la base de datos
	$conn=new Connection();
	$query="";
	$result=NULL;
	$query = "SELECT MAX(AsistenciasFotosID) as Consecutivo FROM asistenciasfotos";
	//llamamos el metodo EjecutarQuery de la clase Conexion, enviando la variable $query
	$result=$conn->EjecutaQuery($query);
	
	return $result;
	}
	public function ConsecutivoCategorias(){
		//Conexion a la base de datos
	$conn=new Connection();
	$query="";
	$result=NULL;
	$query = "SELECT MAX(CategoriasID) as Consecutivo FROM categorias";
	//llamamos el metodo EjecutarQuery de la clase Conexion, enviando la variable $query
	$result=$conn->EjecutaQuery($query);
	
	return $result;
	}
	public function cantidadesEventos($FechaHoraCliente)
	{
	//Conexion a la base de datos
	$dt = $FechaHoraCliente->format('Y-m-d H:i:s');
	$conn=new Connection();
	$query="";
	$result=NULL;
	$query = "SELECT (SELECT COUNT(*) From eventos) As Todos,
	(SELECT COUNT(*) From eventos where FechaHoraInicial<='$dt' and FechaHoraFinal>='$dt') As Presentes,
	(SELECT COUNT(*) From eventos where FechaHoraInicial<='$dt' and FechaHoraFinal<='$dt') As Pasados,
	(SELECT COUNT(*) From eventos where FechaHoraInicial>='$dt' and FechaHoraFinal>='$dt') As Futuros";
	//llamamos el metodo EjecutarQuery de la clase Conexion, enviando la variable $query
	$result=$conn->EjecutaQuery($query);
	
	return $result;
	}
	public function cantidadesEventos_X_InstitucionID($FechaHoraCliente,$institucionid)
	{
	//Conexion a la base de datos
	$dt = $FechaHoraCliente->format('Y-m-d H:i:s');
	$conn=new Connection();
	$query="";
	$result=NULL;
	$query = "SELECT (SELECT COUNT(*) From eventos where InstitucionID = '$institucionid') As Todos,
	(SELECT COUNT(*) From eventos where FechaHoraInicial<='$dt' and FechaHoraFinal>='$dt' and InstitucionID = '$institucionid') As Presentes,
	(SELECT COUNT(*) From eventos where FechaHoraInicial<='$dt' and FechaHoraFinal<='$dt' and InstitucionID = '$institucionid') As Pasados,
	(SELECT COUNT(*) From eventos where FechaHoraInicial>='$dt' and FechaHoraFinal>='$dt' and InstitucionID = '$institucionid') As Futuros";
	//llamamos el metodo EjecutarQuery de la clase Conexion, enviando la variable $query
	$result=$conn->EjecutaQuery($query);
	
	return $result;
	}
	public function cantidadesFotosComentarios($EventosID)
	{
	//Conexion a la base de datos
	$conn=new Connection();
	$query="";
	$result=NULL;
	$query = "SELECT
		(SELECT COUNT(*)
		From asistenciasfotos
		inner join asistencias on asistencias.AsistenciasID = asistenciasfotos.AsistenciasID
		inner join eventos on eventos.EventosID = asistencias.EventosID
		where asistencias.EventosID = $EventosID) As Fotos,
	(SELECT COUNT(*) From asistenciascomentarios
		inner join asistencias on asistencias.AsistenciasID = asistenciascomentarios.AsistenciasID
		inner join eventos on eventos.EventosID = asistencias.EventosID
		where asistencias.EventosID = $EventosID) As Comentarios";
	//llamamos el metodo EjecutarQuery de la clase Conexion, enviando la variable $query
	$result=$conn->EjecutaQuery($query);
	
	return $result;
	}
	public function todosLosEventos()
	{
		$conn=new Connection();
	$query="";
	$result=NULL;
	
	$query="SELECT eventos.EventosID,eventos.Nombre As NombreEvento,eventos.FechaHoraInicial,eventos.FechaHoraFinal,eventos.Descripcion,eventos.Imagen,categorias.Nombre As NombreCategoria,institucion.Nombre As NombreInstitucion, categorias.CategoriasID, institucion.InstitucionID,
			(SELECT AVG(Calificacion) From asistencias where asistencias.EventosID = eventos.EventosID and asistencias.Calificacion > 0) As Rating
			from eventos
			inner join categorias On categorias.CategoriasID = eventos.CategoriasID
			inner join institucion On institucion.InstitucionID = eventos.InstitucionID
			order by FechaHoraFinal";
	$result=$conn->EjecutaQuery($query);
	
	return $result;
	}
	public function modificarEvento($EventosID,$Nombre,$FechaHora,$Descripcion,$CategoriasID)
	{
		$conn=new Connection();
	$query="";
	$result=NULL;
	
	//creamos el query
	$query="UPDATE eventos SET Nombre='".$Nombre."', FechaHora='".$FechaHora."', Descripcion='".$Descripcion."', CategoriasID='".$CategoriasID."' where EventosID='$EventosID'";
	
	//llamamos el metodo EjecutarQuery de la clase Conexion, enviando la variable $query
	$result=$conn->EjecutaQuery($query);
	
	return $result;
		
	}
	public function eliminarEventos($EventosID)
	{
		$conn=new Connection();
	$query="";
	$result=NULL;
	
	//creamos el query

	$query= "DELETE FROM eventos WHERE EventosID='$EventosID'";
	
	//llamamos el metodo EjecutarQuery de la clase Conexion, enviando la variable $query
	$result=$conn->EjecutaQuery($query);
	
	return $result;	
	}
	

	//------FUNCIONES PARA CATEGORIAS----
	public function insertarCategoria($nombre,$imagenruta)
	{
	//Conexion a la base de datos
	$conn=new Connection();
	$query="";
	$result=NULL;
	
	//creamos el query
	$query= "insert into categorias (Nombre,Imagen) VALUES ('$nombre','$imagenruta')";
	
	//llamamos el metodo EjecutarQuery de la clase Conexion, enviando la variable $query
	$result=$conn->EjecutaQuery($query);
	
	return $result;
	}
	public function insertarInstitucion($usuario,$password,$institucion,$imagenruta)
	{
	//Conexion a la base de datos
	$conn=new Connection();
	$query="";
	$result=NULL;
	
	//creamos el query
	$query= "INSERT INTO institucion  (Usuario,Password,Nombre,Imagen) VALUES ('".$usuario."','".$password."','".$institucion."','".$imagenruta."')";
	
	//llamamos el metodo EjecutarQuery de la clase Conexion, enviando la variable $query
	$result=$conn->EjecutaQuery($query);
	
	return $result;
	}
	public function getInstituciones()
	{
		$conn=new Connection();
	$query="";
	$result=NULL;
	
	$query="select * from institucion";
	$result=$conn->EjecutaQuery($query);
	
	return $result;
	}
	public function getInstitucion_X_InstitucionID($InstitucionID){
		$conn=new Connection();
		$query="";
		$result=NULL;
		$query="SELECT institucion.InstitucionID,institucion.Nombre As NombreInstitucion,institucion.Imagen as Imagen,
		(SELECT AVG(Calificacion) From asistencias
		inner join eventos On asistencias.EventosID = eventos.EventosID
		inner join institucion On institucion.InstitucionID = eventos.InstitucionID
		where asistencias.Calificacion > 0 and institucion.InstitucionID = '$InstitucionID'
		) As Rating,
		(SELECT COUNT(*) From eventos where eventos.InstitucionID='$InstitucionID'
		) As TotalEventos,
		(Select Count(*) From asistencias
		inner join eventos On asistencias.EventosID = eventos.EventosID
		inner join institucion On institucion.InstitucionID = eventos.InstitucionID
		where asistencias.Calificacion > 0 and institucion.InstitucionID = '$InstitucionID'
		) As TotalAsistencias,
		(Select Count(*) From asistenciasfotos
		inner join asistencias On asistenciasfotos.AsistenciasID = asistencias.AsistenciasID
		inner join eventos On asistencias.EventosID = eventos.EventosID
		inner join institucion On institucion.InstitucionID = eventos.InstitucionID
		where asistencias.Calificacion > 0 and institucion.InstitucionID = '$InstitucionID'
		) As TotalFotos,
		(Select Count(*) From asistenciascomentarios
		inner join asistencias On asistenciascomentarios.AsistenciasID = asistencias.AsistenciasID
		inner join eventos On asistencias.EventosID = eventos.EventosID
		inner join institucion On institucion.InstitucionID = eventos.InstitucionID
		where asistencias.Calificacion > 0 and institucion.InstitucionID = '$InstitucionID'
		) As TotalComentarios,
		institucion.Password as Pass
		from institucion where institucion.InstitucionID = '$InstitucionID'";
		$result=$conn->EjecutaQuery($query);
	
	return $result;
	}
	public function editarInstitucion($Nombre,$password,$imagennombre,$institucionid)
	{
	//Conexion a la base de datos
	$conn=new Connection();
	$query="";
	$result=NULL;
	
	//creamos el query
	if($imagennombre!=""){
	$query= "UPDATE institucion 
		SET Nombre = '$Nombre', Password = '$password', Imagen = '$imagennombre'
		WHERE InstitucionID = '$institucionid'";
	}
	else{
		$query= "UPDATE institucion 
		SET Nombre = '$Nombre', Password = '$password'
		WHERE InstitucionID = '$institucionid'";
	}
	//llamamos el metodo EjecutarQuery de la clase Conexion, enviando la variable $query
	$result=$conn->EjecutaQuery($query);
	
	return $result;
	}
	public function getCategorias()
	{
		$conn=new Connection();
	$query="";
	$result=NULL;
	
	$query="select * from categorias";
	$result=$conn->EjecutaQuery($query);
	return $result;
	}

	

	public function getCategorias_X_UsuarioID($usuarioID)
	{
		$conn=new Connection();
	$query="";
	$result=NULL;
	
	$query="SELECT * FROM categorias WHERE UsuariosID ='$usuarioID'";
	$result=$conn->EjecutaQuery($query);
	
	return $result;
	}
public function eliminarCategoria($CategoriasID)
	{
		$conn=new Connection();
	$query="";
	$result=NULL;
	
	//creamos el query

	$query= "DELETE FROM categorias WHERE CategoriasID='$CategoriasID'";
	
	//llamamos el metodo EjecutarQuery de la clase Conexion, enviando la variable $query
	$result=$conn->EjecutaQuery($query);
	
	return $result;	
	}


	public function insertarUsuario($FacebookUserID,$FBName,$GCMID)
	{
	//Conexion a la base de datos
		$conn=new Connection();
		$query="";
		$result=NULL;

		$query="SELECT UsuariosID As UserID, FacebookID As FBID, Nombre As FBName from usuarios where FacebookID = '$FacebookUserID'";
		$result=$conn->EjecutaQuery($query);

		if (mysqli_num_rows($result) > 0) {
			$query = "UPDATE usuarios set Gcm_RegistrationID = '$GCMID' where FacebookID = '$FacebookUserID'";
			$result=$conn->EjecutaQuery($query);

			$query="SELECT UsuariosID As UserID, FacebookID As FBID, Nombre As FBName, Gcm_RegistrationID As GCMID from usuarios where FacebookID = '$FacebookUserID'";
			$result=$conn->EjecutaQuery($query);
		   return $result;//echo $row['column name'];
		}
		else
		{
			$query= "INSERT INTO usuarios (FacebookID, Nombre, Gcm_RegistrationID) VALUES ('$FacebookUserID', '$FBName', '$GCMID')";
			$result=$conn->EjecutaQuery($query);

			$query="SELECT UsuariosID As UserID, FacebookID As FBID, Nombre As FBName, Gcm_RegistrationID As GCMID  from usuarios where FacebookID = '$FacebookUserID'";
			$result=$conn->EjecutaQuery($query);
			return $result;
		}
	}

	public function insertarAsistencia($UsuarioID,$EventoID)
	{
	//Conexion a la base de datos
	$conn=new Connection();
	$query="";
	$result=NULL;
	
	//creamos el query
	$query = "SELECT * from asistencias where UsuariosID = '$UsuarioID' and EventosID = '$EventoID'";
	$result=$conn->EjecutaQuery($query);

	if (mysqli_num_rows($result) > 0) {
	   return $result;//echo $row['column name'];
	}
	else
	{
		$query= "INSERT INTO asistencias (EventosID,UsuariosID,Calificacion) VALUES ('$EventoID','$UsuarioID',0)";
		$result=$conn->EjecutaQuery($query);
		$query="SELECT * from asistencias where UsuariosID = '$UsuarioID' and EventosID = '$EventoID'";
		$result=$conn->EjecutaQuery($query);
		return $result;
	}
	
	return $result;
	}



	public function eliminarAsistencia($UsuarioID,$EventoID)
	{
	//Conexion a la base de datos
	$conn=new Connection();
	$query="";
	$result=NULL;
	
	//creamos el query
	$query = "DELETE from asistencias where UsuariosID = '$UsuarioID' and EventosID = '$EventoID'";
	$result=$conn->EjecutaQuery($query);

	$query="SELECT * from asistencias where UsuariosID = '$UsuarioID' and EventosID = '$EventoID'";
	$result=$conn->EjecutaQuery($query);
	
	return $result;
	}

	public function getAsistencia_X_EventoID_UsuarioID($EventoID,$UsuarioID)
	{
		$conn=new Connection();
		$query="";
		$result=NULL;
	
		$query = "SELECT * from asistencias where UsuariosID = '$UsuarioID' and EventosID = '$EventoID'";
		$result=$conn->EjecutaQuery($query);
		return $result;
	}

	public function cambiarRating($AsistenciasID,$Rating)
	{
	//Conexion a la base de datos
	$conn=new Connection();
	$query="";
	$result=NULL;
	
	//creamos el query
	$query="UPDATE asistencias SET Calificacion='".$Rating."' where AsistenciasID='$AsistenciasID'";
	$result=$conn->EjecutaQuery($query);

	$query="SELECT * from asistencias where AsistenciasID = '$AsistenciasID'";
	$result=$conn->EjecutaQuery($query);

	return $result;
	}

	public function getComentarios($EventosID)
	{
	//Conexion a la base de datos
		$conn=new Connection();
		$query="";
		$result=NULL;

		date_default_timezone_set('America/Tijuana');
		$fechaHora = date("Y-m-d H:i:s");

		$query= "SELECT asistenciascomentarios.AsistenciasComentariosID, 
				asistenciascomentarios.Comentario, 
				asistenciascomentarios.FechaHora, 
				asistenciascomentarios.AsistenciasID, 
				usuarios.FacebookID,
				usuarios.Nombre
				FROM 
				asistenciascomentarios, asistencias, usuarios 
				WHERE
				usuarios.usuariosID = asistencias.usuariosID AND
				asistenciascomentarios.asistenciasID = asistencias.asistenciasID AND 
				asistencias.eventosID ='$EventosID' ORDER BY asistenciascomentarios.FechaHora desc";

		$result=$conn->EjecutaQuery($query);

		return $result;
	}

	public function insertarComentario($AsistenciasID, $Comentario)
	{
	//Conexion a la base de datos
		$conn=new Connection();
		$query="";
		$result=NULL;

		date_default_timezone_set('America/Tijuana');
		$fechaHora = date("Y-m-d H:i:s");

		$query= "INSERT INTO asistenciascomentarios (Comentario, FechaHora, AsistenciasID) VALUES ('$Comentario','$fechaHora','$AsistenciasID')";
		$result=$conn->EjecutaQuery($query);

		$query= "SELECT * from asistenciascomentarios where AsistenciasID = '$AsistenciasID'";
		$result=$conn->EjecutaQuery($query);

		return $result;
	}
	public function getGCMID_X_AsistenciasID($AsistenciasID){

		//Conexion a la base de datos
		$conn=new Connection();
		$query="";
		$result=NULL;

		$query= "SELECT usuarios.UsuariosID, usuarios.Gcm_RegistrationID As GCMID 
			from asistencias
			inner join usuarios On usuarios.UsuariosID = asistencias.UsuariosID
			where asistencias.EventosID In(
					Select EventosID from asistencias
					where AsistenciasID = '$AsistenciasID'
				)		
			group by UsuariosID";
		$result=$conn->EjecutaQuery($query);

		return $result;
	}
	public function getNombreEvento_Y_NombreUsuario_X_AsistenciasID($AsistenciasID){
		//Conexion a la base de datos
		$conn=new Connection();
		$query="";
		$result=NULL;

		$query= "SELECT eventos.Nombre As NombreEvento, usuarios.UsuariosID,
				usuarios.Nombre As NombreUsuario, usuarios.Gcm_RegistrationID As GCMID
				 from eventos
				inner join asistencias On asistencias.EventosID = eventos.EventosID
				inner join usuarios on usuarios.UsuariosID = asistencias.UsuariosID
				where asistencias.AsistenciasID = '$AsistenciasID'";
		$result=$conn->EjecutaQuery($query);

		return $result;
	}
	public function eliminarComentario($asistenciascomentariosid)
	{
	//Conexion a la base de datos
	$conn=new Connection();
	$query="";
	$result=NULL;
	$query = "DELETE FROM asistenciascomentarios WHERE AsistenciasComentariosID = $asistenciascomentariosid";
	//llamamos el metodo EjecutarQuery de la clase Conexion, enviando la variable $query
	$result=$conn->EjecutaQuery($query);
	
	return $result;
	}

	public function insertarFoto($AsistenciasID, $Imagen)
	{
	//Conexion a la base de datos
		$conn=new Connection();
		$query="";
		$result=NULL;

		date_default_timezone_set('America/Tijuana');
		$fechaHora = date("Y-m-d H:i:s");

		$query= "INSERT INTO asistenciasfotos (AsistenciasID, Imagen, FechaHora) VALUES ('$AsistenciasID','$Imagen','$fechaHora')";
		$result=$conn->EjecutaQuery($query);

		$query= "SELECT * from asistenciasfotos where AsistenciasID = '$AsistenciasID'";
		$result=$conn->EjecutaQuery($query);

		return $result;
	}
	public function eliminarFoto($asistenciasfotosid)
	{
	//Conexion a la base de datos
	$conn=new Connection();
	$query="";
	$result=NULL;
	$query = "DELETE FROM asistenciasfotos WHERE AsistenciasFotosID = $asistenciasfotosid";
	//llamamos el metodo EjecutarQuery de la clase Conexion, enviando la variable $query
	$result=$conn->EjecutaQuery($query);
	
	return $result;
	}
	public function getFotos($EventosID)
	{
	//Conexion a la base de datos
		$conn=new Connection();
		$query="";
		$result=NULL;

		date_default_timezone_set('America/Tijuana');
		$fechaHora = date("Y-m-d H:i:s");

		$query= "SELECT asistenciasfotos.AsistenciasFotosID, 
				asistenciasfotos.Imagen, 
				asistenciasfotos.FechaHora, 
				asistenciasfotos.AsistenciasID, 
				usuarios.FacebookID,
				usuarios.Nombre
				FROM 
				asistenciasfotos, asistencias, usuarios 
				WHERE
				usuarios.usuariosID = asistencias.usuariosID AND
				asistenciasfotos.asistenciasID = asistencias.asistenciasID AND 
				asistencias.eventosID ='$EventosID' ORDER BY asistenciasfotos.FechaHora desc";

		$result=$conn->EjecutaQuery($query);

		return $result;
	}
	public function getFotos_X_AsistenciasFotosID($AsistenciasFotosID)
	{
	//Conexion a la base de datos
		$conn=new Connection();
		$query="";
		$result=NULL;

		date_default_timezone_set('America/Tijuana');
		$fechaHora = date("Y-m-d H:i:s");

		$query= "SELECT asistenciasfotos.AsistenciasFotosID, 
				asistenciasfotos.Imagen, 
				asistenciasfotos.FechaHora, 
				asistenciasfotos.AsistenciasID, 
				usuarios.FacebookID,
				usuarios.Nombre
				FROM 
				asistenciasfotos, asistencias, usuarios 
				WHERE
				usuarios.usuariosID = asistencias.usuariosID AND
				asistenciasfotos.asistenciasID = asistencias.asistenciasID AND 
				asistenciasfotos.AsistenciasFotosID ='$AsistenciasFotosID'";

		$result=$conn->EjecutaQuery($query);

		return $result;
	}


	
}
