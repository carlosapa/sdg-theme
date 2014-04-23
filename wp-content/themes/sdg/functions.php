<?php

//setup menu
function register_menu (){
	register_nav_menu('header_menu', __('Header Menu'));
}
add_action('init', 'register_menu');


//reordenar la botonera del menu de admon.
function custom_menu_order($menu_ord) {
    if (!$menu_ord) return true;
     
    return array(
        //'index.php', // Dashboard
        'edit.php?post_type=page', // Pages
        'edit.php?post_type=eventos', // Pages
        'separator1', // First separator
        //'edit.php', // Posts
        'upload.php', // Media
        'link-manager.php', // Links
        //'edit-comments.php', // Comments
        'separator2', // Second separator
        'themes.php', // Appearance
        'plugins.php', // Plugins
        'users.php', // Users
        'tools.php', // Tools
        'options-general.php', // Settings
        'admin.php?page=wpcf-cf', //types-plugin
        'separator-last' // Last separator
    );
}
add_filter('custom_menu_order', 'custom_menu_order'); // Activate custom_menu_order
add_filter('menu_order', 'custom_menu_order');

function my_remove_menu_pages () {
	remove_menu_page('edit.php');
	remove_menu_page('edit-comments.php');  
	remove_menu_page('index.php');  
}
add_action( 'admin_menu', 'my_remove_menu_pages' );


//setup translations...
load_theme_textdomain('sdg', get_template_directory() . '/languages' );


//set CSS-file in the bottom of the head to modify stuff in admin area...
function custom_css() {
    $current_user = wp_get_current_user();
    $role_array = $current_user->roles;
    $role = $role_array[0];

    if ($role == 'subscriber') {
        $ubic  = get_template_directory_uri();
        $ubic .= '/css/custom-admin.css';
        echo '<link href="' . $ubic . '" rel="stylesheet"/>';
    }
}
add_action('admin_head', 'custom_css');


//text limiter... instead of using excerpt
function limit_text ($string_in, $max_num) {
    //$max_num = 3;
    $words = array();
    $words = explode(" ", $string_in, $max_num);
    $string_out = "";

    $words[$max_num - 1] = "...";
    
    $string_out = implode(" ", $words);
    return $string_out;
}

//show flags regarding the event language
function set_flags($lang_code) {   
    if(!isset($lang_code)) {
        return;
    } else {
        switch ($lang_code) {
            case '0':
                echo '<img src="' . get_template_directory_uri() . '/img/bandera-esp.png" />' ;
                break;
            case '1':
                echo '<img src="' . get_template_directory_uri() . '/img/bandera-deu.png" />' ;
                break;    
            case '2':
                echo '<img src="' . get_template_directory_uri() . '/img/bandera-esp.png" />' ;
                echo '<img src="' . get_template_directory_uri() . '/img/bandera-deu.png" />' ;
                break;                                              
            default:
                //nada
                break;
        }
    }

}


//modify links regarding curr_lang
$curr_lang = pll_current_language();
function set_links_lang ($lang, $page) {
    $menu_links = array(
        'mitglieder'        => array(9,19),
        'veranstaltungen'   => array(5,28),
        'single'			=> array(13,55)
        );
    if($lang == 'de') {
        if ($page == 'mitglieder') {
            return $menu_links['mitglieder'][1];
        } else if ($page == 'veranstaltungen'){
            return $menu_links['veranstaltungen'][1];
        } else {
        	return $menu_links['single'][1];
        }
    } else {
        if ($page == 'mitglieder') {
            return $menu_links['mitglieder'][0];
        } else if ($page == 'veranstaltungen'){
            return $menu_links['veranstaltungen'][0];
        } else {
        	return $menu_links['single'][0];
        }                                 
    }
}

//functions to generate a login form in the front end
function pass_user() {
	if(isset($_GET['user_id'])) {
		$user_id = $_GET['user_id'];
		$output = 'user_id=' . $user_id;
		return $output;
	} else {
		return;
	}
}

//setup front end login. Set up classes and text of the form
$login_args = array(
    'echo'           => true,
    'redirect'       => get_permalink(),
    'form_id'        => 'loginform',
    'label_username' => __('Username'),
    'label_password' => __('Password'),
    'label_remember' => __('Remember Me'),
    'label_log_in'   => __('Log In'),
    'id_username'    => 'user_login',
    'id_password'    => 'user_pass',
    'id_remember'    => 'rememberme',
    'id_submit'      => 'wp-submit',
    'remember'       => true,
    'value_username' => NULL,
    'value_remember' => false
    );

function front_end_login_fail( $username ) {
	$referrer = $_SERVER['HTTP_REFERER'];    
	if(!empty( $referrer) && !strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin')) {
	    wp_redirect( get_permalink( LOGIN_PAGE ) . "?login=failed"); 
	    exit;
	}
}
add_action( 'wp_login_failed', 'front_end_login_fail' );
 
function check_username_password( $login, $username, $password ) {
	$referrer = $_SERVER['HTTP_REFERER'];
	if( !empty( $referrer ) && !strstr( $referrer,'wp-login' ) && !strstr( $referrer,'wp-admin' ) ) { 
	    if( $username == "" || $password == "" ){
	        wp_redirect( get_permalink( LOGIN_PAGE ) . "?login=empty" );
	        exit;
	    }
	}
}
add_action( 'authenticate', 'check_username_password', 1, 3);


//function to get content generated with WYSWYG and get the <p> tags of it.
function texturize_meta ($string_in) {
    $id    = is_page_template('user-single.php') ? $_GET['user_id'] : get_the_id();
    $text  = is_page_template('user-single.php') ? get_user_meta($id , $string_in, true) : get_post_meta($id, $string_in, true);
    $text  = wpautop($text);
    $text  = convert_chars($text);
    return wptexturize($text);
}

//users menu modify
function update_contact_methods( $contactmethods ) {
    
    $user_contactmethods = array(
        'building'  => __('Building'),
        'room'      => __('Room'),
        'phone'     => __('Phone')
    );
    
    return $contactmethods;
}
add_filter( 'user_contactmethods', 'update_contact_methods');
remove_action("admin_color_scheme_picker", "admin_color_scheme_picker");
?>
