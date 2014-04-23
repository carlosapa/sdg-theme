<?php
require_once 'class.field_factory.php';

/**
 * Description of class
 *
 * @author Srdjan
 */
class WPToolset_Field_Radios extends FieldFactory
{

    public function metaform() {
        $value = $this->getValue();
        $data = $this->getData();
        
        $form = array();
        $options = array();
        foreach ( $data['options'] as $option ) {
            $options[] = array(
                '#value' => $option['value'],
                '#title' => $option['title'],
                '#validate' => $this->getValidationData(),
            );
        }
        if ( !empty( $value ) || $value == '0' ) {
            $data['default_value'] = $value;
        }
        $form[] = array(
            '#type' => 'radios',
            '#title' => $this->getTitle(),
            '#description' => $this->getDescription(),
            '#name' => $this->getName(),
            '#options' => $options,
            '#default_value' => isset( $data['default_value'] ) ? $data['default_value'] : false,
        );
        return $form;
    }

}