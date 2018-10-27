<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Invoice_Model extends MY_Model {
    
    function __construct() {
        parent::__construct();
    }

    public function get_invoice_list($due = null){
        
        $this->db->select('I.*, SC.school_name, S.name AS student_name, AY.session_year, C.name AS class_name');
        $this->db->from('invoices AS I');        
        $this->db->join('classes AS C', 'C.id = I.class_id', 'left');
        $this->db->join('students AS S', 'S.id = I.student_id', 'left');
        $this->db->join('academic_years AS AY', 'AY.id = I.academic_year_id', 'left');
        $this->db->join('schools AS SC', 'SC.id = I.school_id', 'left');
        $this->db->where('I.invoice_type', 'academic'); 
        
        if($due){
            $this->db->where('I.paid_status !=', 'paid');  
        }
        
        if($this->session->userdata('role_id') == STUDENT){
            $this->db->where('I.student_id', $this->session->userdata('profile_id'));
        }
        
        //$this->db->where('I.academic_year_id', $this->academic_year_id);       
       $this->db->order_by('I.id', 'DESC');  
        return $this->db->get()->result();        
    }
    
    public function get_single_invoice($id){
        
        $this->db->select('I.*, I.discount AS inv_discount, I.id AS inv_id , S.*, AY.session_year, C.name AS class_name');
        $this->db->from('invoices AS I');        
        $this->db->join('classes AS C', 'C.id = I.class_id', 'left');
        $this->db->join('students AS S', 'S.id = I.student_id', 'left');
        $this->db->join('academic_years AS AY', 'AY.id = I.academic_year_id', 'left');
        $this->db->where('I.invoice_type', 'academic');
        //$this->db->where('I.academic_year_id', $this->academic_year_id);       
        $this->db->where('I.id', $id);       
       
        return $this->db->get()->row();        
    }
    
    public function get_student_list($class_id, $student_id = null){
        
        $this->db->select('E.roll_no,  S.id, S.user_id, S.discount, S.name, S.is_hostel_member, S.is_transport_member');
        $this->db->from('enrollments AS E');        
        $this->db->join('students AS S', 'S.id = E.student_id', 'left');
        $this->db->where('E.academic_year_id', $this->academic_year_id);       
        $this->db->where('E.class_id', $class_id);  
        
        if($student_id != 'all'){
            $this->db->where('E.student_id', $student_id); 
        }
        
        return $this->db->get()->result();   
        
    }
    
    public function get_student_hostel_cost($user_id){
         $this->db->select('R.cost');
        $this->db->from('hostel_members AS HM');        
        $this->db->join('rooms AS R', 'R.id = HM.room_id', 'left');
        $this->db->where('HM.user_id', $user_id);                  
        return $this->db->get()->row();
    }
    
    public function get_student_transport_fare($user_id){
        
        
        $this->db->select('R.fare');
        $this->db->from('transport_members AS TM');        
        $this->db->join('routes AS R', 'R.id = TM.route_id', 'left');
        $this->db->where('TM.user_id', $user_id);                  
        return $this->db->get()->row();
    }
    
    public function get_invoice_log_list($invoice_id){
                
        $this->db->select('IL.*, IH.title');
        $this->db->from('invoice_logs AS IL');        
        $this->db->join('income_heads AS IH', 'IH.id = IL.income_head_id', 'left');
        $this->db->where('IL.invoice_id', $invoice_id); 
        if($this->session->userdata('role_id') == STUDENT){
            $this->db->where('I.student_id', $this->session->userdata('profile_id'));
        }
        return $this->db->get()->result();
    }
    
    
}
