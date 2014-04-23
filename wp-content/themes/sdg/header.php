<?php
    //para banderas switcher
    $flag_data = pll_the_languages(array('raw'=>1));
    $flag_data[0]['flag'] =  get_template_directory_uri() . '/img/bandera-esp.png';
    $flag_data[1]['flag'] =  get_template_directory_uri() . '/img/bandera-deu.png';
    function flag_active ($data) {
        $class_active = "active";
        if ($data == 1) {
            return $class_active;
        } else {
            return;
        }
    }
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php get_locale(); ?>> <!--<![endif]-->
    <head>
        <?php wp_head();?>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="<?php bloginfo("template_directory");?>/css/normalize.min.css">
        <link rel="stylesheet" href="<?php bloginfo("template_directory");?>/style.css">

        <script src="<?php bloginfo("template_directory");?>/js/vendor/modernizr-2.6.2.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

<div id="header-wrapper">
    <header id="header-content">
            <div id="logo-header">
                <a href="index.php"><img src="<?php bloginfo('template_directory');?>/img/logo.png" alt="logo.png" /></a>
            </div>
            <div id="menu-header">
                <nav id="main-menu">
                    <ul>
                        <li class="login js-login-toggle row-down" data-open="false">
                            <?php
                            if (is_user_logged_in()) { ?>
                            <li class="logout" data-open="false"><a href="<?php echo wp_logout_url(home_url()); ?>"><img class="logout-logo" src="<?php bloginfo('template_directory');?>/img/logout.png"/></a></li>    
                            <?php } else {
                                ?>
                            <li class="login row-down" data-open="false">
                                <span class="js-login-toggle"><?php _e('Login', 'sdg'); ?></span>
                                <div id="log-form" class="hidden js-log-form"><?php wp_login_form($login_args);?></div>
                            </li>
                            <?php }
                            ?>
                        </li>
                        <li class="active"><a href="index.php"><?php _e('¿Qué es sdg?', 'sdg'); ?></a></li>
                        <li><a href="?page_id=<?php echo set_links_lang(pll_current_language(), 'mitglieder'); ?>"><?php _e('Miembros', 'sdg'); ?></a></li>
                        <li><a href="?page_id=<?php echo set_links_lang(pll_current_language(), 'veranstaltungen'); ?>"><?php _e('Eventos', 'sdg'); ?></a></li>
                        <?php
                        if (is_user_logged_in()) {
                        ?>
                            <li><a href="?page_id=<?php echo set_links_lang(pll_current_language(), 'downloads'); ?>"><?php _e('Downloads', 'sdg'); ?></a></li>
                        <?php
                        }
                        ?>
                    </ul>
                </nav>
                <nav id="flags-menu">
                    <ul>
                        <li class="<?php echo flag_active($flag_data[0]['current_lang']); ?>"><a href="<?php echo $flag_data[0]['url'] . '&' . pass_user(); ?>"><img src="<?php echo $flag_data[0]['flag']; ?>" /></a></li>
                        <li class="<?php echo flag_active($flag_data[1]['current_lang']); ?>"><a href="<?php echo $flag_data[1]['url'] . '&' . pass_user(); ?>"><img src="<?php echo $flag_data[1]['flag']; ?>" /></a></li>
                    </ul>
                </nav>
            </div>
            
    </header> <!-- header static position -->
    <div id="line"></div>
</div> <!-- end of header-wrapper -->


<div id="float-header-wrapper">
    <header id="header-fixed-bar">
            <div id="logo-header">
                <a href="index.php"><img src="<?php bloginfo('template_directory');?>/img/logo.png" alt="logo.png" /></a>
            </div>
            <div id="menu-header">
                <nav id="main-menu">
                    <ul>
                        <?php
                        if (is_user_logged_in()) { ?>
                        <li class="logout" data-open="false"><a href="<?php echo wp_logout_url(home_url()); ?>"><img class="logout-logo" src="<?php bloginfo('template_directory');?>/img/logout.png"/></a></li>    
                        <?php } else {
                            ?>
                        <li class="login js-login-toggle row-down" data-open="false">
                            <?php _e('Login', 'sdg'); ?>
                            <div id="log-form" class="hidden js-log-form"><?php wp_login_form($login_args);?></div>
                        </li>
                        <?php }
                        ?>
                        <li class="active"><a href="index.php"><?php _e('¿Qué es sdg?', 'sdg'); ?></a></li>
                        <li><a href="?page_id=<?php echo set_links_lang(pll_current_language(), 'mitglieder'); ?>"><?php _e('Miembros', 'sdg'); ?></a></li>
                        <li><a href="?page_id=<?php echo set_links_lang(pll_current_language(), 'veranstaltungen'); ?>"><?php _e('Eventos', 'sdg'); ?></a></li>
                        <?php
                        if (is_user_logged_in()) {
                        ?>
                            <li><a href="?page_id=<?php echo set_links_lang(pll_current_language(), 'downloads'); ?>"><?php _e('Downloads', 'sdg'); ?></a></li>
                        <?php
                        }
                        ?>
                    </ul>
                </nav>
                <nav id="flags-menu">
                    <ul>
                        <li class="<?php echo flag_active($flag_data[0]['current_lang']); ?>"><a href="<?php echo $flag_data[0]['url'] . '&' . pass_user(); ?>"><img src="<?php echo $flag_data[0]['flag']; ?>" /></a></li>
                        <li class="<?php echo flag_active($flag_data[1]['current_lang']); ?>"><a href="<?php echo $flag_data[1]['url'] . '&' . pass_user(); ?>"><img src="<?php echo $flag_data[1]['flag']; ?>" /></a></li>
                    </ul>
                </nav>
    </header> <!-- header while scrolling -->
    <div id="line"></div>
</div> <!-- end of float header-wrapper -->
<div class="wp_login_error">
    <?php if( isset( $_GET['login'] ) && $_GET['login'] == 'failed' ) { ?>
        <p>The password you entered is incorrect, Please try again.</p>
    <?php } 
    else if( isset( $_GET['login'] ) && $_GET['login'] == 'empty' ) { ?>
        <p>Please enter both username and password.</p>
    <?php } ?>
</div>

