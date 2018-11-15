<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* * *****************Employee.php**********************************
 * @product name    : Global Multi School Management System Express
 * @type            : Class
 * @class name      : Employee
 * @description     : Manage employee daily attendance.  
 * @author          : Codetroopers Team 	
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com	
 * @copyright       : Codetroopers Team	 	
 * ********************************************************** */

class Employee extends MY_Controller {

    public $data = array();    
    
    function __construct() {
        parent::__construct();
         $this->load->model('Employee_Model', 'employee', true);

        $this->load->helper(array('form', 'url'));
    }

    
    
    /*****************Function index**********************************
    * @type            : Function
    * @function name   : index
    * @description     : Load "Employee Attendance" user interface                 
    *                    and Process to manage daily Employee attendance    
    * @param           : null
    * @return          : null 
    * ********************************************************** */    
    public function index() { 
        
          check_permission(VIEW);
        
        if($_POST){ 
            $date       = $this->input->post('date');            
            $month      = date('m', strtotime($this->input->post('date')));
            $year       = date('Y', strtotime($this->input->post('date')));            
            $school_id  = $this->input->post('school_id');
            
            $this->data['employees'] = $this->employee->get_employee_list($school_id);            
            
            $condition = array(              
                'school_id'=>$school_id,
                'month'=>$month,
                'year'=>$year
            );
            
            $data = $condition;
            if(!empty($this->data['employees'])){
                
                foreach($this->data['employees'] as $obj){
                    
                    $condition['employee_id'] = $obj->id;                    
                    $attendance = $this->employee->get_single('employee_attendances', $condition);
                  
                    if(empty($attendance)){
                       $data['academic_year_id'] = $this->academic_year_id; 
                       $data['employee_id'] = $obj->id; 
                       $data['status'] = 1;
                       $data['created_at'] = date('Y-m-d H:i:s');
                       $data['created_by'] = logged_in_user_id();
                       $this->employee->insert('employee_attendances', $data);
                    }                    
                }
            }
            
            $this->data['school_id'] = $school_id;
            $this->data['academic_year_id'] = $this->academic_year_id;
            $this->data['day'] = date('d', strtotime($this->input->post('date')));
            $this->data['month'] = date('m', strtotime($this->input->post('date')));
            $this->data['year'] = date('Y', strtotime($this->input->post('date')));

            $this->data['date'] = $date;
            
        }
        
        $this->layout->title($this->lang->line('employee'). ' ' . $this->lang->line('attendance'). ' | ' . SMS);
        $this->layout->view('employee/index', $this->data);  
    }

    /*****************Function index**********************************
     * @type            : Function
     * @function name   : index
     * @description     : Load "Employee Attendance" user interface
     *                    and Process to manage daily Employee attendance
     * @param           : null
     * @return          : null
     * ********************************************************** */
    public function import() {

        check_permission(VIEW);

        if($_FILES)
        {
            $config['upload_path']          = './application/uploads/';
            $config['allowed_types']        = '*';

            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('file'))
            {

                $error = array('error' => $this->upload->display_errors());

                $this->load->view('employee/import', $error);
            }
            else
            {
                $data = array('upload_data' => $this->upload->data());


            }
            $this->layout->view('employee/index', $this->data);
        }

        $this->layout->title($this->lang->line('employee'). ' ' . $this->lang->line('attendance'). ' | ' . SMS);
        $this->layout->view('employee/import', $this->data);
    }

 

    /*****************Function update_single_attendance**********************************
    * @type            : Function
    * @function name   : update_single_attendance
    * @description     : Process to update single employee attendance status               
    *                        
    * @param           : null
    * @return          : null 
    * ********************************************************** */  
    public function update_single_attendance(){        
        
        $status     = $this->input->post('status');
        $condition['school_id'] = $this->input->post('school_id');;        
        $condition['employee_id'] = $this->input->post('employee_id');;        
        $condition['month']      = date('m', strtotime($this->input->post('date')));
        $condition['year']       = date('Y', strtotime($this->input->post('date')));
        $condition['academic_year_id'] = $this->academic_year_id;
        
        $field = 'day_'.abs(date('d', strtotime($this->input->post('date'))));
        if($this->employee->update('employee_attendances', array($field=>$status), $condition)){
            echo TRUE;
        }else{
            echo FALSE;
        }  
    }
    
    
    /*****************Function update_all_attendance**********************************
    * @type            : Function
    * @function name   : update_all_attendance
    * @description     : Process to update all employee attendance status                 
    *                        
    * @param           : null
    * @return          : null 
    * ********************************************************** */ 
     public function update_all_attendance(){        
        
        $status     = $this->input->post('status');        
        $condition['month']      = date('m', strtotime($this->input->post('date')));
        $condition['year']       = date('Y', strtotime($this->input->post('date')));
        $condition['academic_year_id'] = $this->academic_year_id;
        $condition['school_id'] = $this->input->post('school_id');
        
        $field = 'day_'.abs(date('d', strtotime($this->input->post('date'))));
        if($this->employee->update('employee_attendances', array($field=>$status), $condition)){
            echo TRUE;
        }else{
            echo FALSE;
        }       
    }
    
}
