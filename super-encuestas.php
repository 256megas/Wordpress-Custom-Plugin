<?php
/*
 * Plugin Name:       Mi Super Encuestas
 * Plugin URI:        https://mifactoriadewebs.com/
 * Description:       Learning Wordpress Plugin Development
 * Version:           1.0.0
 * Requires at least: 6.5 
 * Requires PHP:      8.0 
 * Author:            Antonio López 
 * Author URI:        https://mifactoriadewebs.com/ 
 * License:           GPL v2 or later 
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html 
 * Update URI:        https://mifactoriadewebs.com/
 * Text Domain:       Mi-Super-Encuestas
 */

// https://developer.wordpress.org/plugins/intro/

// It prevent public user to directly access your .php files through URL.
// Two methods

   if (!defined('ABSPATH')) exit;
   if  (!function_exists('add_action')) exit;

// Creamos rutas
define("BASIC_DIR", __FILE__); // Ruta completa a nuestro archivo dentro de la carpeta plugin
define("BASIC_PLUGIN_DIR", plugin_dir_path(BASIC_DIR)); // Ruta completa a nuestra carpeta de plugin
define("BASIC_PLUGIN_URL", plugin_dir_url(BASIC_DIR)); // Direccion web a nuestro plugin
define("BASIC_PLUGIN_NAME", "BASIC"); // Nombre de nuestro plugin (Para poder cambiar el nombre en todos los sitios, sin necesidad de ir uno a uno)
define("BASIC_CANTIDAD_ELEMENTOS", 12); // Cuantos elementos usaremos para una paginación

require_once BASIC_PLUGIN_DIR."includes/principal.php";
$principal = new principal;
//require_once BASIC_PLUGIN_DIR."includes/lista_encuestas.php";



// Al activar el plugin
// register_activation_hook( string $file, callable $callback )
register_activation_hook( BASIC_DIR, array($principal,'activate_plugin_func') );
// Al desactivar el plugin
// register_activation_hook( string $file, callable $callback )
register_deactivation_hook( BASIC_DIR, array($principal,'deactivate_plugin_func')  );


// Añadimos accion a un hook
 add_action('admin_menu','admin_menu_func');
// accion, funcion

/**
 * https://developer.wordpress.org/reference/functions/add_menu_page/
 * https://developer.wordpress.org/resource/dashicons/
 * https://developer.wordpress.org/reference/functions/add_submenu_page/
 */

 function admin_menu_func(){
   add_menu_page(  'Super Encuestas', // Titulo de la pagina
                    'Super Encuestas Menu', // Titulo del menu
                    'manage_options',  // Capability
                    BASIC_PLUGIN_DIR.'includes/lista_encuestas.php', // Slug
                    null, // funcion
                    //'dashicons-controls-repeat',
                    // 20x20
                    BASIC_PLUGIN_URL.'images/star.png',
                    '1'
                );
   
 }



