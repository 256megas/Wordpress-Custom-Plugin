<?php
class Principal{

    function activate_plugin_func(){
        global $wpdb;

        $create_encuesta_query ="CREATE TABLE IF NOT EXISTS {$wpdb->prefix}encuestas(
            `idEncuesta` INT NOT NULL AUTO_INCREMENT,
            `nombreEncuesta` VARCHAR(45) NULL,
            `shortcodeEncuesta` VARCHAR(45) NULL,
            PRIMARY KEY (`idEncuesta`)
            );";
        $wpdb->query($create_encuesta_query);

        $create_encuesta_detalle_query ="CREATE TABLE IF NOT EXISTS {$wpdb->prefix}encuesta_detalle(
            `idDetalle` INT NOT NULL AUTO_INCREMENT,
            `idEncuesta` INT NULL,
            `preguntaDetalle` VARCHAR(155) NULL,
            `tipoDetalle` VARCHAR(45) NULL,
            PRIMARY KEY (`idDetalle`),
            FOREIGN KEY (`idEncuesta`) REFERENCES {$wpdb->prefix}encuestas(`idEncuesta`)
        );";
        $wpdb->query($create_encuesta_detalle_query);

        $create_encuesta_respuesta_query ="CREATE TABLE IF NOT EXISTS {$wpdb->prefix}encuesta_respuesta(
            `idRespuesta` INT NOT NULL AUTO_INCREMENT,
            `idDetalle` INT NULL,
            `respuestaDetalle` VARCHAR(45) NULL,
            PRIMARY KEY (`idRespuesta`),
            FOREIGN KEY (`idDetalle`) REFERENCES {$wpdb->prefix}encuesta_detalle(`idDetalle`)
            );";
        $wpdb->query($create_encuesta_respuesta_query);


    }


    function deactivate_plugin_func(){
        echo "Acabas de desactivar el plugin";
    }



    // Otras funciones

    function crear_usuario_func(){
        // //echo "Acabas de activar el plugin";
        // if(!username_exists("batman")){
        //     //Crea un suscriptor
        //     //wp_create_user("batman", "password", "128megas@gmail.com")
            
        //     //Crea un usuario más complejo
        //     //wp_insert_user( array|object|WP_User $userdata ): int|WP_Error
        //     $password = wp_generate_password(12,false, false);

        //     $user = [
        //         "user_pass" => $password,
        //         "user_login" => "batman",
        //         "user_email" => "usuario_editor@gmail.com",
        //         "nickname" => "batman",
        //         "role" => "editor",
        //     ];
        //     wp_insert_user($user);
        // }
    }

}