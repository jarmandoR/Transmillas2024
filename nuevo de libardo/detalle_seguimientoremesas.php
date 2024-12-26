<?php

require("login_autentica.php");
include("cabezote3.php");

$asc = "ASC";
$conde = " ";
$conde2 = " ";
$conde3 = " ";
$conde4 = " ";
$conde5 = " ";

if ($param34 != '') {
    $fechaactual = $param34;
}

if ($param35 != '') {
    $id_sedes = $param35;

    $conde = " and seg_ciudadori=$id_sedes ";
}

if ($param32 != '') {
    $id_sedes = $param32;

    $conde2 = " and seg_ciudadofinal=$id_sedes ";
}

if ($param33 != '') {
    $conde3 = "and `seg_operador`= '$param33' ";
}

$FB->titulo_azul1("IDViaje", 1, 0, 7);
$FB->titulo_azul1("Fecha Inicio", 1, 0, 0);
$FB->titulo_azul1("Ciudad Origen", 1, 0, 0);
$FB->titulo_azul1("Ciudad Destino", 1, 0, 0);
$FB->titulo_azul1("Operador", 1, 0, 0);
$FB->titulo_azul1("Remesas Pagadas", 1, 0, 0);
$FB->titulo_azul1("Remesas Pendientes", 1, 0, 0);
$FB->titulo_azul1("Gastos viaje", 1, 0, 0);
$FB->titulo_azul1("Traspasos", 1, 0, 0);
$FB->titulo_azul1("Total a Entregar", 1, '5%', 0);
$FB->titulo_azul1("Fecha Confirmado", 1, 0, 0);
$FB->titulo_azul1("Recibido Por", 1, '5%', 0);
$FB->titulo_azul1("Valor Confirmado", 1, '5%', 0);
$FB->titulo_azul1("Confirmar", 1, '5%', 0);
$FB->titulo_azul1("Estado", 1, '5%', 0);
$FB->titulo_azul1("Agregar", 1, '5%', 0);
$FB->titulo_azul1("Agregar", 1, '5%', 0);

if ($nivel_acceso == 1 or $nivel_acceso == 12) {
    $FB->titulo_azul1("Eliminar", 1, '5%', 0);
}

if ($param34 != '') {
    $fechaactual = $param34 . " 00:00:00";
}
if ($param36 != '') {
    $fechafinal = $param36 . " 23:59:59";
}

if ($param37 != '0') {
    $conde5 = " and usu_tipocontrato='$param37'";
}

$sql = "SELECT `idseguimientoremesas`, `seg_fechaini`, `ciu_nombre`, `seg_ciudadofinal`, 
        u1.usu_nombre AS usu_nombre1, `seg_operador`, `seg_idvehiculo`, `seg_userprogra`, 
        `seg_userentrega`, `seg_fechafinal`, `seg_valorconfirmado`, u2.usu_nombre AS usu_nombre2
    FROM `seguimiento_remesas` 
        inner join ciudades on idciudades=seg_ciudadori 
        inner join usuarios u1 on u1.idusuarios=seg_operador 
        left join usuarios u2 on u2.idusuarios=seg_userconfirma
    where  seg_fechaini>='{$fechaactual}' 
        and seg_fechaini<='{$fechafinal}' {$conde} {$conde2} {$conde3}
    ORDER BY 1  Desc";

$DB1->Execute($sql);
$va = 0;
$totalpagadas = 0;
$totalconfirmadas = 0;

