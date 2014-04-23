<?php
require_once 'class.field_factory.php';

/**
 * Description of class
 *
 * @author Srdjan
 */
class WPToolset_Field_Checkbox extends FieldFactory
{

    public function metaform() {
        $value = $this->getValue();
        $data = $this->getData();

        if ( !empty( $value ) || $value == '0' ) {
            $data['default_value'] = $value;
        }
        
        $form = array();
        $form[] = array(
            '#type' => 'checkbox',
            '#value' => $value,
            '#default_value' => isset($data['default_value']) ? (bool) $data['default_value'] : null,
            '#name' => $this->getName(),
            '#title' => $this->getTitle(),
            '#validate' => $this->getValidationData(),
            '#after' => '<input type="hidden" name="_wptoolset_checkbox[' . $this->getId() . ']" value="1" />',
        );
        return $form;
    }

}