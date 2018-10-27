<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Holiday_Model extends MY_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    public function get_holiday_list(){
        
        $this->db->select('H.*, S.school_name');
        $this->db->from('holidays AS H');
        $this->db->join('schools AS S', 'S.id = H.school_id', 'left');
        
        if($this->session->userdata('role_id') != SUPER_ADMIN){
            $this->db->where('H.school_id', $this->session->userdata('school_id'));
        }
        return $this->db->get()->result();
        
    }
     function duplicate_check($school_id, $title, $date_from, $id = null ){           
           
        if($id){
            $this->db->where_not_in('id', $id);
        }
        $this->db->where('school_id', $school_id);
        $this->db->where('title', $title);
        $this->db->where('date_from', date('Y-m-d', strtotime($date_from)));
        return $this->db->get('holidays')->num_rows();            
    }

}
