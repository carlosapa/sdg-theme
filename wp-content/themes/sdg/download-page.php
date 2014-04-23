<?php
/**
 * Template Name: Download page
 *
 */
?>
<?php
if (is_user_logged_in()) { ?>

    <?php get_header(); ?>

    <div id="wrapper">
         <div id="main-slider">
            <img src="<?php bloginfo('template_directory');?>/img/jpeg.jpg" />
        </div>
        <div id="main-block" class="user-single">
            <h1 class="page-title"><?php echo _e('Downloads:', 'sdg'); ?></h1>
            <div id="users-single-grid">

                
            </div> <!-- end of users-grid -->
        </div> <!-- end of main-block -->
    </div> <!-- end of wrapper --> 
           
    <?php include_once("footer.php"); ?>

<?php
} else {
?>

    <?php get_header(); ?>

    <div id="wrapper">
         <div id="main-slider">
            <img src="<?php bloginfo('template_directory');?>/img/jpeg.jpg" />
        </div>
        <div id="main-block" class="user-single">
            <h1 class="page-title"><?php echo _e('No estás registrado:', 'sdg'); ?></h1>

        </div> <!-- end of main-block -->
    </div> <!-- end of wrapper --> 
           
    <?php include_once("footer.php"); ?>



<?php
}
?>

