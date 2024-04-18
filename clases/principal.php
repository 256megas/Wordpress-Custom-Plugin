<?php
class Principal{

    static function activate_plugin_func(){
        echo "Acabas de activar el plugin";
    }

    static function deactivate_plugin_func(){
        echo "Acabas de desactivar el plugin";
    }

    static function uninstall_plugin_func(){
        echo "Acabas de desinstalar el plugin";
        if(!defined(WP_UNINSTALL_PLUGIN)) die();
    }
}