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

if (!defined('ABSPATH'))
   exit;
if (!function_exists('add_action'))
   exit;

// Creamos rutas
define("BASIC_DIR", __FILE__); // Ruta completa a nuestro archivo dentro de la carpeta plugin
define("BASIC_PLUGIN_DIR", plugin_dir_path(BASIC_DIR)); // Ruta completa a nuestra carpeta de plugin
define("BASIC_PLUGIN_URL", plugin_dir_url(BASIC_DIR)); // Direccion web a nuestro plugin
define("BASIC_PLUGIN_NAME", "BASIC"); // Nombre de nuestro plugin (Para poder cambiar el nombre en todos los sitios, sin necesidad de ir uno a uno)
define("BASIC_CANTIDAD_ELEMENTOS", 12); // Cuantos elementos usaremos para una paginación

require_once BASIC_PLUGIN_DIR . "includes/principal.php";
$principal = new principal;

// incluimos la clase para shortcode
require_once BASIC_PLUGIN_DIR . "clases/codigoCorto.class.php";



// Al activar el plugin
// register_activation_hook( string $file, callable $callback )
register_activation_hook(BASIC_DIR, array($principal, 'activate_plugin_func'));
// Al desactivar el plugin
// register_activation_hook( string $file, callable $callback )
register_deactivation_hook(BASIC_DIR, array($principal, 'deactivate_plugin_func'));


// Añadimos accion a un hook
add_action('admin_menu', 'admin_menu_func');
// accion, funcion

/**
 * https://developer.wordpress.org/reference/functions/add_menu_page/
 * https://developer.wordpress.org/resource/dashicons/
 * https://developer.wordpress.org/reference/functions/add_submenu_page/
 */

function admin_menu_func()
{
   add_menu_page(
      'Super Encuestas', // Titulo de la pagina
      'Super Encuestas Menu', // Titulo del menu
      'manage_options',  // Capability
      BASIC_PLUGIN_DIR . 'includes/lista_encuestas.php', // Slug
      null, // funcion
      'dashicons-controls-repeat',
      // 20x20
      BASIC_PLUGIN_URL . 'includes/images/star.png',
      '1'
   );

}

function encolarBootstrapJS($hook)
{

   if ($hook != "Wordpress-Custom-Plugin-main/includes/lista_encuestas.php") {
      return;
   }
   // Alias, ruta
   //wp_enqueue_script('bootstrapJs',plugins_url('includes/bootstrap/js/bootstrap.min.js',__FILE__),array('jquery'));   
   wp_enqueue_script("bootstrapJS", BASIC_PLUGIN_URL . 'includes/bootstrap/js/bootstrap.min.js', array('jquery'));
}
add_action('admin_enqueue_scripts', 'encolarBootstrapJS');


function encolarBootstrapCSS($hook)
{

   if ($hook != "Wordpress-Custom-Plugin-main/includes/lista_encuestas.php") {
      return;
   }
   // Alias, ruta
   wp_enqueue_style("bootstrapCSS", BASIC_PLUGIN_URL . 'includes/bootstrap/css/bootstrap.min.css');
}
add_action('admin_enqueue_scripts', 'encolarBootstrapCSS');

// Encolar JS Propio
function encolarJS($hook)
{
   if ($hook != "Wordpress-Custom-Plugin-main/includes/lista_encuestas.php") {
      return;
   }
   // Alias, ruta
   //wp_enqueue_script('bootstrapJs',plugins_url('includes/bootstrap/js/bootstrap.min.js',__FILE__),array('jquery'));   
   wp_enqueue_script("JSExterno", BASIC_PLUGIN_URL . 'includes/js/lista_encuestas.js', array('jquery'));
   wp_localize_script('JSExterno', 'solicitudesAjax', [
      'url' => admin_url('admin-ajax.php'), // Desde aqui WP ejecuta todas las peticiones AJAX
      'seguridad' => wp_create_nonce('seg')
   ]);
}
add_action('admin_enqueue_scripts', 'encolarJS');

// AJAX
function eliminarEncuesta()
{
   $nonce = $_POST['nonce'];
   if (!wp_verify_nonce($nonce, 'seg')) {
      die('no tienes permisos para ese AJAX');
   }
   $id = $_POST['id'];
   global $wpdb;
   $tablaEncuestas = "{$wpdb->prefix}encuestas";
   $tablaEncuesta_detalle = "{$wpdb->prefix}encuesta_detalle";

   $wpdb->delete($tablaEncuestas, array('idEncuesta' => $id));
   $wpdb->delete($tablaEncuesta_detalle, array('idEncuesta' => $id));

}
add_action('wp_ajax_peticioneliminar', 'eliminarEncuesta');


// Creamos los shortcode
function imprimirShortcode($atts)
{


   $_shortcode = new codigoCorto;

   // Obtenemos el id por parametros
   $id = $atts['id'];
   // Acciones del boton
   if (isset($_POST['btnguardar'])) {
      $codigo = uniqid();
      foreach ($_POST as $idPregunta => $respuesta) {
         // $respuestas=$_shortcode->obtenerEncuestaDetalle(($id));
         // var_dump($idPregunta);
         // var_dump($respuesta);
         // var_dump($codigo);
         if (isset($_POST[$idPregunta])) {
            $datos = [
               "idDetalle" => $idPregunta,
               "respuestaDetalle" => $respuesta,
               "codigoRespuesta" => $codigo
            ];
            echo $_shortcode->guardarDetalle($datos);
         }

      }
      return "Encuesta enviada exitosamente";
   }

   //Respuesta 
   $html = $_shortcode->armador($id);
   return $html;

}
add_shortcode('ENC', 'imprimirShortcode');
