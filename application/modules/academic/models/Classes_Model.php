<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Classes_Model extends MY_Model {
    
    function __construct() {
        parent::__construct();
    }
    
     public function get_class_list(){
        
        $this->db->select('C.*, S.school_name,E.name AS supervisor,CT.name AS class_type, T.name AS teacher,D.name AS department');
        $this->db->from('classes AS C');
        $this->db->join('teachers AS T', 'T.id = C.teacher_id', 'left');
        $this->db->join('class_types AS CT', 'CT.id = C.class_type_id', 'left');
        $this->db->join('schools AS S', 'S.id = C.school_id', 'left');
        //$this->db->join('supervisors AS VS', 'VS.id = C.supervisor_id', 'left');

        $this->db->join('employees AS E', 'E.user_id = C.supervisor_id', 'left');
         $this->db->join('departments AS D', 'D.id = C.department_id', 'left');
        if($this->session->userdata('role_id') != SUPER_ADMIN){
            $this->db->where('C.school_id', $this->session->userdata('school_id'));
        }
         if($this->session->userdata('role_id') == SUPERVISOR){
             $this->db->where('E.user_id', $this->session->userdata('id'));
         }
        return $this->db->get()->result();
        
    }

    public function get_supervisor_list(){

        $this->db->select('E.user_id as id,E.name');
        $this->db->from('employees AS E');
        $this->db->join('users AS U', 'U.id = E.user_id', 'left');
        $this->db->where('U.role_id', SUPERVISOR);
        return $this->db->get()->result();

    }
    

    
    function duplicate_check($school_id, $name, $id = null ){           
           
        if($id){
            $this->db->where_not_in('id', $id);
        }
        $this->db->where('name', $name);
        $this->db->where('school_id', $school_id);
        return $this->db->get('classes')->num_rows();            
    }
}
