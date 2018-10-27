<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sms_Model extends MY_Model {
    
    function __construct() {
        parent::__construct();
    }  
    
     public function get_sms_list(){
        $this->db->select('TM.*, S.school_name, R.name AS receiver_type, AY.session_year ');
        $this->db->from('text_messages AS TM');
        $this->db->join('roles AS R', 'R.id = TM.role_id', 'left');
        $this->db->join('academic_years AS AY', 'AY.id = TM.academic_year_id', 'left');
         $this->db->join('schools AS S', 'S.id = TM.school_id', 'left');
         
        if($this->session->userdata('role_id') != SUPER_ADMIN){
            $this->db->where('TM.school_id', $this->session->userdata('school_id'));
        }

        return $this->db->get()->result();    
    }
    
     public function get_user_list($school_id, $role_id, $receiver_id, $class_id = null){
        
        if($role_id == STUDENT){
            
            $this->db->select('S.phone, S.name, U.email, U.role_id,  U.id,  C.name AS class_name');
            $this->db->from('enrollments AS E');
            $this->db->join('students AS S', 'S.id = E.student_id', 'left');
            $this->db->join('users AS U', 'U.id = S.user_id', 'left');
            $this->db->join('classes AS C', 'C.id = E.class_id', 'left');
            $this->db->where('E.academic_year_id', $this->academic_year_id);
            $this->db->where('E.class_id', $class_id);
            $this->db->where('S.school_id', $school_id);
            if($receiver_id > 0){
                $this->db->where('S.user_id', $receiver_id);
            }
            return $this->db->get()->result(); 
            
        }elseif($role_id == TEACHER){
            $this->db->select('T.phone, T.name, U.email, U.role_id,  U.id');
            $this->db->from('teachers AS T');
            $this->db->join('users AS U', 'U.id = T.user_id', 'left');
            $this->db->where('T.school_id', $school_id);
             if($receiver_id > 0){
                $this->db->where('T.user_id', $receiver_id);
            }
            return $this->db->get()->result();            
        
        }elseif($role_id == GUARDIAN){
            $this->db->select('G.phone, G.name, U.email, U.role_id,  U.id');
            $this->db->from('guardians AS G');
            $this->db->join('users AS U', 'U.id = G.user_id', 'left'); 
            $this->db->where('G.school_id', $school_id);
             if($receiver_id > 0){
                $this->db->where('G.user_id', $receiver_id);
            }
            return $this->db->get()->result();
        }else{
            $this->db->select('E.phone, E.name, U.email, U.id, U.role_id');
            $this->db->from('employees AS E');
            $this->db->join('users AS U', 'U.id = E.user_id', 'left');
            
            if($receiver_id > 0){
                $this->db->where('E.user_id', $receiver_id);
            }
            
            if($role_id != SUPER_ADMIN){
                $this->db->where('E.school_id', $school_id);
            }
            
            return $this->db->get()->result();
        }  
    }

}
