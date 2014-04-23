<?php
/**
 * Template Name: Home
 *
 */

get_header(); 
$meta = get_post_meta(get_the_id());
?>
<div id="wrapper">

    <div id="main-slider">
        <img src="<?php bloginfo('template_directory');?>/img/jpeg.jpg" />
    </div>

    <div id="main-block" class="index">
        <h1 class="page-title"><?php echo get_the_title(); ?></h1>
            <div id="home-content">
                <div id="right-block"><?php echo texturize_meta('wpcf-right-text'); ?></div>
                <div id="lateral-block"><?php echo texturize_meta('wpcf-sidebar-text'); ?></div>
            </div>
    </div>

</div> <!-- end of wrapper -->
       

<?php include_once("footer.php"); ?>
