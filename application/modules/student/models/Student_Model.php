<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Student_Model extends MY_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    public function get_student_list($class_id = null, $school_id = null){
        
        
        if(!$class_id){
           $class_id = $this->session->userdata('class_id');
        }
           
        $this->db->select('S.*, SC.school_name, E.roll_no, U.email, U.role_id,  C.name AS class_name, SE.name AS section');
        $this->db->from('enrollments AS E');
        $this->db->join('students AS S', 'S.id = E.student_id', 'left');
        $this->db->join('users AS U', 'U.id = S.user_id', 'left');
        $this->db->join('classes AS C', 'C.id = E.class_id', 'left');
        $this->db->join('supervisors AS SV', 'SV.id = C.supervisor_id', 'left');
        $this->db->join('sections AS SE', 'SE.id = E.section_id', 'left');
        $this->db->join('schools AS SC', 'SC.id = S.school_id', 'left');
        $this->db->where('E.academic_year_id', $this->academic_year_id); 
        
        if($class_id){
              $this->db->where('E.class_id', $class_id);
        }
        if($school_id){
              $this->db->where('S.school_id', $school_id);
        }
         
        if($this->session->userdata('role_id') == GUARDIAN){
           $this->db->where('S.guardian_id', $this->session->userdata('profile_id'));
        }
        if($this->session->userdata('role_id') == SUPERVISOR){
           $this->db->where('SV.user_id', $this->session->userdata('id'));
           
        }
        
        if($this->session->userdata('role_id') != SUPER_ADMIN){
            $this->db->where('S.school_id', $this->session->userdata('school_id'));
        }
       
        return $this->db->get()->result();
    }
    
    public function get_single_student($id){
        
        $this->db->select('S.*, G.name as guardian, E.roll_no, E.class_id, E.section_id, U.email, U.role_id, R.name AS role,  C.name AS class_name, SE.name AS section');
        $this->db->from('enrollments AS E');
        $this->db->join('students AS S', 'S.id = E.student_id', 'left');
        $this->db->join('users AS U', 'U.id = S.user_id', 'left');
        $this->db->join('roles AS R', 'R.id = U.role_id', 'left');
        $this->db->join('classes AS C', 'C.id = E.class_id', 'left');
        $this->db->join('sections AS SE', 'SE.id = E.section_id', 'left');
        $this->db->join('guardians AS G', 'G.id = S.guardian_id', 'left');
        $this->db->where('E.academic_year_id', $this->academic_year_id);
        $this->db->where('S.id', $id);
        return $this->db->get()->row();
        
    }
    
    function duplicate_check($email, $id = null) {

        if ($id) {
            $this->db->where_not_in('id', $id);
        }
        $this->db->where('email', $email);
        return $this->db->get('users')->num_rows();
    }
}
