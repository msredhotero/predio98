<?php

/**
 * @author www.intercambiosvirtuales.org
 * @copyright 2013
 */
date_default_timezone_set('America/Buenos_Aires');

class Servicios {
	
	/* logica de negocios para los tipos de torneos */ 
	
	function traerTipoTorneo() {
		$sql = "SELECT idtipotorneo,descripciontorneo FROM tbtipotorneo order by descripciontorneo";
		$res 	=	$this->query($sql,0);
		
		return $res;
		
	}
	
	
	
	/* fin */


	function camposTablaView($cabeceras,$datos) {
		$cadView = '';
		$cadRows = '';
		while ($row = mysql_fetch_array($datos)) {
			$cadRows = $cadRows.'
			
					<tr>
                        	<td>'.utf8_encode($row['apellido']).'</td>

                            <td>

                                <div class="btn-group">
                                    <button class="btn btn-success" type="button">Acciones</button>
                                    
                                    <button class="btn btn-success dropdown-toggle" data-toggle="dropdown" type="button">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    
                                    <ul class="dropdown-menu" role="menu">
                                        <li>
                                        <a href="javascript:void(0)" class="varmodificar" id="'.$row['idusuario'].'">Modificar</a>
                                        </li>

                                        <li>
                                        <a href="javascript:void(0)" class="varborrar" id="'.$row['idusuario'].'">Borrar</a>
                                        </li>
										
                                        <li>
                                        <a href="javascript:void(0)" class="btnDetalle" id="'.$row['idusuario'].'">Ver</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
			';
		}
		
		$cadView = $cadView.'
			<table class="table table-striped table-responsive">
            	<thead>
                	<tr>
                    	'.$cabeceras.'
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
<!--idproducto,nombre,precio_unit,precio_venta,stock,stock_min,reftipoproducto,refproveedor,codigo,codigobarra,caracteristicas -->
                	'.$cadRows.'
                </tbody>
            </table>
		
		';	
		
		
		return $cadView;
	}
	
	
	
	function camposTabla($accion,$tabla,$lblcambio,$lblreemplazo,$refdescripcion,$refCampo) {
		$sql	=	"show columns from ".$tabla;
		$res 	=	$this->query($sql,0);
		
		$camposEscondido = "";
		/* Analizar para despues */
		/*if (count($refencias) > 0) {
			$j = 0;

			foreach ($refencias as $reftablas) {
				$sqlTablas = "select id".$reftablas.", ".$refdescripcion[$j]." from ".$reftablas." order by ".$refdescripcion[$j];
				$resultadoRef[$j][0] = $this->query($sqlTablas,0);
				$resultadoRef[$j][1] = $refcampos[$j];
			}
		}*/
		
		
		if ($res == false) {
			return 'Error al traer datos';
		} else {
			
			$form	=	'';
			
			while ($row = mysql_fetch_array($res)) {
				
				$i = 0;
				foreach ($lblcambio as $cambio) {
					if ($row[0] == $lblcambio) {
						$label = $lblreemplazo[$i];
						break 2;
					} else {
						$label = $row[0];
					}
					$i = $i + 1;
				}
				
				if ($row[3] != 'PRI') {
					if (strpos($row[1],"decimal") !== false) {
						$form	=	$form.'
						
						<div class="form-group col-md-6">
							<label for="'.$label.'" class="control-label" style="text-align:left">'.ucwords($label).'</label>
							<div class="input-group col-md-12">
								<span class="input-group-addon">$</span>
								<input type="text" class="form-control" id="'.$row[0].'" name="'.$row[0].'" value="0" required>
								<span class="input-group-addon">.00</span>
							</div>
						</div>
						
						';
					} else {
						if ( in_array($row[0],$refCampo) ) {
							
							$campo = $row[0];
							
							$option = $refdescripcion[array_search($row[0], $refCampo)];
							
							
							$form	=	$form.'
							
							<div class="form-group col-md-6">
								<label for="'.$campo.'" class="control-label" style="text-align:left">'.$label.'</label>
								<div class="input-group col-md-12">
									<select class="form-control" id="'.$campo.'" name="'.$campo.'">
										';
							
							$form	=	$form.$option;
							
							$form	=	$form.'		</select>
								</div>
							</div>
							
							';
							
						} else {
							
							if (strpos($row[1],"bit") !== false) {
								$label = ucwords($label);
								$campo = $row[0];
								
								$form	=	$form.'
								
								<div class="form-group col-md-6">
									<label for="'.$campo.'" class="control-label" style="text-align:left">'.$label.'</label>
									<div class="input-group col-md-12 fontcheck">
										<input type="checkbox" class="form-control" id="'.$campo.'" name="'.$campo.'" style="width:50px;" required> <p>Si/No</p>
									</div>
								</div>
								
								';
								
								
							} else {
								
								if (strpos($row[1],"date") !== false) {
									$label = ucwords($label);
									$campo = $row[0];
									
									$form	=	$form.'
									
									<div class="form-group col-md-6">
										<label for="'.$campo.'" class="control-label" style="text-align:left">'.$label.'</label>
										<div class="input-group date form_date col-md-6" data-date="" data-date-format="dd MM yyyy" data-link-field="'.$campo.'" data-link-format="yyyy-mm-dd">
											<input class="form-control" size="50" type="text" value="" readonly>
											<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
										</div>
									</div>
									
									';
									
								} else {
									$label = ucwords($label);
									$campo = $row[0];
									
									$form	=	$form.'
									
									<div class="form-group col-md-6">
										<label for="'.$campo.'" class="control-label" style="text-align:left">'.$label.'</label>
										<div class="input-group col-md-12">
											<input type="text" class="form-control" id="'.$campo.'" name="'.$campo.'" placeholder="Ingrese el '.$label.'..." required>
										</div>
									</div>
									
									';
								}
							}
						}
						
						
					}
				} else {
	
					$camposEscondido = $camposEscondido.'<input type="hidden" id="accion" name="accion" value="'.$accion.'"/>';	
				}
			}
			
			$formulario = $form."<br><br>".$camposEscondido;
			
			return $formulario;
		}	
	}



