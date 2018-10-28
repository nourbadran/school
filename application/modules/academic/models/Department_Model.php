<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Department_Model extends MY_Model {
    
    function __construct() {
        parent::__construct();
    }
    
     public function get_department_list(){
        
        
        $this->db->select('d.*');
        $this->db->from('departments AS d');
        
        
        
        if($this->session->userdata('role_id') != SUPER_ADMIN){
            $this->db->where('d.school_id', $this->session->userdata('school_id'));
        }
        
        $this->db->order_by('d.school_id', 'ASC');
        
        return $this->db->get()->result();
        
    }
    
    public function get_single_section($id){
        
        $this->db->select('S.*, C.name AS class_name, T.name AS teacher');
        $this->db->from('sections AS S');
        $this->db->join('teachers AS T', 'T.id = S.teacher_id', 'left');
        $this->db->join('classes AS C', 'C.id = S.class_id', 'left');
        $this->db->where('S.id', $id);
        return $this->db->get()->row();
        
    }
    
    function duplicate_check($school_id, $class_id, $name, $id = null ){           
           
        if($id){
            $this->db->where_not_in('id', $id);
        }
        $this->db->where('class_id', $class_id);
        $this->db->where('name', $name);
        $this->db->where('school_id', $school_id);
        return $this->db->get('sections')->num_rows();            
    }
 
}
