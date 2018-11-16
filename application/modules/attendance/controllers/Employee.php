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
        $this->load->library('excel');
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
                $path = $_FILES["file"]["tmp_name"];
                $object = PHPExcel_IOFactory::load($path);
                //foreach($object->getWorksheetIterator() as $worksheet)
                $worksheet = $object->getSheet(0);
                {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    $emp_id0 = 0;//default value
                    $data0 = array();
                    for($row=1; $row<=$highestRow; $row++)
                    {
                        $emp_id = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $date = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $dateValue = 'P' ; //By default
                        $isAbsent = $worksheet->getCellByColumnAndRow(15, $row)->getValue();
                        $isLate = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
                        if ( strtolower($isAbsent) == 'true' ) {
                            $dateValue = 'A';
                        }
                        elseif( $isLate )
                        {
                            $dateValue = 'L';
                        }
                        $dayNumber = 1;
                        $month = 1;
                        $year = 1;
                        $ar = explode('/', $date);
                        if (count($ar)==3) {
                            $dayNumber = (int)$ar[0];
                            $month = (int)$ar[1];
                            $year = (int)$ar[2];
                        }
                        else
                        {
                            continue;
                        }
                        if ($emp_id0 != $emp_id || $emp_id0 == 0 ) {
                            if ($emp_id0 > 0) {
                                $this->employee->insert('employee_attendances', $data0);
                            }
                            $data0 = array();
                            $emp_id0 = $emp_id;
                            //after save
                            $data0['academic_year_id'] = $this->academic_year_id; 
                            $data0['employee_id'] = $emp_id; 
                            $data0['school_id'] =  $this->session->userdata('school_id');; 
                            $data0['month'] = $month; 
                            $data0['year'] = $year; 
                            $data0['status'] = 1;
                            $data0['created_at'] = date('Y-m-d H:i:s');
                            $data0['created_by'] = logged_in_user_id();
                            $data0['day_'.$dayNumber] = $dateValue; 
                        }
                        else
                        {
                            $data0['day_'.$dayNumber] = $dateValue; 
                        }
                    }

                }

            }
            $this->layout->view('employee/index', $this->data);
        }

        $this->layout->title($this->lang->line('employee'). ' ' . $this->lang->line('attendance'). ' | ' . SMS);
        $this->layout->view('employee/import', $this->data);
    }

    public function export($date='',$school_id='')
    {
        $date = $this->input->get('date', TRUE);
        $school_id = $this->input->get('school_id', TRUE);
        // create file name
        $fileName = 'data-'.time().'.xlsx';  

        $employees = $this->employee->get_employee_list($school_id);   
        $month      = date('m', strtotime($date));
        $year       = date('Y', strtotime($date));       
        $day        = date('d', strtotime($date));  
        $result = array();
        $i=0;
        foreach( $employees as $e )
        {
            $attendance = get_employee_attendance($e->id, $school_id, $this->academic_year_id, $year, $month, $day );
            if ($attendance == 'A') {
                $attendance =  $this->lang->line('absent');
            }
            if ($attendance == 'P') {
                $attendance =  $this->lang->line('present');
            }
            if ($attendance == 'L') {
                $attendance =  $this->lang->line('late');
            }
            $r = array();
            $r['sl_no'] = ++$i;
            $r['name'] = $e->name;
            $r['designation'] = $e->designtion;
            $r['phone'] = $e->phone;
            $r['email'] = $e->email;
            $r['attendance'] =$attendance;
            $result[] = $r;
        }
        
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', $this->lang->line('sl_no'));
        $objPHPExcel->getActiveSheet()->SetCellValue('B1',$this->lang->line('name'));
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', $this->lang->line('designation'));
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', $this->lang->line('phone'));
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', $this->lang->line('email'));  
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', $this->lang->line('date'));  
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', $this->lang->line('attendance'));        
        // set Row
        $rowCount = 2;
        foreach ($result as $element) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $element['sl_no']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['designation']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['phone']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element['email']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $date);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $element['attendance']);
            $rowCount++;
        }
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save($fileName);
        // download file
        header("Content-Type: application/vnd.ms-excel");
        redirect(site_url().$fileName);     
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
