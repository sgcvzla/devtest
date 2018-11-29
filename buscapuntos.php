<?php 
session_start();
header('Content-Type: application/json');
include_once("conexion.php");

$codigo = isset($_GET['codigo']) ? $_GET['codigo'] : '';
$codigo = trim($codigo);

$respuesta = '';
$quer0 = "select tit_nombres,tit_apellidos,pmo from afiliados where tit_codigo='".$codigo."'";
$resul0 = mysql_query($quer0,$link);
if ($ro0 = mysql_fetch_array($resul0)) {
	$respuesta = '{"nombre":"'.trim($ro0["tit_nombres"]).' '.trim($ro0["tit_apellidos"]).'"';

	// Buscar puntos actuales
	$query = "SELECT * FROM transacciones where afiliado='".trim($codigo)."' and status_comision='Conciliada'";
	$result = mysql_query($query,$link);
	$cierto = true;
	$coma = '';
	$cierre = false;
	$resp2 = '';
	$pm = 0;
	while($row = mysql_fetch_array($result)) {
		if ($cierto) {
			$resp2 .= '"detpmactual":';
			$cierto = false;
			$cierre = true;
			$coma = '[';
		} else {
			$coma = ',';
		}
		$resp2 .= $coma.'{"orden_id":'.trim($row["orden_id"]).',"idtran":'.trim($row["id"]).',"fecha":"'.trim($row["fecha"]).'","puntos":'.trim($row["puntos"]).'}';
		$pm += $row["puntos"];
	}
	$resp2 .= ($cierre) ? ']' : '' ;
	if ($pm<>0) {
		$respuesta .= ',"pmactual":'.$pm.','.$resp2;
	} else {
		$respuesta .= ',"pmactual":'.$pm;
	}

	// Buscar pmo actuales
	$quer2 = "SELECT afiliado FROM organizacion where organizacion='".trim($codigo)."' order by afiliado";
	$resul2 = mysql_query($quer2,$link);
	$cierto = true;
	$coma = '';
	$cierre = false;
	$resp2 = '';
	$pmo = 0;
	while($ro2 = mysql_fetch_array($resul2)) {
		$quer3 = "SELECT sum(puntos) as pmo FROM transacciones where afiliado='".trim($ro2["afiliado"])."' and status_comision='Conciliada'";
		if ($resul3 = mysql_query($quer3,$link)) {
			$ro3 = mysql_fetch_array($resul3);
			if ($ro3["pmo"]<>0) {
				if ($cierto) {
					$resp2 .= '"detpmoactual":';
					$cierto = false;
					$cierre = true;
					$coma = '[';
				} else {
					$coma = ',';
				}
				$querx = "select tit_nombres,tit_apellidos from afiliados where tit_codigo='".trim($ro2["afiliado"])."'";
				$resulx = mysql_query($querx,$link);
				$rox = mysql_fetch_array($resulx);
				$resp2 .= $coma.'{"afiliado":"'.trim($ro2["afiliado"]).' - '.trim($rox["tit_nombres"]).' '.trim($rox["tit_apellidos"]).'","puntos":'.trim($ro3["pmo"]).'}';
				$pmo += $ro3["pmo"];
			}
		}
	}
	$resp2 .= ($cierre) ? ']' : '' ;
	if ($pmo<>0) {
		$respuesta .= ',"pmoactual":'.$pmo.','.$resp2;
	} else {
		$respuesta .= ',"pmoactual":'.$pmo;
	}

	// Buscar puntos historicos
	$query = "SELECT * FROM hist_transacciones where afiliado='".trim($codigo)."' and status_comision='Conciliada'";
	$result = mysql_query($query,$link);
	$cierto = true;
	$coma = '';
	$cierre = false;
	$resp2 = '';
	$pm = 0;
	while($row = mysql_fetch_array($result)) {
		if ($cierto) {
			$resp2 .= '"detpmhist":';
			$cierto = false;
			$cierre = true;
			$coma = '[';
		} else {
			$coma = ',';
		}
		$resp2 .= $coma.'{"orden_id":'.trim($row["orden_id"]).',"idtran":'.trim($row["id"]).',"fecha":"'.trim($row["fecha"]).'","puntos":'.trim($row["puntos"]).'}';
		$pm += $row["puntos"];
	}
	$resp2 .= ($cierre) ? ']' : '' ;
	if ($pm<>0) {
		$respuesta .= ',"pmhist":'.$pm.','.$resp2;
	} else {
		$respuesta .= ',"pmhist":'.$pm;
	}

	// Buscar pmo historicos
	$quer2 = "SELECT afiliado FROM organizacion where organizacion='".trim($codigo)."' order by afiliado";
	$resul2 = mysql_query($quer2,$link);
	$cierto = true;
	$coma = '';
	$cierre = false;
	$resp2 = '';
	$pmo = 0;
	while($ro2 = mysql_fetch_array($resul2)) {
		$quer3 = "SELECT sum(puntos) as pmo FROM hist_transacciones where afiliado='".trim($ro2["afiliado"])."' and status_comision='Conciliada'";
		if ($resul3 = mysql_query($quer3,$link)) {
			$ro3 = mysql_fetch_array($resul3);
			if ($ro3["pmo"]<>0) {
				if ($cierto) {
					$resp2 .= '"detpmohist":';
					$cierto = false;
					$cierre = true;
					$coma = '[';
				} else {
					$coma = ',';
				}
				$querx = "select tit_nombres,tit_apellidos from afiliados where tit_codigo='".trim($ro2["afiliado"])."'";
				$resulx = mysql_query($querx,$link);
				$rox = mysql_fetch_array($resulx);
				$resp2 .= $coma.'{"afiliado":"'.trim($ro2["afiliado"]).' - '.trim($rox["tit_nombres"]).' '.trim($rox["tit_apellidos"]).'","puntos":'.trim($ro3["pmo"]).'}';
				$pmo += $ro3["pmo"];
			}
		}
	}
	$resp2 .= ($cierre) ? ']' : '' ;
	if ($pmo<>0) {
		$respuesta .= ',"pmohist":'.$pmo.','.$resp2;
	} else {
		$respuesta .= ',"pmohist":'.$pmo;
	}

	// Cierre del json
	$respuesta .= '}';
} else {
	$respuesta = 'No encontrada';
}
echo $respuesta;
?>
