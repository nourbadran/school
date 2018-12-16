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
                    $data = $this->_get_posted_discount_days_data($insert_id);
                    foreach($data as $d)
                    {
                        $this->payment->insert('discount_info', $d);
                    }
                    success($this->lang->line('insert_success'));
                    redirect('payroll/attendance/add/');
                } else {
                    error($this->lang->line('insert_failed'));
                    redirect('payroll/attendance/add/');
                }
            } else {
                $this->data['post'] = $_POST;
            }
        }
        $att_infos = $this->payment->get_list('attendance_info',array(),null,null,0,'id','desc');
        if ($att_infos && count($att_infos) > 0) {
            $att_info = $att_infos[0];
            $this->data['post'] = [
                'days_off' => $att_info->days_off,
                'working_days' => $att_info->working_days,
                'extra_days_off' => $att_info->extra_days_off,
            ];
            $this->data['dataFound'] = true;
            $discount_infos = $this->payment->get_list('discount_info',array('attendance_info_id'=>$att_info->id),null,null,0,'id','asc');
            $this->data['discount_infos'] = $discount_infos;
        }
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

        $this->form_validation->set_rules('working_days', $this->lang->line('working_days'), 'trim|required');
        $this->form_validation->set_rules('days_off', $this->lang->line('days_off'), 'trim|required');
        $this->form_validation->set_rules('extra_days_off', $this->lang->line('extra_days_off'), 'trim|required');
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

        $items[] = 'working_days';
        $items[] = 'days_off';
        $items[] = 'extra_days_off';
        $data = elements($items, $_POST);

        if ($this->input->post('id')) {
            
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['modified_by'] = logged_in_user_id();
            
        } else {

            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = logged_in_user_id(); 

        }

        return $data;
    }

    private function _get_posted_discount_days_data($attendance_info_id) {

        $data = array();

        $ar = $this->input->post('dayoffs');
        foreach( $ar as $a )
        {
            $d = array();
            $d['day_number'] = $a['day'];
            $d['price'] = $a['price'];
            $d['created_at'] = date('Y-m-d H:i:s');
            $d['created_by'] = logged_in_user_id();
            $d['attendance_info_id'] = $attendance_info_id;
            $data[] = $d;
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
