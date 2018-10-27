<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* * *****************Report.php**********************************
 * @product name    : Global Multi School Management System Express
 * @type            : Class
 * @class name      : Report
 * @description     : Manage all reports of the system.  
 * @author          : Codetroopers Team 	
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com	
 * @copyright       : Codetroopers Team	 	
 * ********************************************************** */

class Report extends My_Controller {

    public $data = array();
    public $date_from = '';
    public $date_to = '';

    public function __construct() {
        parent::__construct();
        
        $this->load->model('Report_Model', 'report', true);
        $this->load->helper('report');
        $this->data['academic_years'] = $this->report->get_list('academic_years', array('status' => 1));

        $this->date_from = date('Y-m-01');
        $this->date_to = date('Y-m-t');
    }

        
    /*****************Function income**********************************
    * @type            : Function
    * @function name   : income
    * @description     : Load Income report user interface                 
    *                    with various filtering options
    *                    and process to load income report   
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function income() {

        check_permission(VIEW);

        if ($_POST) {

            $school_id = $this->input->post('school_id');
            $academic_year_id = $this->input->post('academic_year_id');
            $group_by = $this->input->post('group_by');

            if ($group_by == 'daily') {
                $date_from = $this->input->post('date_from') ? date('Y-m-d', strtotime($this->input->post('date_from'))) : $this->date_from;
                $date_to = $this->input->post('date_to') ? date('Y-m-d', strtotime($this->input->post('date_to'))) : $this->date_to;
            } else {
                $date_from = '';
                $date_to = '';
            }

            $this->data['school_id'] = $school_id;
            $this->data['academic_year_id'] = $academic_year_id;
            $this->data['group_by'] = $group_by;
            $this->data['date_from'] = $date_from;
            $this->data['date_to'] = $date_to;

            $this->data['income'] = $this->report->get_income_report($school_id, $academic_year_id, $group_by, $date_from, $date_to);
        }

        $this->layout->title($this->lang->line('income') . ' ' . $this->lang->line('report') . ' | ' . SMS);
        $this->layout->view('income/index', $this->data);
    }

    
    
        
    /*****************Function expenditure**********************************
    * @type            : Function
    * @function name   : expenditure
    * @description     : Load expenditure report user interface                 
    *                    with various filtering options
    *                    and process to load expenditure report   
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function expenditure() {

        check_permission(VIEW);

        if ($_POST) {

            $school_id = $this->input->post('school_id');
            $academic_year_id = $this->input->post('academic_year_id');
            $group_by = $this->input->post('group_by');

            if ($group_by == 'daily') {
                $date_from = $this->input->post('date_from') ? date('Y-m-d', strtotime($this->input->post('date_from'))) : $this->date_from;
                $date_to = $this->input->post('date_to') ? date('Y-m-d', strtotime($this->input->post('date_to'))) : $this->date_to;
            } else {
                $date_from = '';
                $date_to = '';
            }

            $this->data['school_id'] = $school_id;
            $this->data['academic_year_id'] = $academic_year_id;
            $this->data['group_by'] = $group_by;
            $this->data['date_from'] = $date_from;
            $this->data['date_to'] = $date_to;

            $this->data['expenditure'] = $this->report->get_expenditure_report($school_id, $academic_year_id, $group_by, $date_from, $date_to);
        }

        $this->layout->title($this->lang->line('expenditure') . ' ' . $this->lang->line('report') . ' | ' . SMS);
        $this->layout->view('expenditure/index', $this->data);
    }

    
        
        
    /*****************Function invoice**********************************
    * @type            : Function
    * @function name   : invoice
    * @description     : Load invoice report user interface                 
    *                    with various filtering options
    *                    and process to load invoice report   
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function invoice() {

        check_permission(VIEW);

        if ($_POST) {

            $school_id = $this->input->post('school_id');
            $academic_year_id = $this->input->post('academic_year_id');
            $group_by = $this->input->post('group_by');

            if ($group_by == 'daily') {
                $date_from = $this->input->post('date_from') ? date('Y-m-d', strtotime($this->input->post('date_from'))) : $this->date_from;
                $date_to = $this->input->post('date_to') ? date('Y-m-d', strtotime($this->input->post('date_to'))) : $this->date_to;
            } else {

                $date_from = '';
                $date_to = '';
            }

            $this->data['school_id'] = $school_id;
            $this->data['academic_year_id'] = $academic_year_id;
            $this->data['group_by'] = $group_by;
            $this->data['date_from'] = $date_from;
            $this->data['date_to'] = $date_to;

            $this->data['invoice'] = $this->report->get_invoice_report($school_id, $academic_year_id, $group_by, $date_from, $date_to);
        }

        $this->layout->title($this->lang->line('invoice') . ' ' . $this->lang->line('report') . ' | ' . SMS);
        $this->layout->view('invoice/index', $this->data);
    }

            
        
    /*****************Function balance**********************************
    * @type            : Function
    * @function name   : balance
    * @description     : Load balance report user interface                 
    *                    with various filtering options
    *                    and process to load balance report   
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function balance() {

        check_permission(VIEW);

        if ($_POST) {

            $school_id = $this->input->post('school_id');
            $academic_year_id = $this->input->post('academic_year_id');
            $group_by = $this->input->post('group_by');

            if ($group_by == 'daily') {
                $date_from = $this->input->post('date_from') ? date('Y-m-d', strtotime($this->input->post('date_from'))) : $this->date_from;
                $date_to = $this->input->post('date_to') ? date('Y-m-d', strtotime($this->input->post('date_to'))) : $this->date_to;
            } else {

                $date_from = '';
                $date_to = '';
            }

            $this->data['school_id'] = $school_id;
            $this->data['academic_year_id'] = $academic_year_id;
            $this->data['group_by'] = $group_by;
            $this->data['date_from'] = $date_from;
            $this->data['date_to'] = $date_to;


            if ($group_by == 'daily') {
                $this->data['balance'] = $this->_get_daily_balance_data($school_id, $date_from, $date_to);
            } else {
                $this->data['expenditure'] = $this->report->get_expenditure_report($school_id,$academic_year_id, $group_by, $date_from, $date_to);
                $this->data['income'] = $this->report->get_income_report($school_id, $academic_year_id, $group_by, $date_from, $date_to);
                $this->data['balance'] = $this->_combine_balance_data($this->data['expenditure'], $this->data['income']);
            }
        }

        $this->layout->title($this->lang->line('balance') . ' ' . $this->lang->line('report') . ' | ' . SMS);
        $this->layout->view('balance/index', $this->data);
    }

    /*****************Function _get_daily_balance_data**********************************
    * @type            : Function
    * @function name   : _get_daily_balance_data
    * @description     : format the daily balanace report data for user friendly data presentation                
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    private function _get_daily_balance_data($school_id, $date_from, $date_to) {

        $data = array();

        $days = date('d', strtotime($date_to));

        for ($i = 0; $i < $days; $i++) {

            $date = date('Y-m-d', strtotime($date_from . '+' . $i . ' day'));
            $data[$i]['expenditure'] = $this->report->get_expenditure_by_date($school_id, $date);
            $data[$i]['income'] = $this->report->get_income_by_date($school_id, $date);
            $data[$i]['group_by_field'] = date('M j, Y', strtotime($date));
        }

        return $data;
    }

        
                                        
    /*****************Function _combine_balance_data**********************************
    * @type            : Function
    * @function name   : _combine_balance_data
    * @description     : combined expenditure and income report data for user friendly data presentation                
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    private function _combine_balance_data($expenditure, $income) {
        $data = array();
        foreach ($expenditure as $obj) {
            $data[$obj->group_by_field]['expenditure'] = $obj->total_amount;
            $data[$obj->group_by_field]['group_by_field'] = $obj->group_by_field;
            if (empty($data[$obj->group_by_field]['income'])) {
                $data[$obj->group_by_field]['income'] = 0;
            }
        }
        foreach ($income as $obj) {
            $data[$obj->group_by_field]['income'] = $obj->total_amount;
            $data[$obj->group_by_field]['group_by_field'] = $obj->group_by_field;

            if (empty($data[$obj->group_by_field]['expenditure'])) {
                $data[$obj->group_by_field]['expenditure'] = 0;
            }
        }
        return $data;
    }

    
                
        
    /*****************Function library**********************************
    * @type            : Function
    * @function name   : library
    * @description     : Load library report user interface                 
    *                    with various filtering options
    *                    and process to load library report   
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function library() {

        check_permission(VIEW);

        if ($_POST) {

            $school_id = $this->input->post('school_id');
            $academic_year_id = $this->input->post('academic_year_id');
            $group_by = $this->input->post('group_by');

            if ($group_by == 'daily') {
                $date_from = $this->input->post('date_from') ? date('Y-m-d', strtotime($this->input->post('date_from'))) : $this->date_from;
                $date_to = $this->input->post('date_to') ? date('Y-m-d', strtotime($this->input->post('date_to'))) : $this->date_to;
            } else {

                $date_from = '';
                $date_to = '';
            }

            $this->data['school_id'] = $school_id;
            $this->data['academic_year_id'] = $academic_year_id;
            $this->data['group_by'] = $group_by;
            $this->data['date_from'] = $date_from;
            $this->data['date_to'] = $date_to;

            $this->data['library'] = $this->report->get_library_report($school_id, $academic_year_id, $group_by, $date_from, $date_to);
  
        }

        $this->layout->title($this->lang->line('library') . ' ' . $this->lang->line('report') . ' | ' . SMS);
        $this->layout->view('library/index', $this->data);
    }

    
            
    /*****************Function sattendance**********************************
    * @type            : Function
    * @function name   : sattendance
    * @description     : Load student attendance report user interface                 
    *                    with various filtering options
    *                    and process to load student attendance report   
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function sattendance() {

        check_permission(VIEW);

        $this->data['month_number'] = 1;
        $session = $this->report->get_single('academic_years', array('is_running' => 1));

        if ($_POST) {

            $school_id = $this->input->post('school_id');
            $academic_year_id = $this->input->post('academic_year_id');
            $class_id = $this->input->post('class_id');
            $section_id = $this->input->post('section_id');
            $month = $this->input->post('month');


            $this->data['school_id'] = $school_id;
            $this->data['academic_year_id'] = $academic_year_id;
            $this->data['class_id'] = $class_id;
            $this->data['section_id'] = $section_id;
            $this->data['month'] = $month;
            $this->data['month_number'] = date('m', strtotime($this->data['month']));
            $session = $this->report->get_single('academic_years', array('id' => $academic_year_id));

            $this->data['students'] = $this->report->get_student_list($school_id, $academic_year_id, $class_id, $section_id);
        }


        $this->data['year'] = substr($session->session_year, 7);
        $this->data['days'] = cal_days_in_month(CAL_GREGORIAN, $this->data['month_number'], $this->data['year']);

        $condition = array();
        $condition['status'] = 1;        
        if($this->session->userdata('role_id') != SUPER_ADMIN){            
            $condition['school_id'] = $this->session->userdata('school_id');  
            $this->data['classes'] = $this->report->get_list('classes', $condition);
        }
        

        $this->layout->title($this->lang->line('student') . ' ' . $this->lang->line('attendance') . ' ' . $this->lang->line('report') . ' | ' . SMS);
        $this->layout->view('sattendance/index', $this->data);
    }

                
    /*****************Function syattendance**********************************
    * @type            : Function
    * @function name   : syattendance
    * @description     : Load student yearly attendance report user interface                 
    *                    with various filtering options
    *                    and process to load student yearly attendance report   
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function syattendance() {

        check_permission(VIEW);

        if ($_POST) {

            $school_id = $this->input->post('school_id');
            $academic_year_id = $this->input->post('academic_year_id');
            $class_id = $this->input->post('class_id');
            $section_id = $this->input->post('section_id');
            $student_id = $this->input->post('student_id');

            $this->data['school_id'] = $school_id;
            $this->data['academic_year_id'] = $academic_year_id;
            $this->data['class_id'] = $class_id;
            $this->data['section_id'] = $section_id;
            $this->data['student_id'] = $student_id;
        }


        $this->data['days'] = 31;

        $condition = array();
        $condition['status'] = 1;        
        if($this->session->userdata('role_id') != SUPER_ADMIN){            
            $condition['school_id'] = $this->session->userdata('school_id');  
            $this->data['classes'] = $this->report->get_list('classes', $condition);
        }

        $this->layout->title($this->lang->line('student') . ' ' . $this->lang->line('attendance') . ' ' . $this->lang->line('report') . ' | ' . SMS);
        $this->layout->view('sattendance/yearly', $this->data);
    }

                    
    /*****************Function tattendance**********************************
    * @type            : Function
    * @function name   : tattendance
    * @description     : Load teacher attendance report user interface                 
    *                    with various filtering options
    *                    and process to load teacher attendance report   
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function tattendance() {

        check_permission(VIEW);

        $session = $this->report->get_single('academic_years', array('is_running' => 1));
        $this->data['month_number'] = 1;
        if ($_POST) {

            $school_id = $this->input->post('school_id');
            $academic_year_id = $this->input->post('academic_year_id');
            $month = $this->input->post('month');

            $this->data['school_id'] = $school_id;
            $this->data['academic_year_id'] = $academic_year_id;
            $this->data['month'] = $month;
            $this->data['month_number'] = date('m', strtotime($this->data['month']));
            
            $this->data['teachers'] = $this->report->get_list('teachers', array('status' => 1, 'school_id'=>$school_id));
            $session = $this->report->get_single('academic_years', array('id' => $academic_year_id));
        }


        $this->data['year'] = substr($session->session_year, 7);
        $this->data['days'] = cal_days_in_month(CAL_GREGORIAN, $this->data['month_number'], $this->data['year']);


        $this->layout->title($this->lang->line('teacher') . ' ' . $this->lang->line('attendance') . ' ' . $this->lang->line('report') . ' | ' . SMS);
        $this->layout->view('tattendance/index', $this->data);
    }

                        
    /*****************Function tyattendance**********************************
    * @type            : Function
    * @function name   : tyattendance
    * @description     : Load teacher yearly attendance report user interface                 
    *                    with various filtering options
    *                    and process to load teacher yearly attendance report   
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function tyattendance() {

        check_permission(VIEW);

        if ($_POST) {

            $school_id = $this->input->post('school_id');
            $academic_year_id = $this->input->post('academic_year_id');
            $teacher_id = $this->input->post('teacher_id');

            $this->data['school_id'] = $school_id;
            $this->data['academic_year_id'] = $academic_year_id;
            $this->data['teacher_id'] = $teacher_id;            
        }
        
        $condition = array();
        $condition['status'] = 1;        
        if($this->session->userdata('role_id') != SUPER_ADMIN){            
            $condition['school_id'] = $this->session->userdata('school_id');        
            $this->data['teachers'] = $this->report->get_list('teachers', $condition);
        } 
           
        
        $this->data['days'] = 31;

        $this->layout->title($this->lang->line('teacher') . ' ' . $this->lang->line('attendance') . ' ' . $this->lang->line('report') . ' | ' . SMS);
        $this->layout->view('tattendance/yearly', $this->data);
    }

                            
    /*****************Function eattendance**********************************
    * @type            : Function
    * @function name   : eattendance
    * @description     : Load Employee attendance report user interface                 
    *                    with various filtering options
    *                    and process to load Employee attendance report   
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function eattendance() {

        check_permission(VIEW);

        $session = $this->report->get_single('academic_years', array('is_running' => 1));
        $this->data['month_number'] = 1;
        if ($_POST) {

            $school_id = $this->input->post('school_id');
            $academic_year_id = $this->input->post('academic_year_id');
            $month = $this->input->post('month');

            $this->data['school_id'] = $school_id;
            $this->data['academic_year_id'] = $academic_year_id;
            $this->data['month'] = $month;
            $this->data['month_number'] = date('m', strtotime($this->data['month']));
            
            $this->data['employees'] = $this->report->get_list('employees', array('status' => 1, 'school_id'=>$school_id));            
            $session = $this->report->get_single('academic_years', array('id' => $academic_year_id));
        }

        $this->data['year'] = substr($session->session_year, 7);
        $this->data['days'] = cal_days_in_month(CAL_GREGORIAN, $this->data['month_number'], $this->data['year']);


        $this->layout->title($this->lang->line('employee') . ' ' . $this->lang->line('attendance') . ' ' . $this->lang->line('report') . ' | ' . SMS);
        $this->layout->view('eattendance/index', $this->data);
    }

                                
    /*****************Function eyattendance**********************************
    * @type            : Function
    * @function name   : eyattendance
    * @description     : Load Employee yearly attendance report user interface                 
    *                    with various filtering options
    *                    and process to load Employee yearly attendance report   
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function eyattendance() {

        check_permission(VIEW);

        if ($_POST) {

            $school_id = $this->input->post('school_id');
            $academic_year_id = $this->input->post('academic_year_id');
            $employee_id = $this->input->post('employee_id');

            $this->data['school_id'] = $school_id;
            $this->data['academic_year_id'] = $academic_year_id;
            $this->data['employee_id'] = $employee_id;
        }

        
        $condition = array();
        $condition['status'] = 1;        
        if($this->session->userdata('role_id') != SUPER_ADMIN){            
            $condition['school_id'] = $this->session->userdata('school_id');  
            $this->data['employees'] = $this->report->get_list('employees', $condition);
        } 
        
        $this->data['days'] = 31;

        $this->layout->title($this->lang->line('employee') . ' ' . $this->lang->line('attendance') . ' ' . $this->lang->line('report') . ' | ' . SMS);
        $this->layout->view('eattendance/yearly', $this->data);
    }
    
    
                                    
    /*****************Function student**********************************
    * @type            : Function
    * @function name   : student
    * @description     : Load student report user interface                 
    *                    with various filtering options
    *                    and process to load student report   
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function student(){
        
        check_permission(VIEW);

        if ($_POST) {

            $school_id = $this->input->post('school_id');
            $academic_year_id = $this->input->post('academic_year_id');
            $group_by = $this->input->post('group_by');           

            $this->data['school_id'] = $school_id;
            $this->data['academic_year_id'] = $academic_year_id;
            $this->data['group_by'] = $group_by;
            
            $this->data['students'] = $this->report->get_student_report($school_id, $academic_year_id, $group_by);
            $this->data['students'] = $this->_get_pormatted_student_report($school_id, $group_by, $this->data['students']);
   
        }

        $this->layout->title($this->lang->line('student') . ' ' . $this->lang->line('report') . ' | ' . SMS);
        $this->layout->view('student/index', $this->data);
    }
    
    
                                        
    /*****************Function _get_pormatted_student_report**********************************
    * @type            : Function
    * @function name   : _get_pormatted_student_report
    * @description     : Format the student report for better representation                 
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    private function _get_pormatted_student_report($school_id, $group_by,$students = null){
        
        $data = array();
        if(!empty($students)){
            foreach($students as $obj){
                
                $male = $this->report->get_student_by_gender($school_id, $group_by, $obj->class_id, $obj->academic_year_id, 'male');
                $obj->male = $male ? $male : 0;
                $female = $this->report->get_student_by_gender($school_id, $group_by, $obj->class_id, $obj->academic_year_id, 'female');
                $obj->female = $female ? $female : 0;
                $data[] = $obj;
            }
            
        }
        
        return $data;
    }
    
        
        
    /*****************Function payroll**********************************
    * @type            : Function
    * @function name   : payroll
    * @description     : Load payroll report user interface                 
    *                    with various filtering options
    *                    and process to load payroll report   
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function payroll() {

        check_permission(VIEW);

        if ($_POST) {

            $school_id = $this->input->post('school_id');
            $academic_year_id = $this->input->post('academic_year_id');
            $group_by = $this->input->post('group_by'); 
            $month = $this->input->post('month');
            $payment_to = $this->input->post('payment_to');
          
            
            $this->data['school_id'] = $school_id;
            $this->data['academic_year_id'] = $academic_year_id;
            $this->data['group_by'] = $group_by;
            $this->data['payment_to'] = $payment_to;          
            $this->data['month'] = $month;

            $this->data['payrolls'] = $this->report->get_payroll_report($school_id, $academic_year_id, $group_by, $payment_to, $month);
        }

        $this->layout->title($this->lang->line('payroll') . ' ' . $this->lang->line('report') . ' | ' . SMS);
        $this->layout->view('payroll/index', $this->data);
    }

    

}