while ($rw1 = mysqli_fetch_row($DB1->Consulta_ID)) {


    $id_p = $rw1[0];

    $imprimir = 1;
    $sql1 = " SELECT ciu_nombre FROM `ciudades` where idciudades='$rw1[3]'";
    $DB->Execute($sql1);
    $rw2 = mysqli_fetch_row($DB->Consulta_ID);
    $ciudestino = $rw2[0];

    $va++;
    $p = $va % 2;
    if ($p == 0) {
        $color = "#FFFFFF";
    } else {
        $color = "#EFEFEF";
    }
    echo "<tr class='text' bgcolor='$color' onmouseover='this.style.backgroundColor=\"#C8C6F9\"' onmouseout='this.style.backgroundColor=\"$color\"'>";
    echo "<td>" . $rw1[0] . "</td>";
    echo "<td>" . $rw1[1] . "</td>";
    echo "<td>" . $rw1[2] . "</td>";
    echo "<td>" . $ciudestino . "</td>";
    echo "<td>" . $rw1[4] . "</td>";

    $DB->Execute("SELECT count(*) as cuantos, sum(gas_valor) as valor FROM viajesremesas WHERE gas_idseguimientoremesas=$rw1[0] AND gas_estado = 'Pagado'");
    $datosRemesas = mysqli_fetch_row($DB->Consulta_ID);
    $dineroremesas = $datosRemesas[0];
    $totalAEntregar = $datosRemesas[1];
    $totalpagadas += $totalAEntregar;

    $DB->Execute("SELECT count(*) FROM viajesremesas WHERE gas_idseguimientoremesas=$rw1[0] AND gas_estado = 'Pendiente'");
    $dinerorfaltantes = $DB->recogedato(0);

    $DB->Execute("SELECT count(*) FROM asignaciondinero WHERE asi_idseguimientoremesas=$rw1[0]");
    $dinerogastos = $DB->recogedato(0);

    $totalconfirmadas += $rw1[10];

    echo "<td colspan='1' width='0' align='center' ><a id='link'  onclick='pop_dis16($rw1[0],\"dineroremesas\",\"Pagado\")';  title='Dinero Remesas' >$dineroremesas</td>";
    echo "<td colspan='1' width='0' align='center' ><a id='link'  onclick='pop_dis16($rw1[0],\"dineroremesas\",\"Pendiente\")';  title='Dinero Faltantes' >$dinerorfaltantes</td>";
    echo "<td colspan='1' width='0' align='center' ><a id='link'  onclick='pop_dis16($rw1[0],\"dinerogastos\",\"$rw1[3]\")';  title='Dinero Gatos' >$dinerogastos</td>";
    echo "<td colspan='1' width='0' align='center' ><a id='link'  onclick='pop_dis16($rw1[0],\"traspasoso\",\"$rw1[3]\")';  title='Dinero Gatos' >$dinerogastos</td>";
    echo "<td style='text-align: right;'>" . number_format($totalAEntregar, 0, ".", ".") . "</td>";
    echo "<td>{$rw1[9]}</td>";
    echo "<td>{$rw1[11]}</td>";
    echo "<td style='text-align: right;'>" . number_format($rw1[10], 0, ".", ".") . "</td>";

    if ($nivel_acceso == 1 or $nivel_acceso == 5 or $nivel_acceso == 11) {
        if (empty($rw1[10])) {
            echo "<td align='center'><a  onclick='pop_dis10($rw1[0],\"ConfirmarSeguimientoRemesa\",\"$rw1[4]\")';  style='cursor: pointer;' title='Confirmar' ><img src='img/Confirmar1.png'></a></td>";
        } else {
            echo "<td align='center'><img src='img/Confirmar.png'></a></td>";
        }
    } else {
        echo "<td align='center'><img src='img/Confirmar.png'></a></td>";
    }

    if (empty($rw1[10])) {
        echo "<td>PROCESANDO</td>";
        echo "<td colspan='1' width='0' align='center' ><a id='link'  onclick='pop_dis16($rw1[0],\"addremesas\",\"$rw1[5]\")';  title='Remesas' > <i class='fa fa-plus'></i>Remesas</a></td>";
        echo "<td colspan='1' width='0' align='center' ><a id='link'  onclick='pop_dis16($rw1[0],\"addgastos\",\"$rw1[5]\")';  title='addgastos' > <i class='fa fa-plus'></i>Gastos</a></td>";
    } else {
        echo "<td>CONFIRMADO</td>";
        echo "<td colspan='1' width='0' align='center' >&nbsp;</td>";
        echo "<td colspan='1' width='0' align='center' >&nbsp;</td>";
    }

    if ($nivel_acceso == 1 or $nivel_acceso == 12) {
        $DB->edites($rw1[0], "seguimiento_remesas", 2, "");
    }
}



$FB->titulo_azul1(" Totales :", 1, 0, 10);
$FB->titulo_azul1(" ------", 1, 0, 0);

$FB->titulo_azul1(" ------", 1, 0, 0);
$FB->titulo_azul1(" ------", 1, 0, 0);
$FB->titulo_azul1(" ------", 1, 0, 0);
$FB->titulo_azul1(" ------", 1, 0, 0);
$FB->titulo_azul1(" ------", 1, 0, 0);
$FB->titulo_azul1(" ------", 1, 0, 0);
$FB->titulo_azul1(number_format($totalpagadas, 0, ".", "."), 1, 0, 0);
$FB->titulo_azul1(" ------", 1, 0, 0);
$FB->titulo_azul1(" ------", 1, 0, 0);
$FB->titulo_azul1(number_format($totalconfirmadas, 0, ".", "."), 1, 0, 0);
$FB->titulo_azul1(" ------", 1, 0, 0);
$FB->titulo_azul1(" ------", 1, 0, 0);
$FB->titulo_azul1(" ------", 1, 0, 0);
$FB->titulo_azul1(" ------", 1, 0, 0);
$FB->titulo_azul1(" ------", 1, 0, 0);

include("footer.php");
?>