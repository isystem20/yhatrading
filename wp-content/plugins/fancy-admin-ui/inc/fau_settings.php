<?php

add_action( 'admin_enqueue_scripts', 'mw_enqueue_color_picker' );
function mw_enqueue_color_picker( $hook_suffix ) {
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'my-script-handle', plugins_url('fau-colorpicker.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
}

// Customize Fancy Admin UI Colors
$fau_color_settings = new fau_color_settings();
class fau_color_settings {
    function __construct() {
        add_filter( 'admin_init' , array( &$this , 'register_fields' ) );
    }
    function register_fields() {
        register_setting( 'general', 'fau_primary_color', 'esc_attr' );
        add_settings_field('fau_primary_color', '<label for="fau_primary_color">'.__('Admin UI Primary Color:' , 'fau_primary_color' ).'</label>' , array(&$this, 'fields_html') , 'general' );
    }
    function fields_html() {
        $value = get_option( 'fau_primary_color', '' );
        echo '<input type="text" id="fau_primary_color" name="fau_primary_color" value="' . $value . '" data-default-color="#3498db" />';
        echo "
          <script>
            jQuery(document).ready(function($){
              $('#fau_primary_color').wpColorPicker();
            });
          </script>
          ";
    }
}

$fau_secondary_color_settings = new fau_secondary_color_settings();
class fau_secondary_color_settings {
    function __construct() {
        add_filter( 'admin_init' , array( &$this , 'register_fields' ) );
    }
    function register_fields() {
        register_setting( 'general', 'fau_secondary_color', 'esc_attr' );
        add_settings_field('fau_secondary_color', '<label for="fau_secondary_color">'.__('Admin UI Secondary Color:' , 'fau_secondary_color' ).'</label>' , array(&$this, 'fields_html') , 'general' );
    }
    function fields_html() {
        $value = get_option( 'fau_secondary_color', '' );
        echo '<input type="text" id="fau_secondary_color" name="fau_secondary_color" value="' . $value . '" data-default-color="#2581bf" />';
        echo "
          <script>
            jQuery(document).ready(function($){
              $('#fau_secondary_color').wpColorPicker();
            });
          </script>
          ";
    }
}



add_action('after_setup_theme','remove_core_updates');
function remove_core_updates()
{
 if(! current_user_can('update_core')){return;}
 global $wp_version;return(object) array('last_checked'=> time(),'version_checked'=> $wp_version,);

 add_action('init', create_function('$a',"remove_action( 'init', 'wp_version_check' );"),2);
 add_filter('pre_option_update_core','__return_null');
 add_filter('pre_site_transient_update_core','__return_null');

}
remove_action('load-update-core.php','wp_update_plugins');
add_filter('pre_site_transient_update_plugins','__return_null');

add_filter('pre_site_transient_update_core','remove_core_updates');
add_filter('pre_site_transient_update_plugins','remove_core_updates');
add_filter('pre_site_transient_update_themes','remove_core_updates');