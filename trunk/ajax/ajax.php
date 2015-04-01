<?php

include ('../includes/funcionesUsuarios.php');
include ('../includes/funciones.php');
include ('../includes/funcionesHTML.php');
include ('../includes/funcionesJugadores.php');
include ('../includes/funcionesEquipos.php');
include ('../includes/funcionesGrupos.php');
include ('../includes/funcionesZonasEquipos.php');

$serviciosUsuarios  = new ServiciosUsuarios();
$serviciosFunciones = new Servicios();
$serviciosHTML		= new ServiciosHTML();
$serviciosJugadores = new ServiciosJ();
$serviciosEquipos	= new ServiciosE();
$serviciosGrupos	= new ServiciosG();
$serviciosZonasEquipos	= new ServiciosZonasEquipos();

$accion = $_POST['accion'];


switch ($accion) {
    case 'login':
        enviarMail($serviciosUsuarios);
        break;
	case 'entrar':
		entrar($serviciosUsuarios);
		break;
	case 'insertarUsuario':
        insertarUsuario($serviciosUsuarios);
        break;
	case 'modificarUsuario':
        modificarUsuario($serviciosUsuarios);
        break;
	case 'registrar':
		registrar($serviciosUsuarios);
        break;
		

	case 'modificarCliente':
		modificarCliente($serviciosUsuarios);
		break;
	
	/* para los torneos */
	case 'insertarTorneo':
		insertarTorneo($serviciosFunciones);
		break;
	case 'modificarTorneo':
		modificarTorneo($serviciosFunciones);
		break;
	case 'eliminarTorneo':
		eliminarTorneo($serviciosFunciones);
		break;
	
		
		
	/* fin torneos */
	
	/* para los equipos */
	case 'insertarEquipos':
		insertarEquipos($serviciosEquipos);
		break;
	case 'modificarEquipos':
		modificarEquipos($serviciosEquipos);
		break;
	case 'eliminarEquipos':
		eliminarEquipos($serviciosEquipos);
		break; 
	/* fin equipos */
	
	
	/* para los jugadores */

	case 'insertarJugadores':
		insertarJugadores($serviciosJugadores);
		break;
	case 'modificarJugadores':
		modificarJugadores($serviciosJugadores);
		break;
	case 'eliminarJugadores':
		eliminarJugadores($serviciosJugadores);
		break; 
	/* fin jugadores */
	
	
	/* para los zonas */
	
	case 'insertarGrupo':
		insertarGrupo($serviciosGrupos);
		break;
	case 'modificarGrupos':
		modificarGrupos($serviciosGrupos);
		break;
	case 'eliminarGrupos':
		eliminarGrupos($serviciosGrupos);
		break; 
	/* fin zonas */
	
	
	/* para los torneo-zonas-equipos */
	case 'insertarZonasEquipos':
		insertarZonasEquipos($serviciosZonasEquipos);
		break;
	case 'modificarZonasEquipos':
		modificarZonasEquipos($serviciosZonasEquipos);
		break;
	case 'eliminarZonasEquipos':
		eliminarZonasEquipos($serviciosZonasEquipos);
		break; 
	/* fin torneo-zonas-equipos */
	
	
	/* para los fixture */
	case 'insertarFixture':
		insertarFixture($serviciosZonasEquipos);
		break;
	case 'modificarFixture':
		modificarFixture($serviciosZonasEquipos);
		break;
	case 'eliminarFixture':
		eliminarFixture($serviciosZonasEquipos);
		break; 
	/* fin fixture */
}

//////////////////////////Traer datos */

/* para los torneos */

function insertarTorneo($serviciosFunciones) {
	$nombre			=	$_POST['nombre'];
	$fechacreacion	=	$_POST['fechacreacion'];

	if (isset($_POST['activo'])) {
		$activo	= 1;
	} else {
		$activo = 0;
	}
	
	if (isset($_POST['actual'])) {
		$actual	= 1;
	} else {
		$actual = 0;
	}
	$reftipotorneo	=	$_POST['reftipotorneo'];
	
	$res = $serviciosFunciones->insertarTorneo($nombre,$fechacreacion,$activo,$actual,$reftipotorneo);
	//echo $res;
	
	if ((integer)$res > 0) {
		echo '';
	} else {
		echo "Huvo un error al insertar datos";	
	}
}

function modificarTorneo($serviciosFunciones) {
	$id				=	$_POST['id'];
	$nombre			=	$_POST['nombre'];
	$fechacreacion	=	$_POST['fechacreacion'];
	$activo			=	$_POST['activo'];
	$actual			=	$_POST['actual'];
	$reftipotorneo	=	$_POST['reftipotorneo'];
	
	$res = $serviciosFunciones->modificarTorneo($id,$nombre,$fechacreacion,$activo,$actual,$reftipotorneo);
	

	echo $res;
}

