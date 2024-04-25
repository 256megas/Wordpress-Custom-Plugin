<?php 
    global $wpdb;
    $listaEncuestasQuery = "SELECT idEncuesta, nombreEncuesta, shortcodeEncuesta FROM {$wpdb->prefix}encuestas;";
    $listaEncuestas=$wpdb->get_results($listaEncuestasQuery,ARRAY_A)
    if ($listaEncuestas.length==0){
        $vacio=true;
    }
?>
<div class="wrap">
    <?php
        echo "<h1>".get_admin_page_title()."</h1>";
    ?>
    <a class="page-title-action">Añadir nueva</a>
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

