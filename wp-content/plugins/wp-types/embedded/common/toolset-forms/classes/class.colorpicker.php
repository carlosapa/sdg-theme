<?php
require_once 'class.textfield.php';

/**
 * Description of class
 *
 * @author Srdjan
 */
class WPToolset_Field_Colorpicker extends WPToolset_Field_Textfield
{

    public $useFarbtastic;

    public function init() {
        global $wp_version;
        wp_register_script( 'wptoolset-field-colorpicker',
                WPTOOLSET_FORMS_RELPATH . '/js/colorpicker.js', array('jquery'),
                WPTOOLSET_FORMS_VERSION, true );
        wp_register_style( 'wptoolset-field-colorpicker',
                WPTOOLSET_FORMS_RELPATH . '/css/colorpicker.css' );
        $this->useFarbtastic = (bool) version_compare( $wp_version, '3.5', '<' );
    }

    public function enqueueScripts() {
        wp_enqueue_script( 'wptoolset-field-colorpicker' );
        $js_data = array('use_farbtastic' => $this->useFarbtastic,
            'pickTxt' => __( 'Pick color' ),
            'doneTxt' => __( 'Done' ));
        wp_localize_script( 'wptoolset-field-colorpicker', 'wptColorpickerData',
                $js_data );
        if ( is_admin() ) {
            if ( $this->useFarbtastic ) {
                wp_enqueue_script( 'farbtastic' );
            } else {
                wp_enqueue_script( 'wp-color-picker' );
            }
        } else {
            $this->_frontendEnqueueScripts();
        }
        if ( $this->useFarbtastic ) {
            add_action( 'wp_footer', array($this, 'renderFarbtastic') );
            add_action( 'admin_footer', array($this, 'renderFarbtastic') );
        }
    }

    public function enqueueStyles() {
        wp_enqueue_style( 'wptoolset-field-colorpicker' );
        if ( $this->useFarbtastic ) {
            wp_enqueue_style( 'farbtastic' );
        } else {
            wp_enqueue_style( 'wp-color-picker' );
        }
    }

    public function metaform() {
        $form = array();
        $form['name'] = array(
            '#type' => 'textfield',
            '#title' => $this->getTitle(),
            '#value' => $this->getValue(),
            '#name' => $this->getName(),
            '#attributes' => array('class' => 'js-wpt-colorpicker'),
            '#validate' => $this->getValidationData(),
            '#after' => '',
        );
        if ( $this->useFarbtastic ) {
            $form['name']['#after'] .= '<a href="#" class="button-secondary js-wpt-pickcolor">'
                    . __( 'Pick color' )
                    . '</a><div class="js-wpt-cp-preview wpt-cp-preview" style="background-color:'
                    . $this->getValue() . '"></div>';
        }
        return $form;
    }

    /**
     * Pre WP 3.5.
     */
    public function renderFarbtastic() {
        echo '<div id="wpt-color-picker" style="display:none; background-color: #FFF; width:220px; padding: 10px;"></div>';
    }

    /**
     * WP do not queue color picker when on frontend
     * http://wordpress.stackexchange.com/questions/82718/how-do-i-implement-the-wordpress-iris-picker-into-my-plugin-on-the-front-end
     */
    protected function _frontendEnqueueScripts() {
        if ( $this->useFarbtastic ) {
            wp_enqueue_script(
                    'farbtastic', admin_url( 'js/farbtastic.js' ),
                    array('jquery'), WPTOOLSET_FORMS_VERSION, true
            );
        } else {
            wp_enqueue_script(
                    'iris', admin_url( 'js/iris.min.js' ),
                    array('jquery-ui-draggable', 'jquery-ui-slider', 'jquery-touch-punch'),
                    WPTOOLSET_FORMS_VERSION, true
            );
            wp_enqueue_script(
                    'wp-color-picker', admin_url( 'js/color-picker.min.js' ),
                    array('iris'), WPTOOLSET_FORMS_VERSION, true
            );
            wp_localize_script( 'wp-color-picker', 'wpColorPickerL10n',
                    array(
                'clear' => __( 'Clear' ),
                'defaultString' => __( 'Default' ),
                'pick' => __( 'Select Color' ))
            );
        }
    }

}