function eliminarTorneo($serviciosFunciones) {
	$id				=	$_POST['id'];
	
	$res = $serviciosFunciones->eliminarTorneo($id);
	echo $res;
}


/* fin torneos */
	
/* para los equipos */

function insertarEquipos($serviciosEquipos) {
	$Nombre 			= $_POST['Nombre'];
	$nombrecapitan 		= $_POST['nombrecapitan'];
	$telefonocapitan 	= $_POST['telefonocapitan'];
	$facebookcapitan 	= $_POST['facebookcapitan'];
	$nombresubcapitan 	= $_POST['nombresubcapitan'];
	$telefonosubcapitan = $_POST['telefonosubcapitan'];
	$facebooksubcapitan = $_POST['facebooksubcapitan'];
	$emailcapitan 		= $_POST['emailcapitan'];
	$emailsubcapitan 	= $_POST['emailsubcapitan'];

	$res = $serviciosEquipos->insertarEquipos($Nombre,$nombrecapitan,$telefonocapitan,$facebookcapitan,$nombresubcapitan,$telefonosubcapitan,$facebooksubcapitan,$emailcapitan,$emailsubcapitan);
	if ((integer)$res > 0) {
		echo '';
	} else {
		echo 'Huvo un error al insertar datos';
	}
}
function modificarEquipos($serviciosEquipos) {
	$id 				= $_POST['id'];
	$Nombre 			= $_POST['Nombre'];
	$nombrecapitan 		= $_POST['nombrecapitan'];
	$telefonocapitan 	= $_POST['telefonocapitan'];
	$facebookcapitan 	= $_POST['facebookcapitan'];
	$nombresubcapitan 	= $_POST['nombresubcapitan'];
	$telefonosubcapitan = $_POST['telefonosubcapitan'];
	$facebooksubcapitan = $_POST['facebooksubcapitan'];
	$emailcapitan 		= $_POST['emailcapitan'];
	$emailsubcapitan 	= $_POST['emailsubcapitan'];

	$res = $serviciosEquipos->modificarEquipos($id,$Nombre,$nombrecapitan,$telefonocapitan,$facebookcapitan,$nombresubcapitan,$telefonosubcapitan,$facebooksubcapitan,$emailcapitan,$emailsubcapitan);
	
	echo $res;
}

function eliminarEquipos($serviciosEquipos) {
	$id = $_POST['id'];
	$res = $serviciosEquipos->eliminarEquipos($id);
	echo $res;
} 
/* fin equipos */


/* para los jugadores */

function insertarJugadores($serviciosJugadores) {
	$apyn 		= $_POST['apyn'];
	$idequipo 	= $_POST['idequipo'];
	$dni 		= $_POST['dni'];
	
	$res = $serviciosJugadores->insertarJugadores($apyn,$idequipo,$dni);
	if ((integer)$res > 0) {
		echo '';
	} else {
		echo 'Huvo un error al insertar datos';
	}
}
function modificarJugadores($serviciosJugadores) {
	$id 		= $_POST['id'];
	$apyn 		= $_POST['apyn'];
	$idequipo 	= $_POST['idequipo'];
	$dni 		= $_POST['dni'];
	
	$res = $serviciosJugadores->modificarJugadores($id,$apyn,$idequipo,$dni);
	echo $res;
}
function eliminarJugadores($serviciosJugadores) {
	$id = $_POST['id'];
	
	$res = $serviciosJugadores->eliminarJugadores($id);
	echo $res;
} 
/* fin jugadores */


/* para los zonas */
function insertarGrupo($serviciosGrupos) {
$Nombre = $_POST['nombre'];
$res = $serviciosGrupos->insertarGrupos($Nombre);
if ((integer)$res > 0) {
echo '';
} else {
echo 'Huvo un error al insertar datos';
}
}
function modificarGrupos($serviciosGrupos) {
$id = $_POST['id'];
$Nombre = $_POST['nombre'];
$res = $serviciosGrupos->modificarGrupos($id,$Nombre);
echo $res;
}
function eliminarGrupos($serviciosGrupos) {
$id = $_POST['id'];
$res = $serviciosGrupos->eliminarGrupos($id);
echo $res;
} 
/* fin zonas */


/* para los torneo-zonas-equipos */

