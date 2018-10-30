<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Supervisor_Model extends MY_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    public function get_supervisor_list( $school_id = null){
        
           
        $this->db->select('S.*, SC.school_name, U.email');
        $this->db->from('supervisors AS S');
        $this->db->join('users AS U', 'U.id = S.user_id', 'left');
        $this->db->join('schools AS SC', 'SC.id = S.school_id', 'left');
        
       
        if($school_id){
              $this->db->where('S.school_id', $school_id);
        }
        
        
        if($this->session->userdata('role_id') != SUPER_ADMIN){
            $this->db->where('S.school_id', $this->session->userdata('school_id'));
        }
       
        return $this->db->get()->result();
    }
    
    public function get_single_supervisor($id){
        
        $this->db->select('S.*, SC.school_name, U.email,U.role_id, R.name AS role');
        $this->db->from('supervisors AS S');
        $this->db->join('users AS U', 'U.id = S.user_id', 'left');
        $this->db->join('schools AS SC', 'SC.id = S.school_id', 'left');
        $this->db->join('roles AS R', 'R.id = U.role_id', 'left');
       
    
        
        if($this->session->userdata('role_id') != SUPER_ADMIN){
            $this->db->where('S.school_id', $this->session->userdata('school_id'));
        }
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