	function camposTablaMod($accion,$id) {
		
		$resTipoVenta = $this->traerUsuariosPorId($id);
		
		$sql	=	"show columns from se_usuarios";
		$res 	=	$this->query($sql,0);
		if ($res == false) {
			return 'Error al traer datos';
		} else {
			
			$form	=	'';
			
			while ($row = mysql_fetch_array($res)) {
				if ($row[3] != 'PRI') {
					if (strpos($row[1],"decimal") !== false) {
						$form	=	$form.'
						
						<div class="form-group col-md-6">
							<label for="'.$row[0].'" class="control-label" style="text-align:left">'.ucwords($row[0]).'</label>
							<div class="input-group col-md-12">
								<span class="input-group-addon">$</span>
								<input type="text" class="form-control" id="'.$row[0].'" name="'.$row[0].'" value="'.mysql_result($resTipoVenta,0,$row[0]).'" required>
								<span class="input-group-addon">.00</span>
							</div>
						</div>
						
						';
					} else {
						
						$formTabla = "";
						$formReferencia = "";
						switch ($row[0]) {
							case "refroll":
								$label = "Rol";
								$campo = $row[0];
								
								$formTabla = '
									<div class="form-group col-md-6">
										<label for="'.$campo.'" class="control-label" style="text-align:left">'.$label.'</label>
										<div class="input-group col-md-12">
													
											<select class="form-control" id="'.$campo.'" name="'.$campo.'">
												';
												if (mysql_result($resTipoVenta,0,$campo) == 'SuperAdmin') {
													$formTabla = $formTabla.'
														<option value="SuperAdmin" selected>SuperAdmin</option>
														<option value="Administrador">Administrador</option>
														<option value="Empleado">Empleado</option>
													';
												}
												if (mysql_result($resTipoVenta,0,$campo) == 'Administrador') {
													$formTabla = $formTabla.'
														<option value="SuperAdmin">SuperAdmin</option>
														<option value="Administrador" selected>Administrador</option>
														<option value="Empleado">Empleado</option>
													';
												}
												if (mysql_result($resTipoVenta,0,$campo) == 'Empleado') {
													$formTabla = $formTabla.'
														<option value="SuperAdmin">SuperAdmin</option>
														<option value="Administrador">Administrador</option>
														<option value="Empleado" selected>Empleado</option>
													';
												}
												
								$formTabla = $formTabla.'</select>
										</div>
									</div>
									
									';
								
								break;
							case "refvalores":
								$label = "Aplica Sobre";
								$campo = $row[0];
								
								$sqlRef = "select idvalor,descripcion from lcdd_valores";
								$resRef = $this->query($sqlRef,0);
								
								$formRefDivUno = '<div class="form-group col-md-6">
											<label for="'.$row[0].'" class="control-label" style="text-align:left">'.$label.'</label>
											<div class="input-group col-md-12">
												<select class="form-control" id="'.$campo.'" name="'.$campo.'" >';
								$formRefDivDos = "</select></div></div>";
								$formOption = "";
								
								while ($rowRef = mysql_fetch_array($resRef)) {
									if (mysql_result($resTipoVenta,0,$campo) == $rowRef[0]) {
										$formOption = $formOption."<option value='".$rowRef[0]."' selected>".$rowRef[1]."</option>";
									} else {
										$formOption = $formOption."<option value='".$rowRef[0]."'>".$rowRef[1]."</option>";
									}
								}
								
								$formReferencia = $formRefDivUno.$formOption.$formRefDivDos;
								
								break;
							default:
								$label = ucwords($row[0]);
								$campo = $row[0];
								
								$formTabla = '
									<div class="form-group col-md-6">
										<label for="'.$campo.'" class="control-label" style="text-align:left">'.$label.'</label>
										<div class="input-group col-md-12">
											<input type="text" class="form-control" value="'.utf8_encode(mysql_result($resTipoVenta,0,$campo)).'" id="'.$campo.'" name="'.$campo.'" placeholder="Ingrese el '.$label.'..." required>
										</div>
									</div>
									
									';
									
								break;
							}
						
						
						
						$form	=	$form.$formReferencia.$formTabla;
					}
				} else {
					$camposEscondido = '<input type="hidden" id="id" name="id" value="'.$id.'"/>';
					$camposEscondido = $camposEscondido.'<input type="hidden" id="accion" name="accion" value="'.$accion.'"/>';	
				}
			}
			
			$formulario = $form."<br><br>".$camposEscondido;
			
			return $formulario;
		}	
	}


