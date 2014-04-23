<?php
/**
 * Template Name: Single_user
 *
 */
?>
<?php get_header(); ?>
<?php 
    if(isset($_GET['user_id'])){
        $user_id = $_GET['user_id'];
    }
    $user_meta = get_user_meta($user_id);
?>
<!--
<pre>
    <?php print_r($user_meta);?>
</pre>-->
<div id="wrapper">

     <div id="main-slider">
        <img src="<?php bloginfo('template_directory');?>/img/jpeg.jpg" />
    </div>

    <div id="main-block" class="user-single">

        <h1 class="page-title"><?php echo _e('Perfil:', 'sdg'); ?> <?php echo $user_meta['wpcf-nombre'][0] . ' ' . $user_meta['wpcf-apellidos'][0]; ?></h1>
        <div id="users-single-grid">

            <div id="user-single">
                <div id="user-img">
                    <img src="<?php echo $user_meta['wpcf-img-usuario'][0]; ?>">
                </div>
                <div id="user-info">
                    <span class="info-age"><?php _e('Edad: ', 'sdg')?><?php echo $user_meta['wpcf-edad'][0]; ?></span>
                    <span class="info-place"><?php _e('Lugar de Procedencia: ', 'sdg')?><?php echo $user_meta['wpcf-lugar-de-procedencia'][0]; ?></span>
                    <h3><?php _e('Datos biográficos', 'sdg')?></h3>
                    <div class="info-tiny-description"><?php echo texturize_meta('wpcf-datos-biograficos'); ?></div>
                    <h3><?php _e('Datos profesionales', 'sdg')?></h3>
                    <div class="info-tiny-curriculum"><?php echo texturize_meta('wpcf-curriculum-vitae'); ?></div>
                    <div class="info-mandar-mensaje">Mandarme un mensaje</div> 
                    <div id="form-message">
                        <form name="contact_form" method="post" action="<?php echo get_permalink(); ?>">
                            <textarea id="mensaje-area"  value="" name="formmail"></textarea>
                            <input type="submit" name="submit" id="submit" value="Enviar" disabled="disabled" />
                        </form>
                    <div class="error_msg"><?php _e('Campo sin información', 'sdg');?>
                    </div>
                </div> <!-- end of user-info -->
            </div> <!-- end of user -->
        </div> <!-- end of users-grid -->
    </div> <!-- end of main-block -->
</div> <!-- end of wrapper --> 
       

<?php include_once("footer.php"); ?>
