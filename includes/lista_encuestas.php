<?php 
    global $wpdb;
    $listaEncuestasQuery = "SELECT idEncuesta, nombreEncuesta, shortcodeEncuesta FROM {$wpdb->prefix}encuestas;";
    $listaEncuestas=$wpdb->get_results($listaEncuestasQuery,ARRAY_A);
    if (count($listaEncuestas)==0){
        $vacio=true;
    }
?>
<div class="wrap">
    <?php
        echo "<h1>".get_admin_page_title()."</h1>";
    ?>
    <a class="page-title-action" id="btnNuevaEncuesta">Añadir nueva</a>
    <br><br><br>
    <table class="wp-list-table widefat fixed striped pages">
        <thead>
            <th>Nombre de la encuesta</th>
            <th>ShortCode</th>
            <th>Acciones</th>
        </thead>
        <tbody id="the-list">
            <?php
                foreach($listaEncuestas as $encuesta){
                   echo "
                        <tr>
                            <td>{$encuesta['nombreEncuesta']}</td>
                            <td>{$encuesta['shortcodeEncuesta']}</td>
                            <td>
                                <a class='page-title-action'>Ver estadisticas</a>
                                <a class='page-title-action'>Borrar</a>
                            </td>
                        </tr>
                    ";
                };
            ?>
        </tbody>    
    </table>

</div>

<!-- Modal  -->
<div class="modal fade" id="modalNuevaEncuesta" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Nueva encuesta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form method="post">

          <div class="modal-body">

          <div class="form-group">
            <label for="txtNombre" class="col-sm-4 col-form-label">Nombre de la encuesta</label>
            <div class="col-sm-8">
                <input type="text" id="txtNombre" name="txtNombre" style="width:100%">
            </div>
          </div>

          <h4> Preguntas</h4>
          <br>
          <table id="camposdinamicos">
            <tr>  
                <td>
                    <label for="txtNombre" class="col-form-label" style="margin-right:5px">Pregunta 1</label>
                </td>
                <td>
                    <input type="text" name="name[]" id="name" class="form-control name_list">
                </td>
                <td>
                  <!-- <button name="add" id="addPregunta" class="btn btn-danger" style="margin-left:15px">Agregar mas</button> -->
                  <button name="add" id="addPregunta" >Agregar mas</button>                
                </td>
            </tr>
          </table>

          
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary">Guardar</button>
          </div>
        </form>        
    </div>
  </div>
</div>