function insertarZonasEquipos($serviciosZonasEquipos) {
$refgrupo = $_POST['refgrupo'];
$reftorneo = $_POST['reftorneo'];
$refequipo = $_POST['refequipo'];
$prioridad = $_POST['prioridad'];

$horario1 = $_POST['horario1'];
$horario2 = $_POST['horario2'];
$horario3 = $_POST['horario3'];
$horario4 = $_POST['horario4'];

$res = $serviciosZonasEquipos->insertarZonasEquipos($refgrupo,$reftorneo,$refequipo,$prioridad);
if ((integer)$res > 0) {
echo '';
} else {
echo 'Huvo un error al insertar datos';
}
}
function modificarZonasEquipos($serviciosZonasEquipos) {
$id = $_POST['id'];
$refgrupo = $_POST['refgrupo'];
$reftorneo = $_POST['reftorneo'];
$refequipo = $_POST['refequipo'];
$prioridad = $_POST['prioridad'];
$res = $serviciosZonasEquipos->modificarZonasEquipos($id,$refgrupo,$reftorneo,$refequipo,$prioridad);
echo $res;
}
function eliminarZonasEquipos($serviciosZonasEquipos) {
$id = $_POST['id'];
$res = $serviciosZonasEquipos->eliminarZonasEquipos($id);
echo $res;
} 
/* fin torneo-zonas-equipos */


/* para los fixture */


function insertarFixture($serviciosZonasEquipos) {
	$reftorneoge_a 	= $_POST['reftorneoge_a'];
	$resultado_a 	= $_POST['resultado_a'];
	$reftorneoge_b 	= $_POST['reftorneoge_b'];
	$resultado_b 	= $_POST['resultado_b'];
	$fechajuego 	= $_POST['fechajuego'];
	$refFecha 		= $_POST['reffecha'];
	$cancha 		= $_POST['cancha'];
	$horario 		= $_POST['hora'];
	
	$res = $serviciosZonasEquipos->insertarFixture($reftorneoge_a,$resultado_a,$reftorneoge_b,$resultado_b,$fechajuego,$refFecha,$cancha,$horario);
	
	if ((integer)$res > 0) {
		echo '';
	} else {
		echo 'Huvo un error al insertar datos';
	}
}


function modificarFixture($serviciosZonasEquipos) {
	$id 			= $_POST['id'];
	$reftorneoge_a 	= $_POST['reftorneoge_a'];
	$resultado_a 	= $_POST['resultado_a'];
	$reftorneoge_b 	= $_POST['reftorneoge_b'];
	$resultado_b 	= $_POST['resultado_b'];
	$fechajuego 	= $_POST['fechajuego'];
	$refFecha 		= $_POST['refFecha'];
	$cancha 		= $_POST['cancha'];
	$horario 		= $_POST['horario'];
	
	$res = $serviciosZonasEquipos->modificarFixtureTodo($id,$reftorneoge_a,$resultado_a,$reftorneoge_b,$resultado_b,$fechajuego,$refFecha,$cancha,$horario);
	echo $res;
} 


function eliminarFixture($serviciosZonasEquipos) {
$id = $_POST['id'];
$res = $serviciosZonasEquipos->eliminarFixture($id);
echo $res;
} 
/* fin fixture */
	
	
	
function modificarCliente($serviciosUsuarios) {
	$email		=	$_POST['email'];
	$password	=	$_POST['password'];
	$direccion	=	$_POST['direccion'];
	$nombre		=	$_POST['nombre'];
	$apellido	=	$_POST['apellido'];
	$id			=	$_POST['id'];
	
	echo $serviciosUsuarios->modificarUsuario($id,$apellido,$password,'',$email,$nombre,'',$direccion,'','','','');
}

function entrar($serviciosUsuarios) {
	$email		=	$_POST['email'];
	$pass		=	$_POST['pass'];
	echo $serviciosUsuarios->loginUsuario($email,$pass);
}


function registrar($serviciosUsuarios) {
	$apellido			=	$_POST['apellido'];
	$password			=	$_POST['password'];
	$refroll			=	2;
	$email				=	$_POST['email'];
	$nombre				=	$_POST['nombre'];
	$telefono			=	'';
	$direccion			=	$_POST['direccion'];
	$imagen				=	'';
	$mime				=	'';
	$carpeta			=	'';
	$intentoserroneos	=	0;
	$res = $serviciosUsuarios->insertarUsuario($apellido,$password,$refroll,$email,$nombre,$telefono,$direccion,$imagen,$mime,$carpeta,$intentoserroneos);
	if ((integer)$res > 0) {
		echo '';	
	} else {
		echo $res;	
	}
}


function insertarUsuario($serviciosUsuarios) {
	$apellido			=	$_POST['apellido'];
	$password			=	$_POST['password'];
	$refroll			=	2;
	$email				=	$_POST['email'];
	$nombre				=	$_POST['nombre'];
	$telefono			=	'';
	$direccion			=	$_POST['direccion'];
	$imagen				=	'';
	$mime				=	'';
	$carpeta			=	'';
	$intentoserroneos	=	0;
	echo $serviciosUsuarios->insertarUsuario($apellido,$password,$refroll,$email,$nombre,$telefono,$direccion,$imagen,$mime,$carpeta,$intentoserroneos);
}