	Function TraerUsuario($nombre,$pass) {
		
		require_once 'appconfig.php';

		$appconfig	= new appconfig();
		$datos		= $appconfig->conexion();
		$hostname	= $datos['hostname'];
		$database	= $datos['database'];
		$username	= $datos['username'];
		$password	= $datos['password'];
		
		
		$conn = mysql_connect($hostname,$username,$password) or die ("no se puede conectar".mysql_error());
		
		$db = mysql_select_db($database);
	 
	 	
	 
		$error = 0;		
		
		
		
		$sqlusu = "select * from dbusuarios where usuario = '".$nombre."'";
		
		$respusu = mysql_query($sqlusu,$conn) or die (mysql_error(1));;
		
		$filas = mysql_num_rows($respusu);
		
		if ($filas > 0) {
			$sqlpass = "select * from dbusuarios where Pass = '".$pass."' and idusuario = ".mysql_result($respusu,0,0);
		    //echo $sqlpass;
		    $error = 1;
		    
			$resppass = mysql_query($sqlpass,$conn) or die (mysql_error(1));;
			
			$filas2 = mysql_num_rows($resppass);
			
			if ($filas2 > 0) {
				$error = 1;
				
				$_SESSION['sg_usuario'] = $nombre;
				$_SESSION['sg_pass'] = $pass;
				
				} else {
				$error = 0;
				}
			
			}
			else
			
			{
				$error = 0;	
			}
			
	    mysql_close($conn);
	
		return $error;
		
	}
	
	Function TraerTipoDoc() {
		$sql = "select * from tbtipodoc";
		return $this-> query($sql,0);
	}
	
	
	
	function activarTabla($tabla,$id,$campo,$todos)
	{
		if ($todos == true) {
		$sql = "update ".$tabla." set activo = false";
		$this-> query($sql,0);
		}
		
		$sql = "";
		$sql = "update ".$tabla." set activo = true where ".$campo." = ".$id;
		$this-> query($sql,0);
	}
	
	function TraerTorneos() {
		$sql = "select t.nombre,t.fechacreacion,t.activo,tt.descripciontorneo from dbtorneos t
				inner join
				tbtipotorneo tt on t.reftipotorneo = tt.idtipotorneo
				order by idtorneo desc";
		return $this-> query($sql,0);
	}
	
	function TraerIdTorneos($id) {
		$sql = "select * from dbtorneos where idtorneo = ".$id;
		return $this-> query($sql,0);
	}
	
function TraerTorneosClientes() {
		$sql = "select * from dbtorneos where idtorneo >23 and activo = 0 order by idtorneo";
		return $this-> query($sql,0);
	}

	function TraerTorneosActivo() {
		$sql = "select * from dbtorneos where activo = 1";
		return $this-> query($sql,0);
	}
	
