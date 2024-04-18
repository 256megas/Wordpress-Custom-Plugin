<?php
/*
 * Plugin Name:       My Basics Plugin
 * Plugin URI:        https://mifactoriadewebs.com/
 * Description:       Handle the basics with this plugin.
 * Version:           1.0.0
 * Requires at least: 6.5 
 * Requires PHP:      8.0 
 * Author:            Antonio López 
 * Author URI:        https://mifactoriadewebs.com/ 
 * License:           GPL v2 or later 
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html 
 * Update URI:        https://mifactoriadewebs.com/
 * Text Domain:       my-basics-plugin
 */

// https://developer.wordpress.org/plugins/intro/


// It prevent public user to directly access your .php files through URL.
if(!defined('ABSPATH')) exit;

// Creamos rutas
define("BASIC_DIR", __FILE__); // Ruta completa a nuestro archivo dentro de la carpeta plugin
define("BASIC_PLUGIN_DIR", plugin_dir_path(BASIC_DIR)); // Ruta completa a nuestra carpeta de plugin
define("BASIC_PLUGIN_URL", plugin_dir_url(BASIC_DIR)); // Direccion web a nuestro plugin
define("BASIC_PLUGIN_NAME", "BASIC"); // Nombre de nuestro plugin (Para poder cambiar el nombre en todos los sitios, sin necesidad de ir uno a uno)
define("BASIC_CANTIDAD_ELEMENTOS", 12); // Cuantos elementos usaremos para una paginación


require_once BASIC_PLUGIN_DIR."clases/principal.php";
// Al activar el plugin
// register_activation_hook( string $file, callable $callback )
register_activation_hook( BASIC_DIR, array('Principal','activate_plugin_func') );


// Al desactivar el plugin
// register_activation_hook( string $file, callable $callback )
register_deactivation_hook( BASIC_DIR, array('Principal','deactivate_plugin_func')  );



// Al desinstalar el plugin
// register_uninstall_hook( string $file, callable $callback )
register_uninstall_hook(  BASIC_DIR, array('Principal','uninstall_plugin_func')  );



 add_action('admin_menu','first_menu_plugin');
/**
 * add_menu_page( 
 * string $page_title, 
 * string $menu_title, 
 * string $capability, 
 * string $menu_slug, 
 * callable $callback = ”, 
 * string $icon_url = ”, int|float $position = null ): string
 * 
 * https://developer.wordpress.org/reference/functions/add_menu_page/
 * https://developer.wordpress.org/resource/dashicons/
 */
 
 /**
  * 
  * add_submenu_page( 
  * string $parent_slug, 
  * string $page_title, 
  * string $menu_title, 
  * string $capability, 
  * string $menu_slug, 
  * callable $callback = ”,
  *   int|float $position = null ): string|false 
  * 
  * 
  * 
  * 
  * https://developer.wordpress.org/reference/functions/add_submenu_page/
  */

 function first_menu_plugin(){
    add_menu_page(  'Custom Plugin',
                    'Custom Plugin Title', 
                    'manage_options', 
                    'custom-plugin', 
                    'custom_plugin_func',
                    'dashicons-controls-repeat',
                    '3'
                );

    add_submenu_page(   'custom-plugin', 
                        'SubMenu',
                        'SubMenu Title',
                        'manage_options',
                        'submenu-slug',
                        'submenu_func',
                        '1'
                );

    add_submenu_page(   'custom-plugin', 
                        'SubMenu 2',
                        'SubMenu Title 2',
                        'manage_options',
                        'submenu2-slug',
                        'submenu_func2',
                        '2'
                    );


    add_submenu_page(   'options-general.php', 
                        'SubMenu en Ajustes',
                        'SubMenu en Ajustes 2',
                        'manage_options',
                        'submenuAjustes-slug',
                        'submenuAjustes_func',
                        '1'
                );
 }

 function custom_plugin_func(){
    echo "Hello World: New plugin";
 }

 function submenu_func(){
    echo "Hello World: New plugin -> Submenu";
 }

 function submenu_func2(){
    echo "Hello World: New plugin -> Submenu 2";
 }

 function submenuAjustes_func(){
    echo "Hello World: New plugin -> Submenu Ajustes";
 }