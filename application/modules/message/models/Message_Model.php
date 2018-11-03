<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Message_Model extends MY_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    public function get_message_list($type){
        
        $this->db->select('MR.*, M.*');
        $this->db->from('message_relationships AS MR');
        $this->db->join('messages AS M', 'M.id = MR.message_id', 'left');
        
        if($type == 'draft'){
            $this->db->where('MR.status', 1);
            $this->db->where('MR.is_draft', 1);
            $this->db->where('MR.owner_id', logged_in_user_id());
            $this->db->where('MR.sender_id', logged_in_user_id());
        }
        if($type == 'inbox'){
            $this->db->where('MR.status', 1);
            $this->db->where('MR.owner_id', logged_in_user_id());
            $this->db->where('MR.receiver_id', logged_in_user_id());
        }
        if($type == 'new'){
            $this->db->where('MR.status', 1);
            $this->db->where('MR.owner_id', logged_in_user_id());
            $this->db->where('MR.is_read', 0);
            $this->db->where('MR.receiver_id', logged_in_user_id());
        }
        if($type == 'trash'){
            $this->db->where('MR.status', 1);
            $this->db->where('MR.is_trash', 1);
            $this->db->where('MR.owner_id', logged_in_user_id());
        }
        if($type == 'sent'){
            $this->db->where('MR.status', 1);
            $this->db->where('MR.is_draft', 0);
            $this->db->where('MR.is_trash', 0);
            $this->db->where('MR.sender_id', logged_in_user_id());
            $this->db->where('MR.owner_id', logged_in_user_id());
        }
        if ($type=='supervisor-list') {
             
            $this->db->join('users AS US', 'US.id = MR.sender_id ', 'left');
            $this->db->join('users AS US2', 'US2.id = MR.receiver_id', 'left');
            $this->db->join('students AS S', 'S.user_id = US.id', 'left');
            $this->db->join('enrollments AS E', 'E.student_id = S.id', 'left');
            $this->db->join('classes AS C', 'C.id = E.class_id', 'left');
            $this->db->join('supervisors AS SV', 'SV.id = C.supervisor_id', 'left');
            $this->db->where('MR.role_id ', STUDENT);
            $this->db->where('SV.user_id ', $this->session->userdata('id'));
            $this->db->where('MR.sender_id !=', $this->session->userdata('id'));
            $this->db->where('MR.receiver_id !=', $this->session->userdata('id'));
            $this->db->group_by('MR.message_id');
        }
        
        if($this->session->userdata('role_id') != SUPER_ADMIN &&  $this->session->userdata('role_id') != SUPERVISOR){
            $this->db->where('MR.school_id', $this->session->userdata('school_id'));
        }
        
        return $this->db->get()->result();
        
    }
    
    public function get_single_message($id,$checkOwner=true){
        $this->db->select('MR.*, M.*');
        $this->db->from('message_relationships AS MR');
        $this->db->join('messages AS M', 'M.id = MR.message_id', 'left');
        $this->db->where('MR.message_id', $id);
        if ($checkOwner) {
           $this->db->where('MR.owner_id', logged_in_user_id());
        }
        
        return $this->db->get()->row();
    }

}