	function insertTorneo($nombre) {
		$usu = utf8_encode($nombre);
		$fechacrea = date('Y-m-d');
		$activo = true;
		
		if (trim($nombre) != "") 
		{
		
		$nombre = str_replace("'","",$nombre);
		
		
		
		$sql = "insert into dbtorneos(idtorneo,nombre,fechacreacion,activo) values ('','".$nombre."', '".$fechacrea."', ".$activo.")";
		$this-> query($sql,1);
		
		$idUltimo = "select max(idtorneo) from dbtorneos";
		$resid = $this-> query($idUltimo,0);
		$idtorneo = mysql_result($resid,0,0);
		$this->activarTabla("dbtorneos",$idtorneo,"idtorneo",true);
		return 1;
		} else {
			return 0;
		}
	}
	
	function modificarTorneo($nombre,$activo,$idtorneo) {
		$fechacrea = date('Y-m-d');
		$nombre = str_replace("'","",$nombre);
		
		if (trim($nombre) != "") 
		{
		if ($activo == true) {
			$this->activarTabla("dbtorneos",$idtorneo,"idtorneo",true);
		}
		
		$sql = "update dbtorneos set nombre = '".$nombre."', fechacreacion = '".$fechacrea."', activo =".$activo." where idtorneo =".$idtorneo;
		$this-> query($sql,0);
		return 1;
		} else {
			return 0;
		}
		
	}
	
	
	function eliminarTorneo($idtorneo) {
		
		//fijarse si este torneo no tiene relacionado ningun grupo.
		$sqlHayGrupos = "select * from dbtorneoge where reftorneo =".$idtorneo;
		$resHayGrupos = $this-> query($sqlHayGrupos,0);
		
		
		$HayFilas = mysql_num_rows($resHayGrupos);
		
		if ($HayFilas < 1) {
		$sql = "delete from dbtorneos where idtorneo =".$idtorneo;
		$this-> query($sql,0);
		return 1;
		} else {
			return 0;
		}
		
	}
	
	function TraerFecha() {
		$sql = "select * from tbfechas";
		return $this-> query($sql,0);
	}
	
	
	function TraerIdFecha($fecha) {
		$sql = "select * from tbfechas where idfecha=".$fecha;
		return $this-> query($sql,0);
	}
	
	
	function ModificarFechas($fecha,$resumen) {
		header( 'Content-type: text/html; charset=iso-8859-1' );
		
		
		$sqlfecha = "select * from tbfechas where tipofecha='".$fecha."'";
		
		$resfecha = $this->query($sqlfecha,0);
		$idfecha= mysql_result($resfecha,0,0);
		
		$sql = "update tbfechas set resumen = '".utf8_decode($resumen)."' where idfecha=".$idfecha;
		return $this-> query($sql,0);
	}
	
	function insertarContacto($nombre,$apellido,$mail,$asunto,$mensaje) {
		
		$sql = "insert into dbcontactos(dbcontactos.idcontacto,
										dbcontactos.nombre,
										dbcontactos.apellido,
										dbcontactos.asunto,
										dbcontactos.mensaje,
										dbcontactos.telefono,
										dbcontactos.mail,
										dbcontactos.domicilio,
										dbcontactos.imagen) values 
										('','".$nombre."','".$apellido."','".$asunto."','".$mensaje."',null,'".$mail."','','')";

                $correo = "info@complejoshowbol.com.ar"; 
mail($correo, "ComplejoShowBol", "Te enviaron un correo. Nombre: ".$nombre.", Asunto: ".$asunto.",Mail: ".$mail.",Mensaje: ".$mensaje);
                
                $correo = "matias_ortega22@hotmail.com"; 
mail($correo, "ComplejoShowBol", "Te enviaron un correo. Nombre: ".$nombre.", Asunto: ".$asunto.",Mail: ".$mail.",Mensaje: ".$mensaje);


                $correo = "msredhotero@msn.com"; 
mail($correo, "ComplejoShowBol", "Te enviaron un correo. Nombre: ".$nombre.", Asunto: ".$asunto.",Mail: ".$mail.",Mensaje: ".$mensaje);



		return $this-> query($sql,1);
		//return $sql;
	}
	
	Function query($sql,$accion) {
		
		require_once 'appconfig.php';

		$appconfig	= new appconfig();
		$datos		= $appconfig->conexion();
		$hostname	= $datos['hostname'];
		$database	= $datos['database'];
		$username	= $datos['username'];
		$password	= $datos['password'];
		
		
		$conex = mysql_connect($hostname,$username,$password) or die ("no se puede conectar".mysql_error());
		
		mysql_select_db($database);
		
		$result = mysql_query($sql,$conex);
		if ($accion && $result) {
			$result = mysql_insert_id();
		}
		mysql_close($conex);
		return $result;
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	}

?>