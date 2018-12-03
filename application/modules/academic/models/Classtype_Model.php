<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Classtype_Model extends MY_Model {

    function __construct() {
        parent::__construct();
    }




    function duplicate_check($school_id, $name, $id = null ){

        if($id){
            $this->db->where_not_in('id', $id);
        }
        $this->db->where('name', $name);
        return $this->db->get('class_types')->num_rows();
    }
}
