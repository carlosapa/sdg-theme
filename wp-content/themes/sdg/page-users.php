<?php
/**
 * Template Name: Users-loop
 *
 */

get_header(); ?>

<?php 
// function para limitar la cantidad de información biográfica...
$suscribers = get_users('role=subscriber');
$users = get_users();
$users_count = count($users);
$suscribers_count = count($suscribers);
?>
<!--<pre><?php 
print_r($user_meta); 
?></pre>-->

<div id="wrapper">
    <div id="main-slider">
        <img src="<?php bloginfo('template_directory');?>/img/jpeg.jpg" />
    </div>

    <div id="main-block" class="users">
        
        <?php //títul condicionado a la existencia de miembros
            if ($suscribers < 1) {
                ?> <h1 class="page-title"><?php _e('No hay usuarios registrados por el momento', 'sdg')?></h1> <?php
            } else {
                ?> <h1 class="page-title"><?php _e(get_the_title(), 'sdg')?></h1> <?php
            }
        ?>

        <div id="users-grid">

        <?php //loop por users que hace display solo con suscribers

            for ($i = 1; $i < ($users_count + 1); $i++) {
                $user_id = $i;
                $user_meta = get_user_meta($user_id);
                ?>

        <div id="user">
                <div id="user-img">
                    <img src="<?php echo $user_meta['wpcf-img-usuario'][0]; ?>">
                </div>
                <div id="user-info">
                    <span class="info-name"><?php echo $user_meta['wpcf-nombre'][0] . ' ' . $user_meta['wpcf-apellidos'][0]; ?></span>
                    <span class="info-age"><?php _e('Edad: ', 'sdg')?><?php echo $user_meta['wpcf-edad'][0]; ?></span>
                    <span class="info-place"><?php _e('Lugar de Procedencia: ', 'sdg')?><?php echo $user_meta['wpcf-lugar-de-procedencia'][0]; ?></span>
                    <div class="info-tiny-description">
                        <p><?php echo limit_text($user_meta['wpcf-datos-biograficos'][0], 25); ?></p>
                    </div>
                    <div class="info-ver-perfil">
                        <a href="?page_id=<?php echo set_links_lang(pll_current_language(), 'single'); ?>&user_id=<?php echo $user_id; ?>"><?php _e('Ver mi perfil', 'sdg'); ?></a>
                    </div>
                </div>
            </div> <!-- end of user -->        

        <?php    

            } //end of loop 

        ?>

         </div> <!-- end of users grid -->

    </div> <!-- end of main-block -->

</div> <!-- end of wrapper -->
      
<?php the_content();?> 

<?php include_once("footer.php"); ?>
