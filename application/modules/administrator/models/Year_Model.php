<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Year_Model extends MY_Model {
    
    function __construct() {
        parent::__construct();
    }
    
        
    function duplicate_check($session_year, $id = null ){           
           
        if($id){
            $this->db->where_not_in('id', $id);
        }
        $this->db->where('session_year', $session_year);
        return $this->db->get('academic_years')->num_rows();            
    }
}
