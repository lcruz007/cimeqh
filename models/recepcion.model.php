<?php

require_once("libs/dao.php");

function registrarRecepcion($aprobacionId){
  $insertSQL = "INSERT INTO `tblsolicitudrecepcion`
(`solicitudRecepcioEstado`,
`solicitudAprobacionId`)
VALUES
(4,%d);";
  $insertSQL = sprintf($insertSQL,$aprobacionId);

  if (ejecutarNonQuery($insertSQL)) {
    return getLastInserId();
  }

}

function borrarRecepcion($recepcionId){
   $sqlstr = sprintf("delete from tblsolicitudrecepcion where solicitudRecepcionId= %d",$recepcionId);
   if(ejecutarNonQuery($sqlstr)){
       return getLastInserId();
   }
}

function obtenerSolicitudRecepcion(){
    $solicitudes = array();
    $sqlstr = "select solicitudRecepcioId,solicitudRecepcioEstado,tblr.solicitudAprobacionId,tblp.proyectoNombre, tbld.departamentoDescripcion,tblp.proyectoDireccion, tblp.proyectoDescrpcion ,
tblp.proyectoLatitud,proyectoLongitud, proyectoNombrePropietario,proyectoIdentidadPropietario,
proyectoDireccionPropietario,proyectoEmailPropietario,proyectoTelefonoPropietario,
concat(usuarioPrimerNombre, ' ' ,usuarioSegundoNombre ,' ',
usuarioPrimerApellido, ' ', usuarioSegundoApellido) 'ingenieroNombre',tblu.usuarioNumeroColegiacion,
tblu.usuarioCelular,tblu.usuarioTelefono, tblre.estadoRecepcionDescripcion
from tblestadorecepcion tblre,tblsolicitudrecepcion tblr, tblusuarios tblu
,tblsolicitudaprobacion tbla, tblproyectos tblp, tbldepartamentos tbld
where tblr.solicitudRecepcioEstado=tblre.estadoRecepcionId and tbld.departamentoId=tblp.departamentoId and tblu.usuarioIdentidad=tblp.usuarioIdentidad
and tblr.solicitudAprobacionId=tbla.solicitudAprobacionId and tblp.proyectoId=tbla.proyectoId
and solicitudRecepcioEstado=4;";
    $solicitudes = obtenerRegistros($sqlstr);
    return $solicitudes;
}


function obtenerUnDocumentoRecepcion($solicitudId){
    $solicitudes = array();
    $sqlstr = "SELECT documentoNombre,proyectoNombre,proyectoDescrpcion,documentoRecepcionDireccion
FROM tbldocumentosrecepcion tbld,tblsolicitudrecepcion tblr, tblsolicitudaprobacion tblsa,
tblproyectos tblp
where tbld.solicitudRecepcionId=tblr.solicitudRecepcioId and tblr.solicitudAprobacionId=tblsa.solicitudAprobacionId
and tblsa.proyectoId=tblp.proyectoId
and solicitudRecepcioId=$solicitudId
order by proyectoNombre limit 1;";
    $solicitudes = obtenerUnRegistro($sqlstr);
    return $solicitudes;
}


function obtenerSolicitudRecepcionPorId($solicitudId){
    $solicitudes = array();
    $sqlstr = "SELECT proyectoNombre,departamentoDescripcion ,proyectoDireccion, proyectoDescrpcion,
    proyectoLatitud,proyectoLongitud,proyectoNombrePropietario,
    proyectoIdentidadPropietario, proyectoTelefonoPropietario, proyectoCelularPropietario,
    proyectoEmailPropietario, proyectoDireccionPropietario,
    concat(usuarioPrimerNombre, ' ' ,usuarioSegundoNombre ,' ',
    usuarioPrimerApellido, ' ', usuarioSegundoApellido) 'ingenieroNombre', usuarioNumeroColegiacion
    usuarioNumeroColegiacion, usuarioTelefono, usuarioCelular
    FROM cimeqh.tblsolicitudrecepcion tblre, tblsolicitudaprobacion tbla,
    tblproyectos tblp, tbldepartamentos tblde,tblusuarios tblu
    where tblre.solicitudAprobacionId=tbla.solicitudAprobacionId and tbla.proyectoId=tblp.proyectoId
    and tblp.departamentoId=tblde.departamentoId and tblu.usuarioIdentidad=tblp.usuarioIdentidad
    and solicitudRecepcioId=%d;";
    $sqlstr = sprintf($sqlstr, $solicitudId);
    $solicitudes = obtenerUnRegistro($sqlstr);
    return $solicitudes;
}


function obtenerDocumentosRecepcion($solicitudId){
    $solicitudes = array();
    $sqlstr = "SELECT documentoNombre,proyectoNombre,proyectoDescrpcion,documentoRecepcionDireccion
FROM tbldocumentosrecepcion tbld,tblsolicitudrecepcion tblr, tblsolicitudaprobacion tblsa,
tblproyectos tblp
where tbld.solicitudRecepcionId=tblr.solicitudRecepcioId and tblr.solicitudAprobacionId=tblsa.solicitudAprobacionId
and tblsa.proyectoId=tblp.proyectoId
and solicitudRecepcioId=$solicitudId;";
    $solicitudes = obtenerRegistros($sqlstr);
    return $solicitudes;
}


function agregarComentarioRecepcion($solicitudId, $comentario, $estado){
  $sqlstr="UPDATE `tblsolicitudrecepcion`
  SET `solicitudRecepcioEstado` = %d,
  `comentario` = '%s'
  WHERE `solicitudRecepcioId` = %d;";
$sqlstr = sprintf($sqlstr, $estado,$comentario,$solicitudId);
  if(ejecutarNonQuery($sqlstr)){
  return ejecutarNonQueryConErrores($sqlstr);
  }
}



function obtenerRecepcion(){
    $solicitudes = array();
    $sqlstr = "SELECT if(er.estadoRecepcionId=3,true,null) 'reintentar', sr.solicitudRecepcioId, p.proyectoNombre, p.proyectoIdentidadPropietario,p.proyectoNombrePropietario, er.estadoRecepcionDescripcion,p.proyectoId,sa.solicitudAprobacionId FROM tblsolicitudrecepcion as sr, tblsolicitudaprobacion as sa, tblproyectos as p, tblestadorecepcion as er where p.proyectoId=sa.proyectoId and sa.solicitudAprobacionId=sr.solicitudAprobacionId and sr.solicitudRecepcioEstado=er.estadoRecepcionId;";
    $solicitudes = obtenerRegistros($sqlstr);
    return $solicitudes;
}
 ?>
