<?php
/**
 * Template Name: Eventos
 *
 */

get_header(); ?>

<div id="wrapper">
    <div id="main-slider">
        <img src="<?php bloginfo('template_directory');?>/img/jpeg.jpg" />
    </div>

    <div id="main-block" class="events">

        <h1 class="page-title"><?php _e('Eventos', 'sdg')?></h1>
        <div id="events-grid">
            <?php 
                //loop query
                $query = array( 'post_type' => 'eventos', 'posts_per_page' => 10 );
                $loop = new WP_Query( $query );;
                while ( $loop->have_posts() ) : $loop->the_post();
            ?>

            <div id="event" data-link="<?php echo get_permalink();?>">
                  <?php
                        $meta = get_post_meta(get_the_ID());
                        //print_r($meta);
                    ?>
                <div id="event-img">
                    <?php 
                        //image info...
                        $size = array ('100%','100%');
                        $attr = array(
                            //'src' => $src,
                            'class' => "event-img",
                            'alt'   => trim(strip_tags($attachment->post_excerpt)),
                            'title' => trim(strip_tags($attachment->post_title))
                        );
                    ?>
                    <?php echo get_the_post_thumbnail(get_the_ID(), $size, $attr); ?><!--img from wp-->
                </div>
                <div id="event-info">
                    <span class="info-name"><?php _e('Título del evento', 'sdg'); ?>: <?php echo get_the_title();?></span>
                    <span class="info-date"><?php _e('Fecha', 'sdg'); ?>: <?php echo date('d.m.Y - H:i' , $meta['wpcf-event-date'][0]);?></span>
                    <span class="info-where"><?php _e('Lugar', 'sdg'); ?>: <?php echo $meta['wpcf-event-place'][0];?></span>
                    <div class="info-tiny-description">
                        <p><?php echo limit_text(get_the_content(), 35); ?></p>
                    </div>
                    <div class="info-ver-perfil">
                        <a href="#"><?php _e('Más información', 'sdg') ?></a>
                    </div>
                </div>
               
                <div id="event-date">
                    <table>
                        <tr>
                            <td colspan="2"><?php echo date('d.m.Y' , $meta['wpcf-event-date'][0]);?></td>
                        </tr>
                        <tr>
                            <td><?php echo date('H:i' , $meta['wpcf-event-date'][0]);?></td>
                            <td class="flags"><?php set_flags($meta['wpcf-event-language'][0]); ?></td>
                        </tr>
                    </table>
                </div>

            </div> <!-- end of event -->  
            <?php endwhile; ?>
        </div> <!-- end of events-grid -->  

    </div> <!-- end of main-block -->

</div> <!-- end of wrapper -->
       

<?php include_once("footer.php"); ?>
