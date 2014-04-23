<div class="js-wpt-field wpt-field js-wpt-<?php echo $cfg['type']; ?> wpt-<?php echo $cfg['type']; ?><?php if ( @$cfg['repetitive'] ) echo ' js-wpt-repetitive wpt-repetitive'; ?><?php do_action('wptoolset_field_class', $cfg); ?>" data-wpt-type="<?php echo $cfg['type']; ?>" data-wpt-id="<?php echo $cfg['id']; ?>">
    <div class="js-wpt-field-items">
    <?php foreach ( $html as $out ): include 'metaform-item.php';
    endforeach; ?>
    </div>
    <?php if ( @$cfg['repetitive'] ): ?>
        <a href="#" class="js-wpt-repadd wpt-repadd button-primary"><?php printf(__('Add new %s'), $cfg['title']); ?></a>
<?php endif; ?>
</div>