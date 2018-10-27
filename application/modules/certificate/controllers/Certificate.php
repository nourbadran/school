<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* * *****************Generate.php**********************************
 * @product name    : Global Multi School Management System Express
 * @type            : Class
 * @class name      : Generate
 * @description     : Manage all type of system student listing.  
 * @author          : Codetroopers Team 	
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com	
 * @copyright       : Codetroopers Team	 	
 * ********************************************************** */

class Certificate extends MY_Controller {

    public $data = array();
      
   public function __construct() {
        parent::__construct();
                
        $this->load->model('Type_Model', 'type', true);                
    }

  

   

    /*****************Function index**********************************
     * @type            : Function
     * @function name   : index
     * @description     : Load user filtering interface                 
     *                      
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    public function index(){
        
        
        check_permission(VIEW);
        
        $this->data['students'] = '';
        
         if ($_POST) {
             
            $school_id = $this->input->post('school_id');
            $class_id = $this->input->post('class_id');
            $certificate_id = $this->input->post('certificate_id');
            
            $this->data['students'] = $this->type->get_student_list($school_id, $class_id);
            $this->data['school_id'] = $school_id;
            $this->data['class_id'] = $class_id;
            $this->data['certificate_id'] = $certificate_id;
         }
         
        $condition = array();
        $condition['status'] = 1;        
        if($this->session->userdata('role_id') != SUPER_ADMIN){            
            $condition['school_id'] = $this->session->userdata('school_id');        
            $this->data['certificates'] = $this->type->get_list('certificates', $condition, '','', '', 'id', 'ASC');
            $this->data['classes'] = $this->type->get_list('classes', $condition, '','', '', 'id', 'ASC');
        }        
        
        $this->layout->title($this->lang->line('generate') .' ' . $this->lang->line('certificate') .' | ' . SMS);
        $this->layout->view('certificate/index', $this->data); 
    }
    
    
    /*****************Function generate**********************************
     * @type            : Function
     * @function name   : generate
     * @description     : Load certificate generete interface                 
     *                      
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    public function generate($student_id, $class_id, $certificate_id){
        
        
        check_permission(VIEW);
       
        $this->data['certificate'] = $this->type->get_single('certificates', array('id' => $certificate_id));
        $this->data['school'] = $this->type->get_single('schools', array('id'=>$this->data['certificate']->school_id, 'status'=>1));
        $this->data['student'] = $this->type->get_student($student_id, $class_id);     
        $this->data['certificate']->main_text = get_formatted_certificate_text($this->data['certificate']->main_text, $this->data['student']->role_id, $this->data['student']->user_id);
        $this->layout->title($this->lang->line('generate') .' ' . $this->lang->line('certificate') .' | ' . SMS);
        $this->load->view('certificate/generate', $this->data); 
        
    }

}
