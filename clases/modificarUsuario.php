<?php
require_once("libs/dao.php");
require_once('models/usuarios.model.php');

class vista
{

  public static function vista($tipo,$codigo,$proyectoNombre,$depto,$direccion){

  $vista="<div class='right_col' role='main'>
        <div class=''>
          <div class='page-title'>
            <div class='title_left'>
              <h3>Modificar Usuario</h3>
            </div>
            <div class='title_right'>
              <div class='col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search'>
                <div class='input-group'>
                  <input type='text' class='form-control' placeholder='Search for...'>
                  <span class='input-group-btn'>
                    <button class='btn btn-default' type='button'>Go!</button>
                  </span>
                </div>
              </div>
            </div>
          </div>
          <div class='clearfix'></div>
          <div class='row'>
              <div class='col-md-12 col-sm-12 col-xs-12'>
                <div class='x_panel'>
                  <div class='x_title'>
                      <h2>Datos del Usuario</h2>
                      <ul class='nav navbar-right panel_toolbox'>
                        <li><a class='collapse-link'><i class='fa fa-chevron-up'></i></a>
                        </li>
                        <li class='dropdown'>
                          <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-expanded='false'><i class='fa fa-wrench'></i></a>
                          <ul class='dropdown-menu' role='menu'>
                            <li><a href='#'>Settings 1</a>
                            </li>
                            <li><a href='#'>Settings 2</a>
                            </li>
                          </ul>
                        </li>
                        <li><a class='close-link'><i class='fa fa-close'></i></a>
                        </li>
                      </ul>
                      <div class='clearfix'></div>
                    </div>
                    <div class='x_content'>
                      <br>

                        <form method='post' action='index.php?page=revisarSolicitudAprobacionCimeqh' id='demo-form2' data-parsley-validate class='form-horizontal form-label-left'>
                          <div class='form-group'>

                             <div class='row'>
                                                  <div class='col-md-6'>
                                                      <div class='form-group'>
                                                          <label for='txtProyectoNombre'>Numero de Identidad *</label>
                                                          <input type='text' id='txtUs'class='form-control' name='txtUs' value='{{usuarioIdentidad}}' disabled='disabled'>
                                                          <input type='hidden' id='codigoProyecto'class='form-control' name='codigoProyecto' value='".$codigo."'>
                                                          <input type='hidden' id='tipo'class='form-control' name='tipo' value='".$tipo."'>
                                                      </div>
                                                  </div>
                                                  <div class='col-md-6'>
                                                      <div class='form-group'>
                                                          <label for='form_lastname'>Numero de Colegiacion *</label>
                                                          <input type='text' id='departamento'class='form-control' name='departamento' value='".$depto."' disabled='disabled'>
                                                      </div>
                                                  </div>
                                                  <div class='col-md-6'>
                                                      <div class='form-group'>
                                                          <label for='form_name'>Nombre del Ingeniero *</label>
                                                          <input id='direccion' type='text' name='direccion' class='form-control'  value='".$direccion."' disabled='disabled'>
                                                      </div>
                                                  </div>
                                                  <div class='col-md-6'>
                                                      <div class='form-group'>
                                                          <label for='form_name'>Numero de Celular *</label>
                                                          <input id='descripcionProyecto' type='text' name='descripcionProyecto' class='form-control'  value='".$descripcion."' disabled='disabled'>
                                                      </div>
                                                  </div>
                                                  <div class='col-md-6'>
                                                      <div class='form-group'>
                                                          <label for='form_name'>Numero de Telefono Fijo *</label>
                                                          <input id='nombrePripietario' type='text' name='nombrePropietario' class='form-control'  value='".$nombrePropietario."' disabled='disabled'>
                                                      </div>
                                                  </div>

                                                  <div class='col-md-12'>
                                                   <div class='form-group'>
                                                       <label for='form_message'>Direccion *</label>
                                                       <textarea id='comentario'  name='comentario' class='form-control' rows='4' value='".$nombrePropietario."' disabled='disabled'></textarea>
                                                   </div>
                                               </div>
                          <div class='col-md-12'>
                          <div class='form-group'>
                          <!--Boton Submit-->
                          <button type='submit' id='btnComentarAprobacion' name='btnComentarAprobacion' class='btn btn-default'>
                            Actualizar
                          </button>
                          <!--Fin Boton Submit-->
                          </div>
                      </div>
                </form>
              </div>
            </div>
          </div>
        </div>
    </div>
    </div>
";

      return $vista;
  }
      }
?>
