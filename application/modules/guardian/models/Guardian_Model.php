<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Guardian_Model extends MY_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    
    public function get_guardian_list(){
        
        if($this->session->userdata('role_id') == STUDENT){
            
            $profile_id = $this->session->userdata('profile_id');
            $student = $this->get_single('students', array('id'=>$profile_id));
            
            $this->db->select('G.*, S.school_name, U.email, U.role_id');
            $this->db->from('guardians AS G');
            $this->db->join('users AS U', 'U.id = G.user_id', 'left');
            $this->db->where('G.id', $student->guardian_id);            
            
        }else{            
            $this->db->select('G.*, S.school_name, U.email, U.role_id');
            $this->db->from('guardians AS G');
            $this->db->join('users AS U', 'U.id = G.user_id', 'left');
        }
        
        if($this->session->userdata('role_id') != SUPER_ADMIN){
            $this->db->where('G.school_id', $this->session->userdata('school_id'));
        }
        
        $this->db->join('schools AS S', 'S.id = G.school_id', 'left');
        return $this->db->get()->result();
        
    }
    
    public function get_single_guardian($id){
        
        $this->db->select('G.*, U.email, U.role_id, R.name as role');
        $this->db->from('guardians AS G');
        $this->db->join('users AS U', 'U.id = G.user_id', 'left');
        $this->db->join('roles AS R', 'R.id = U.role_id', 'left');
        $this->db->where('G.id', $id);
        return $this->db->get()->row();
        
    }
    
    function duplicate_check($email, $id = null) {

        if ($id) {
            $this->db->where_not_in('id', $id);
        }
        $this->db->where('email', $email);
        return $this->db->get('users')->num_rows();
    }
    
     public function get_invoice_list(){ 
        
        $this->db->select('I.*, S.name AS student_name, AY.session_year, C.name AS class_name');
        $this->db->from('invoices AS I');        
        $this->db->join('classes AS C', 'C.id = I.class_id', 'left');
        $this->db->join('students AS S', 'S.id = I.student_id', 'left');
        $this->db->join('academic_years AS AY', 'AY.id = I.academic_year_id', 'left');
        $this->db->where('I.invoice_type', 'academic'); 
        $this->db->where('S.guardian_id', $this->session->userdata('profile_id'));       
       
        return $this->db->get()->result();        
    }

}
