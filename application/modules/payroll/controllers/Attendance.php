<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* * *****************Payment.php**********************************
 * @product name    : Global Multi School Management System Express
 * @type            : Class
 * @class name      : Payment
 * @description     : Manage Employee and Teacher Salary.  
 * @author          : Codetroopers Team 	
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com	
 * @copyright       : Codetroopers Team	 	
 * ********************************************************** */

class Attendance extends MY_Controller {

    public $data = array();
    
    
    function __construct() {
        parent::__construct();
         $this->load->model('Attendance_Model', 'payment', true);
    }



    
     /*****************Function add**********************************
     * @type            : Function
     * @function name   : add
     * @description     : Load "Add new Payment" user interface                 
     *                    and store "Payment" into database 
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    public function add() {
        

        
        if ($_POST) {

            $this->_prepare_dayoff_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_dayoff_data();

                $insert_id = $this->payment->insert('attendance_info', $data);
                if ($insert_id) {

                    success($this->lang->line('insert_success'));
                    redirect('payroll/attendance/add/');
                } else {
                    error($this->lang->line('insert_failed'));
                    redirect('payroll/attendance/add/');
                }
            } else {

                error($this->lang->line('operation_failed'));
                redirect('payroll/attendance/add/');
            }
        }


        $this->data['employees'] = $this->payment->get_list('employees', array('status'=> 1, ));

        $this->data['add'] = TRUE;
        $this->layout->title($this->lang->line('add'). ' ' . $this->lang->line('attendance') .  $this->lang->line('info') . ' | ' . SMS);
        $this->layout->view('attendance/index', $this->data);
    }


    
     /*****************Function _prepare_payment_validation**********************************
     * @type            : Function
     * @function name   : _prepare_payment_validation
     * @description     : Process "payment" user input data validation                 
     *                       
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    private function _prepare_dayoff_validation() {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error-message" style="color: red;">', '</div>');
        
        $this->form_validation->set_rules('employee_id', $this->lang->line('employee'), 'trim|required');
        $this->form_validation->set_rules('info_month', $this->lang->line('month'), 'trim|required|callback_salary_month');
        $this->form_validation->set_rules('working_days', $this->lang->line('working_days'), 'trim|required');
        $this->form_validation->set_rules('days_off', $this->lang->line('days_off'), 'trim|required');
        $this->form_validation->set_rules('extra_days_off', $this->lang->line('extra_days_off'), 'trim|required');
        $this->form_validation->set_rules('total_discount', $this->lang->line('note'), 'trim');
    }
    
    
     /*****************Function salary_month**********************************
     * @type            : Function
     * @function name   : salary_month
     * @description     : Unique check for "Salary payment" data/value                  
     *                       
     * @param           : null
     * @return          : boolean true/false 
     * ********************************************************** */  
   public function salary_month()
   {             
      if($this->input->post('id') == '')
      {   
          $payment = $this->payment->duplicate_check($this->input->post('salary_month'), $this->input->post('user_id')); 
          if($payment){
                $this->form_validation->set_message('salary_month',  $this->lang->line('already_exist'));         
                return FALSE;
          } else {
              return TRUE;
          }          
      }else if($this->input->post('id') != ''){   
         $payment = $this->payment->duplicate_check($this->input->post('salary_month'), $this->input->post('user_id'), $this->input->post('id')); 
          if($payment){
                $this->form_validation->set_message('salary_month', $this->lang->line('already_exist'));         
                return FALSE;
          } else {
              return TRUE;
          }
      }   
   }


     /*****************Function _get_posted_payment_data**********************************
     * @type            : Function
     * @function name   : _get_posted_payment_data
     * @description     : Prepare "payment" user input data to save into database                  
     *                       
     * @param           : null
     * @return          : $data array(); value 
     * ********************************************************** */
    private function _get_posted_dayoff_data() {

        $items = array();
        $items[] = 'employee_id';
        $items[] = 'working_days';
        $items[] = 'days_off';
        $items[] = 'extra_days_off';
        $items[] = 'info_month';
        //$data['dayoffs'] = $this->input->post('dayoffs');
        $data = elements($items, $_POST);
        $ar = $this->input->post('dayoffs');
        $totalDiscount = 0;
        foreach( $ar as $a )
        {
            $totalDiscount += $a['price'];
        }
        $data['total_discount'] = $totalDiscount;
        if ($this->input->post('id')) {
            
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['modified_by'] = logged_in_user_id();
            
        } else {

            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = logged_in_user_id(); 

        }

        return $data;
    }

    
    /*****************Function delete**********************************
     * @type            : Function
     * @function name   : delete
     * @description     : delete "Salary Payment and Expenditure amount as Salary" from database                  
     *                       
     * @param           : $id integer value
     * @return          : null 
     * ********************************************************** */
    public function delete($id = null) {
        
        check_permission(DELETE);
        
        if(!is_numeric($id)){
            error($this->lang->line('unexpected_error'));
            redirect('payroll/payment/index');
        }
        
        $payment = $this->payment->get_single('salary_payments', array('id' => $id));
        
        if ($this->payment->delete('salary_payments', array('id' => $id))) {

            $this->payment->delete('expenditures', array('id' => $payment->expenditure_id)); 
            success($this->lang->line('delete_success'));
            
        } else {
            error($this->lang->line('delete_failed'));
        }
        redirect('payroll/payment/index/'.$payment->user_id);
    } 
    
    
    
     /*****************Function get_single_payment**********************************
     * @type            : Function
     * @function name   : get_single_payment
     * @description     : "Load single salary payment information" from database                  
     *                    to the user interface   
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    public function get_single_payment(){
        
       $payment_id = $this->input->post('payment_id');
       $payment_to = $this->input->post('payment_to');
       
       $this->data['payment'] = $this->payment->get_single_payment($payment_id, $payment_to);
       echo $this->load->view('get-single-payment', $this->data);
    }
    
    
    /*****************Function history**********************************
     * @type            : Function
     * @function name   : history
     * @description     : Load "Employee & Teacher Payment History" user interface                 
     *                    
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    
    public function history_xx() {
        
        check_permission(VIEW);
        
        $this->data['users'] = '';
        
         if ($_POST) {
             
            $payment_to  = $this->input->post('payment_to');
            $user_id  = $this->input->post('user_id');
        
            $this->data['payment_to'] = $payment_to;
            $this->data['user_id'] = $user_id;
            
            $this->data['payments'] = $this->payment->get_payment_list($user_id, $payment_to);
            
         }
        
        $this->data['list'] = TRUE;       
        $this->layout->title( $this->lang->line('manage_payment'). ' | ' . SMS);
        $this->layout->view('payment/history', $this->data);            
       
    }

   
}
