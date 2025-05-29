<!-- Form about registering every topic section -->
<?php 

    $form_labels = parse_json(get_form_data_section()[$_GET['page']]['register']['form_labels']);
    $form_buttons = parse_json(get_form_data_section()[$_GET['page']]['register']['form_buttons']);

    $contentForm = "";
    foreach ($form_labels as $key => $form) {
        $field_type = $form->field_type;
        $attriibute = $form->field_atribute;
        $label = $form->field_label;
        if ( $field_type === 'input' ){
            $contentForm.="<div class='col-lg-2'>
                <label for='$key' class='form-label'>$label</label>
                <input type='$attriibute' class='form-control form-control-sm' name='$key' id='$key'>
            </div>";
        }
        else if ( $field_type === 'select' ){
            $optionsSelect = "";
            $exceptionsSelectKeys = ['ro_clients'];
            if ( isset( $form->field_values_select ) ){
                foreach ($form->field_values_select as $option => $value) {
                    // get the previous option value
                    if ( in_array($key, $exceptionsSelectKeys) && $option !== 'Todos' ){
                        $option = $value . " - " . $option;
                    }
                    $optionsSelect.="<option value='$value'>$option</option>";
                }
            }
            $contentForm.="
            <div class='col-lg-2'>
                <label for='$key' class='form-label'>$label</label>
                <select class='form-select form-select-sm' name='$key' id='$key'>
                    $optionsSelect
                </select>
            </div>";
        }
    }
        
    $contentForm.= "<div class='col-lg-4'>";

    $contentForm.= "<label for='' class='form-label'>&nbsp;</label><br>";

    foreach ($form_buttons as $key => $button) {
        $button_type = $key;
        $button_style_class = $button->styleClass;
        $button_label = $button->label;
        $button_id = $button->id;
        $contentForm.= "<button type='$button_type' class='$button_style_class' id='$button_id'>$button_label</button>&nbsp;";
    }

    $contentForm.= "</div>";

    echo $contentForm;

?>