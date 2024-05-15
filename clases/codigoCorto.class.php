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
        $listaEncuestas_query = "SELECT * FROM $tabla WHERE idEncuesta='$encuestaId'";

        $datos = $wpdb->get_results($listaEncuestas_query, ARRAY_A);
        if (empty($datos)) {
            $datos = array();
        }
        return $datos[0];
    }

    public function obtenerEncuestaDetalle($encuestaId)
    {
        global $wpdb;

        $tabla = "{$wpdb->prefix}encuesta_detalle";
        $listaDetalleEncuestas_query = "SELECT * FROM $tabla WHERE idEncuesta='$encuestaId'";
        $listaDetalleEncuestas = $wpdb->get_results($listaDetalleEncuestas_query, ARRAY_A);

        if (empty($listaEncuestas)) {
            $datos = array();
        }
        return $listaDetalleEncuestas;
    }


    public function formOpen($titulo)
    {
        $html = " 
            <div class='wrap'>
            <h4> $titulo</h4>
            <br>
            <form method='POST'>
        ";
        return $html;
    }

    public function formClose()
    {
        $html = "
              <br>
                 <input type='submit' id='btnguardar' name='btnguardar' class='page-title-action' value='enviar'>
            </form>
          </div>  
        ";

        return $html;
    }

    function fromInput($detalleid, $pregunta, $tipo)
    {
        $html = "";
        if ($tipo == 'yn') {
            $html = "
                <diV class='from-group'>
                    <p><b>$pregunta</b></p>
                  <div class='col-sm-8'>  
                        <select class='from-control' id='$detalleid' name='$detalleid'>
                                <option value='SI'>SI</option>
                                <option value='No'>NO</option>
                        </select>
                  </div>
            
            ";
        } elseif ($tipo == 'range') {
                $html = "
                <diV class='from-group'>
                    <p><b>$pregunta</b></p>
                    <div class='col-sm-8'>  
                        TIPO 2
                    </div>
            
                ";
        } else {
            $html = "
            <diV class='from-group'>
                <p><b>$pregunta</b></p>
                <div class='col-sm-8'>  
                    TIPO 3
                </div>
        
            ";
        }
        return $html;
    }

    public function armador($encuestaId)
    {
        $encuesta = $this->obtenerEncuesta($encuestaId);
        $nombre = $encuesta['nombreEncuesta'];
        //Obtenemos todas las preguntas
        $preguntas = "";
        $listapreguntas = $this->obtenerEncuestaDetalle($encuestaId);
        foreach ($listapreguntas as $key => $value) {

            $detalleid = $value['idDetalle'];
            $pregunta = $value['preguntaDetalle'];
            $tipo = $value['tipoDetalle'];
            $idEncuesta = $value['idEncuesta'];


            if ($idEncuesta == $encuestaId) {
                // function fromInput($detalleid, $pregunta, $tipo)

                $preguntas .= $this->fromInput($detalleid, $pregunta, $tipo);
            }

            $html = $this->formOpen($nombre);
            $html .= $preguntas;
            $html .= $this->formClose();

        }
        return $html;

    }

    public function guardarDetalle($datos){
        global $wpdb;
        $tablaEncuesta_respuesta  = "{$wpdb->prefix}encuesta_respuesta ";
        return $wpdb->insert($tablaEncuesta_respuesta, $datos);
    }



}


?>