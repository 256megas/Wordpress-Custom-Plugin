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
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>
