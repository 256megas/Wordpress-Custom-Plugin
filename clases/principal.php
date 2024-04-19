<?php
class Principal{

    function activate_plugin_func(){
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

    function deactivate_plugin_func(){
        echo "Acabas de desactivar el plugin";
    }

    function uninstall_plugin_func(){
        echo "Acabas de desinstalar el plugin";
        if(!defined(WP_UNINSTALL_PLUGIN)) die();
    }
}