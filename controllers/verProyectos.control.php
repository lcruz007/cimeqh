<?php
/* Home Controller
 * 2014-10-14
 * Created By OJBA
 * Last Modification 2014-10-14 20:04
 */
  require_once("libs/template_engine.php");
  require_once("models/proyectos.model.php");

  function run(){
    $proyectos = array( );
    $accion = array();
    $htmlData = array();

    $proyectos=obtenerTodosLosProyectos();

    if (isset($_GET["accion"])){
      switch ($_GET["accion"]) {
        case 'Factibilidad':
        $accion["direccionARedireccionar"]="factibilidadProyectos";
          break;

        default:

          break;
      }
    }

    print_r($accion);
    renderizar("verProyectos",array('proyectos' => $proyectos, 'direccion'=>$accion));
  }


  run();
?>