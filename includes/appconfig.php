<?php

date_default_timezone_set('America/Buenos_Aires');

class appconfig {

function conexion() {
		
		$hostname = "localhost";
		$database = "db_prediobck5";
		$username = "root";
		$password = "";
		/*
		$hostname = "localhost";
		$database = "wwwpredi_98nicolas";
		$username = "wwwpredi_98nico";
		$password = "nicolaspredio98";
		*/
		$conexion = array("hostname" => $hostname,
						  "database" => $database,
						  "username" => $username,
						  "password" => $password);
						  
		return $conexion;
}

}




?>