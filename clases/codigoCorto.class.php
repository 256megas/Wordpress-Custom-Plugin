<?php
// Aqui controlamos los shortcode

class codigoCorto
{
    public function __construct()
    {
    }

    public function obtenerEncuesta($encuestaId)
    {
        global $wpdb;

        $tabla = "{$wpdb->prefix}encuestas";
        $listaEncuestas_query = "SELECT * FROM $tabla WHERE idEncuesta=`$encuestaId`";
        $listaEncuestas = $wpdb->get_results($listaEncuestas_query, ARRAY_A);

        if (empty($listaEncuestas)) {
            $datos = array();
        }
        return $datos[0];
    }

    public function obtenerEncuestaDetalle($encuestaId){

    }

}


?>