function modificarUsuario($serviciosUsuarios) {
	$id					=	$_POST['id'];
	$apellido			=	$_POST['apellido'];
	$password			=	$_POST['password'];
	$refroll			=	2;
	$email				=	$_POST['email'];
	$nombre				=	$_POST['nombre'];
	$telefono			=	'';
	$direccion			=	$_POST['direccion'];
	$imagen				=	'';
	$mime				=	'';
	$carpeta			=	'';
	$intentoserroneos	=	0;
	echo $serviciosUsuarios->modificarUsuario($id,$apellido,$password,$refroll,$email,$nombre,$telefono,$direccion,$imagen,$mime,$carpeta,$intentoserroneos);
}


function enviarMail($serviciosUsuarios) {
	$email		=	$_POST['email'];
	$pass		=	$_POST['pass'];
	$torneo		=	$_POST['reftorneo'];
	
	echo $serviciosUsuarios->login($email,$pass,$torneo);
}


function devolverImagen($nroInput) {
	
	if( $_FILES['archivo'.$nroInput]['name'] != null && $_FILES['archivo'.$nroInput]['size'] > 0 ){
	// Nivel de errores
	  error_reporting(E_ALL);
	  $altura = 100;
	  // Constantes
	  # Altura de el thumbnail en píxeles
	  //define("ALTURA", 100);
	  # Nombre del archivo temporal del thumbnail
	  //define("NAMETHUMB", "/tmp/thumbtemp"); //Esto en servidores Linux, en Windows podría ser:
	  //define("NAMETHUMB", "c:/windows/temp/thumbtemp"); //y te olvidas de los problemas de permisos
	  $NAMETHUMB = "c:/windows/temp/thumbtemp";
	  # Servidor de base de datos
	  //define("DBHOST", "localhost");
	  # nombre de la base de datos
	  //define("DBNAME", "portalinmobiliario");
	  # Usuario de base de datos
	  //define("DBUSER", "root");
	  # Password de base de datos
	  //define("DBPASSWORD", "");
	  // Mime types permitidos
	  $mimetypes = array("image/jpeg", "image/pjpeg", "image/gif", "image/png");
	  // Variables de la foto
	  $name = $_FILES["archivo".$nroInput]["name"];
	  $type = $_FILES["archivo".$nroInput]["type"];
	  $tmp_name = $_FILES["archivo".$nroInput]["tmp_name"];
	  $size = $_FILES["archivo".$nroInput]["size"];
	  // Verificamos si el archivo es una imagen válida
	  if(!in_array($type, $mimetypes))
		die("El archivo que subiste no es una imagen válida");
	  // Creando el thumbnail
	  switch($type) {
		case $mimetypes[0]:
		case $mimetypes[1]:
		  $img = imagecreatefromjpeg($tmp_name);
		  break;
		case $mimetypes[2]:
		  $img = imagecreatefromgif($tmp_name);
		  break;
		case $mimetypes[3]:
		  $img = imagecreatefrompng($tmp_name);
		  break;
	  }
	  
	  $datos = getimagesize($tmp_name);
	  
	  $ratio = ($datos[1]/$altura);
	  $ancho = round($datos[0]/$ratio);
	  $thumb = imagecreatetruecolor($ancho, $altura);
	  imagecopyresized($thumb, $img, 0, 0, 0, 0, $ancho, $altura, $datos[0], $datos[1]);
	  switch($type) {
		case $mimetypes[0]:
		case $mimetypes[1]:
		  imagejpeg($thumb, $NAMETHUMB);
			  break;
		case $mimetypes[2]:
		  imagegif($thumb, $NAMETHUMB);
		  break;
		case $mimetypes[3]:
		  imagepng($thumb, $NAMETHUMB);
		  break;
	  }
	  // Extrae los contenidos de las fotos
	  # contenido de la foto original
	  $fp = fopen($tmp_name, "rb");
	  $tfoto = fread($fp, filesize($tmp_name));
	  $tfoto = addslashes($tfoto);
	  fclose($fp);
	  # contenido del thumbnail
	  $fp = fopen($NAMETHUMB, "rb");
	  $tthumb = fread($fp, filesize($NAMETHUMB));
	  $tthumb = addslashes($tthumb);
	  fclose($fp);
	  // Borra archivos temporales si es que existen
	  //@unlink($tmp_name);
	  //@unlink(NAMETHUMB);
	} else {
		$tfoto = '';
		$type = '';
	}
	$tfoto = utf8_decode($tfoto);
	return array('tfoto' => $tfoto, 'type' => $type);	
}


?>