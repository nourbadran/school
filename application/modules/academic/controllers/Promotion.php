<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* * *****************Promotion.php**********************************
 * @product name    : Global Multi School Management System Express
 * @type            : Class
 * @class name      : Promotion
 * @description     : Manage student promotion from one academic class to another academic class.  
 * @author          : Codetroopers Team 	
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com	
 * @copyright       : Codetroopers Team	 	
 * ********************************************************** */

class Promotion extends MY_Controller {

    public $data = array();
    
    
    function __construct() {
        parent::__construct();
        $this->load->model('Promotion_Model', 'promotion', true);
        
        if(!$this->academic_year_id){
            error($this->lang->line('academic_year_setting'));
            redirect('setting');
        }        
        
    }

        
    /*****************Function index**********************************
     * @type            : Function
     * @function name   : index
     * @description     : load "Promotion" user input interface and 
     *                      process/filter promotion calss
     *                       
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    public function index() {                
        
        check_permission(VIEW);
        if($_POST){
            
            $school_id   = $this->input->post('school_id');
            $current_session_id   = $this->input->post('current_session_id');
            $next_session_id   = $this->input->post('next_session_id');
            $current_class_id = $this->input->post('current_class_id');
            $next_class_id = $this->input->post('next_class_id');  
            $exam_id = $this->input->post('exam_id');  
            
            $this->data['students'] = $this->promotion->get_student_list($school_id, $exam_id, $current_class_id);
            
            $this->data['current_class'] = $this->promotion->get_single('classes', array('school_id'=>$school_id, 'id' => $current_class_id));
            $this->data['next_class'] = $this->promotion->get_single('classes', array('school_id'=>$school_id,'id' => $next_class_id));
                                              
            $this->data['school_id'] = $school_id;
            $this->data['current_session_id'] = $current_session_id;
            $this->data['next_session_id'] = $next_session_id;
            $this->data['current_class_id'] = $current_class_id;
            $this->data['next_class_id'] = $next_class_id;
            $this->data['exam_id'] = $exam_id;
            
        }
        
        
        $condition = array();
        $condition['status'] = 1;        
        if($this->session->userdata('role_id') != SUPER_ADMIN){ 
            
            $condition['school_id'] = $this->session->userdata('school_id');
            $this->data['classes'] = $this->promotion->get_list('classes', $condition, '','', '', 'id', 'ASC');
            $this->data['grades'] = $this->promotion->get_list('grades', $condition, '', '', '', 'id', 'ASC');
            
            $condition['academic_year_id'] = $this->academic_year_id;
            $this->data['exams'] = $this->promotion->get_list('exams', $condition, '', '', '', 'id', 'ASC');
        } 
        
        
        $this->data['curr_session'] = $this->promotion->get_single('academic_years', array('is_running' => 1));
        $this->data['next_session'] = $this->promotion->get_list('academic_years', array('id !=' => $this->academic_year_id, 'status'=>1), '','', '', 'session_year', 'ASC');

        $this->layout->title( $this->lang->line('manage_promotion'). ' | ' . SMS);
        $this->layout->view('promotion/index', $this->data);  
    }
    
    
            
    /*****************Function add**********************************
     * @type            : Function
     * @function name   : add
     * @description     : Process "Promotion" to next/promoted class                 
     *                    and store promoted class information into database    
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    public function add() {                
        
        check_permission(ADD);
        if($_POST){
            
            $school_id   = $this->input->post('school_id');
            $current_session_id   = $this->input->post('current_session_id');
            $next_session_id   = $this->input->post('next_session_id');
            $current_class_id = $this->input->post('current_class_id');
            $next_class_id = $this->input->post('next_class_id');  
                      
           
            // get next class default section
            $next_class_default_section = $this->promotion->get_single('sections', array('school_id'=>$school_id, 'class_id'=>$next_class_id, 'name'=>'A'));
            
            if(!empty($_POST['students'])){
                
                foreach($_POST['students'] as $key=>$value){
                    
                       // need to check is any student alredy enrolled
                        $exist = $this->promotion->get_single('enrollments', array('school_id'=>$school_id, 'class_id'=>$next_class_id, 'student_id'=>$value, 'academic_year_id'=>$next_session_id));
                        $data = array();
                        $data['class_id'] = $_POST['promotion_class_id'][$value]; 
                        $data['roll_no'] = $_POST['roll_no'][$value]; 
                        
                       if(empty($exist)){ 
                            $data['section_id'] = $next_class_default_section->id ? $next_class_default_section->id : ''; 
                            $data['school_id'] = $school_id; 
                            $data['academic_year_id'] = $next_session_id; 
                            $data['student_id'] = $value;                          
                            $data['status'] = 1;
                            $data['created_at'] = date('Y-m-d H:i:s');
                            $data['created_by'] = logged_in_user_id();                       
                            $this->promotion->insert('enrollments', $data);   
                       }else{
                           $data['modified_at'] = date('Y-m-d H:i:s');
                           $data['modified_by'] = logged_in_user_id(); 
                           $this->promotion->update('enrollments', $data, array('school_id'=>$school_id,'student_id'=>$value, 'academic_year_id'=>$next_session_id)); 
                       }
                }
            }
            success($this->lang->line('promotion') .' '. $this->lang->line('insert_success'));                      
        }else{
            error($this->lang->line('promotion').' '.$this->lang->line('insert_failed'));  
        }        
       
        redirect('academic/promotion/index');
    }


}
