<?php

/**
 * Description of mysql_breakdown_table
 *
 * @author Rami Dabain
 * email : brains@okitoo.net
 * skype : ronan_dejhero
 */
class mysql_breakdown_table {

    public $fields = array();
    public $table_name = array();

    /**
     * loads the stdObject from Mysql_fetch_object and parses it
     * @param stdObj $fields
     */
    public function __construct($table_name, $fields) {
        $this->table_name = $table_name;
        foreach ($fields as $fieldData) {
            $field = new stdClass();
            $field->field = '';

            $field->type_length = '';
            $field->null = '';
            $field->key = '';
            $field->default = '';
            $field->extra = '';
            foreach ($fieldData as $key => $val) {
                $field->{strtolower($key)} = $val;
            }//
            $brackPos = strpos($field->type, '(');
            if ($brackPos > 0) {
                $field->type_length = substr($field->type, $brackPos + 1, -1);
                $field->type = substr($field->type, 0, $brackPos);
            }
            $this->fields[] = $field;
        }
        print_r($this->fields);
    }

}
