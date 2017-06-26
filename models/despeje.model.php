<?php

require_once("libs/dao.php");

function registrarDespeje($tiempo,$cuadrillas,$personal,$fecha,$aprobacionId){
  $insertSQL = "INSERT INTO `cimeqh`.`tblsolicituddespeje`
(`solicitudDespejeHoras`,
`solicitudDespejeCuadrillas`,
`solicitudDespejeCantidadPersonal`,
`solicitudDespejeFecha`,
`tblsolicitudaprobacion_solicitudAprobacionId`,
`estadoDespejeId`)
VALUES
(%d,%d,%d,'%s',%d,4);";
  $insertSQL = sprintf($insertSQL,$tiempo,$cuadrillas,$personal,$fecha,$aprobacionId);

  if (ejecutarNonQuery($insertSQL)) {
    return getLastInserId();
  }

}

function actualizarDespeje($tiempo,$cuadrillas,$personal,$fecha,$despejeId){
  $insertSQL = "UPDATE `tblsolicituddespeje`
SET
`solicitudDespejeHoras` =%d,
`solicitudDespejeCuadrillas` = %d,
`solicitudDespejeCantidadPersonal` = %d,
`solicitudDespejeFecha` = '%s',
`estadoDespejeId` = 4,
`comentarioDespeje` = ''
WHERE `solicitudDespejeId` = %d;
";
  $insertSQL = sprintf($insertSQL,$tiempo,$cuadrillas,$personal,$fecha,$despejeId);

  if (ejecutarNonQuery($insertSQL)) {
    return getLastInserId();
  }

}

function verSolicitudesDespeje(){
    $solicitudFactibilidad = array();
    $sqlstr = "SELECT tbled.estadoDespejeDescripcion,solicitudDespejeId,solicitudDespejeHoras,solicitudDespejeCuadrillas,solicitudDespejeCantidadPersonal,
solicitudDespejeFecha, proyectoNombrePropietario,proyectoIdentidadPropietario,proyectoDescrpcion,
proyectoLatitud,proyectoLongitud,departamentoDescripcion,concat(usuarioPrimerNombre, ' ' ,usuarioSegundoNombre ,' ',
usuarioPrimerApellido, ' ', usuarioSegundoApellido) 'ingenieroNombre',proyectoNombre,proyectoDescrpcion,
usuarioNumeroColegiacion,proyectoDireccion,proyectoTelefonoPropietario,proyectoEmailPropietario,
proyectoEmailPropietario,proyectoIdentidadPropietario,usuarioCelular,usuarioTelefono,proyectoCelularPropietario,
proyectoTelefonoPropietario,proyectoDireccionPropietario
FROM tblsolicituddespeje tblsd,tblsolicitudaprobacion tblsa, tblproyectos tblp, tblusuarios tblu,
tbldepartamentos tblde, tblestadodespeje tbled
where tblsd.tblsolicitudaprobacion_solicitudAprobacionId=tblsa.solicitudAprobacionId and
tbled.estadoDespejeId=tblsd.estadoDespejeId
and tblsa.proyectoId=tblp.proyectoId and tblde.departamentoId=tblp.departamentoId and
tblp.usuarioIdentidad=tblu.usuarioIdentidad and tblsd.estadoDespejeId=4;";
    $solicitudFactibilidad = obtenerRegistros($sqlstr);
    return $solicitudFactibilidad;
}

function obtenerSolicitudDespejePorId($solicitudId){
$proyecto = array();
$sqlstr = "SELECT estadoDespejeDescripcion,solicitudDespejeId,solicitudDespejeHoras,solicitudDespejeCuadrillas,solicitudDespejeCantidadPersonal,
solicitudDespejeFecha, proyectoNombrePropietario,proyectoIdentidadPropietario,proyectoDescrpcion,
proyectoLatitud,proyectoLongitud,departamentoDescripcion,concat(usuarioPrimerNombre, ' ' ,usuarioSegundoNombre ,' ',
usuarioPrimerApellido, ' ', usuarioSegundoApellido) 'ingenieroNombre',proyectoNombre,proyectoDescrpcion,
usuarioNumeroColegiacion,proyectoDireccion,proyectoTelefonoPropietario,proyectoEmailPropietario,
proyectoEmailPropietario,proyectoIdentidadPropietario,usuarioCelular,usuarioTelefono,proyectoCelularPropietario,
proyectoTelefonoPropietario,proyectoDireccionPropietario
FROM tblsolicituddespeje tblsd,tblsolicitudaprobacion tblsa, tblproyectos tblp, tblusuarios tblu,
tbldepartamentos tblde, tblestadodespeje tbled
where tblsd.tblsolicitudaprobacion_solicitudAprobacionId=tblsa.solicitudAprobacionId and
tbled.estadoDespejeId=tblsd.estadoDespejeId
and tblsa.proyectoId=tblp.proyectoId and tblde.departamentoId=tblp.departamentoId and
tblp.usuarioIdentidad=tblu.usuarioIdentidad and solicitudDespejeId=%d;";
$sqlstr = sprintf($sqlstr, $solicitudId);
$proyecto = obtenerUnRegistro($sqlstr);
return $proyecto;
}


function obtenerDespeje(){
    $solicitudes = array();
    $sqlstr = "SELECT if(ed.estadoDespejeId=2,true,null) 'reintentar',sd.solicitudDespejeId,ed.estadoDespejeDescripcion,sd.solicitudDespejeId, sd.estadoDespejeId,sa.solicitudAprobacionId,p.proyectoId,p.proyectoNombre,p.proyectoNombrePropietario,p.proyectoIdentidadPropietario,sd.solicitudDespejeFecha,sd.solicitudDespejeHoras,sd.solicitudDespejeCantidadPersonal,sd.solicitudDespejeCantidadPersonal,sd.comentarioDespeje FROM tblsolicituddespeje as sd, tblsolicitudaprobacion as sa, tblproyectos as p, tblestadodespeje as ed where p.proyectoId=sa.proyectoId and sa.solicitudAprobacionId=sd.tblsolicitudaprobacion_solicitudAprobacionId and sd.estadoDespejeId=ed.estadoDespejeId;";
    $solicitudes = obtenerRegistros($sqlstr);
    return $solicitudes;
}

 ?>
