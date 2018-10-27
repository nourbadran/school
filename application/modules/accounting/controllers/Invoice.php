<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* * *****************Invoice.php**********************************
 * @product name    : Global Multi School Management System Express
 * @type            : Class
 * @class name      : Invoice
 * @description     : Manage invoice for all type of student payment.  
 * @author          : Codetroopers Team 	
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com	
 * @copyright       : Codetroopers Team	 	
 * ********************************************************** */

class Invoice extends MY_Controller {

    public $data = array();    
    
    function __construct() {
        
        parent::__construct();
         $this->load->model('Invoice_Model', 'invoice', true);
         $this->load->model('Payment_Model', 'payment', true);
    }

    
    
    /*****************Function index**********************************
    * @type            : Function
    * @function name   : index
    * @description     : Load "Invoice List" user interface                 
    *                        
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function index() {
        
        check_permission(VIEW);
        
        $condition = array();
        $condition['status'] = 1;        
        if($this->session->userdata('role_id') != SUPER_ADMIN){            
            $condition['school_id'] = $this->session->userdata('school_id');
            $this->data['classes'] = $this->invoice->get_list('classes', $condition, '','', '', 'id', 'ASC');
        }
        
         // default global income head
        $this->data['income_heads'] = $this->invoice->get_list('income_heads', array('status'=> 1, 'is_default'=>1));        
        $this->data['invoices'] = $this->invoice->get_invoice_list();  
         
        $this->data['list'] = TRUE;
        $this->layout->title($this->lang->line('manage_invoice'). ' | ' . SMS);
        $this->layout->view('invoice/index', $this->data);            
       
    }
    
    
    
    /*****************Function view**********************************
    * @type            : Function
    * @function name   : view
    * @description     : Load user interface with specific invoice data                 
    *                       
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    public function view($id = null) {
        
        check_permission(VIEW);
        
        if(!is_numeric($id)){
            error($this->lang->line('unexpected_error'));
            redirect('accounting/invoice/index');
        }
        
        $condition = array();
        $condition['status'] = 1;        
        if($this->session->userdata('role_id') != SUPER_ADMIN){            
            $condition['school_id'] = $this->session->userdata('school_id');
            $this->data['classes'] = $this->invoice->get_list('classes', $condition, '','', '', 'id', 'ASC');
        }
        
        // default global income head
        $this->data['income_heads'] = $this->invoice->get_list('income_heads', array('status'=> 1, 'is_default'=>1));        
        $this->data['invoices'] = $this->invoice->get_invoice_list(); 
         
       
        $invoice                = $this->payment->get_invoice_amount($id);
        
        $this->data['paid_amount'] = $invoice->paid_amount;
        $this->data['invoice'] = $this->invoice->get_single_invoice($id);
        $this->data['invoice_logs'] = $this->invoice->get_invoice_log_list($id); 
        $school_id = $this->data['invoice']->school_id;
        $this->data['school']   = $this->invoice->get_single('schools', array('status'=>1, 'id'=>$school_id));
        
        
        $this->data['list'] = TRUE;
        $this->layout->title($this->lang->line('view'). ' ' . $this->lang->line('invoice'). ' | ' . SMS);
        $this->layout->view('invoice/view', $this->data);            
       
    }
    
    
     /*****************Function due**********************************
    * @type            : Function
    * @function name   : due
    * @description     : Load "Due Invoice List" user interface                 
    *                        
    * @param           : null
    * @return          : null 
    * ***********************************************************/
    public function due() {    
        
        check_permission(VIEW);
              
        $this->data['invoices'] = $this->invoice->get_invoice_list('due');  
        
        $this->data['list'] = TRUE;
        $this->layout->title($this->lang->line('due_invoice'). ' | ' . SMS);
        $this->layout->view('invoice/due', $this->data);            
       
    }

    
    /*****************Function add**********************************
    * @type            : Function
    * @function name   : add
    * @description     : Load "Create new Invoice" user interface                 
    *                    and store "Invoice" data into database 
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function add() {

        check_permission(ADD);
        
        if ($_POST) {
            $this->_prepare_invoice_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_invoice_data();

                $insert_id = $this->invoice->insert('invoices', $data);
                if ($insert_id) {   
                    
                    success($this->lang->line('insert_success'));
                    redirect('accounting/invoice/index');
                } else {
                    error($this->lang->line('insert_failed'));
                    redirect('accounting/invoice/add');
                }
            } else {
                $this->data['post'] = $_POST;
            }
        }

        $condition = array();
        $condition['status'] = 1;        
        if($this->session->userdata('role_id') != SUPER_ADMIN){            
            $condition['school_id'] = $this->session->userdata('school_id');
            $this->data['classes'] = $this->invoice->get_list('classes', $condition, '','', '', 'id', 'ASC');
        }
        
        // default global income head
        $this->data['income_heads'] = $this->invoice->get_list('income_heads', array('status'=> 1, 'is_default'=>1));        
        $this->data['invoices'] = $this->invoice->get_invoice_list(); 
          
        
        $this->data['add'] = TRUE;
        $this->layout->title($this->lang->line('create'). ' ' . $this->lang->line('invoice'). ' | ' . SMS);
        $this->layout->view('invoice/index', $this->data);
    }

        
    /*****************Function bulk**********************************
    * @type            : Function
    * @function name   : bulk
    * @description     : Load "Create new bulk Invoice" user interface                 
    *                    and store "Invoice" data into database 
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function bulk() {

        check_permission(ADD);
        
        if ($_POST) {
           
            $this->_prepare_invoice_validation();           
            if ($this->form_validation->run() === TRUE) {
               
                $status = $this->_get_create_bulk_invoice();
                if ($status) {
                    success($this->lang->line('insert_success'));
                    redirect('accounting/invoice/index');
                    
                } else {                  
                    error($this->lang->line('insert_failed'));
                    redirect('accounting/invoice/bulk');
                }
            } else {
                $this->data['post'] = $_POST;
            }
        }

        $condition = array();
        $condition['status'] = 1;        
        if($this->session->userdata('role_id') != SUPER_ADMIN){            
            $condition['school_id'] = $this->session->userdata('school_id');
            $this->data['classes'] = $this->invoice->get_list('classes', $condition, '','', '', 'id', 'ASC');
        }
        
        // default global income head
        $this->data['income_heads'] = $this->invoice->get_list('income_heads', array('status'=> 1, 'is_default'=>1));        
        $this->data['invoices'] = $this->invoice->get_invoice_list(); 
          
        
        $this->data['bulk'] = TRUE;
        $this->layout->title($this->lang->line('create'). ' ' . $this->lang->line('invoice'). ' | ' . SMS);
        $this->layout->view('invoice/index', $this->data);
    }

    
    /*****************Function edit**********************************
    * @type            : Function
    * @function name   : edit
    * @description     : Load Update "Invoice" user interface                 
    *                    with populated "Invoice" value 
    *                    and update "Invoice" database    
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    public function edit($id = null) {       
       
        check_permission(EDIT);
        
        if(!is_numeric($id)){
            error($this->lang->line('unexpected_error'));
             redirect('accounting/invoice/index');
        }
        
        if ($_POST) {
            $this->_prepare_invoice_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_invoice_data();
                $updated = $this->invoice->update('invoices', $data, array('id' => $this->input->post('id')));

                if ($updated) {
                    success($this->lang->line('update_success'));
                    redirect('accounting/invoice/index');                   
                } else {
                    error($this->lang->line('update_failed'));
                    redirect('accounting/invoice/edit/' . $this->input->post('id'));
                }
            } else {
                 $this->data['invoice'] = $this->invoice->get_single('invoices', array('id' => $this->input->post('id')));
            }
        }
        
        if ($id) {
            $this->data['invoice'] = $this->invoice->get_single('invoices', array('id' => $id));

            if (!$this->data['invoice']) {
                 redirect('accounting/invoice/index');
            }
        }
        
        $condition = array();
        $condition['status'] = 1;        
        if($this->session->userdata('role_id') != SUPER_ADMIN){            
            $condition['school_id'] = $this->session->userdata('school_id');
            $this->data['classes'] = $this->invoice->get_list('classes', $condition, '','', '', 'id', 'ASC');
        }
        
        // default global income head
        $this->data['income_heads'] = $this->invoice->get_list('income_heads', array('status'=> 1, 'is_default'=>1));        
        $this->data['invoices'] = $this->invoice->get_invoice_list(); 
        
        $this->data['school_id'] = $this->data['invoice']->school_id;

        $this->data['edit'] = TRUE;       
        $this->layout->title($this->lang->line('edit'). ' ' . $this->lang->line('invoice'). ' | ' . SMS);
        $this->layout->view('invoice/index', $this->data);
    }

    
    /*****************Function _prepare_invoice_validation**********************************
    * @type            : Function
    * @function name   : _prepare_invoice_validation
    * @description     : Process "Invoice" user input data validation                 
    *                       
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    private function _prepare_invoice_validation() {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error-message" style="color: red;">', '</div>');
        
        $this->form_validation->set_rules('school_id', $this->lang->line('school'), 'trim|required');               
        $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required');               
        $this->form_validation->set_rules('student_id', $this->lang->line('student_id'), 'trim|required');  
        $this->form_validation->set_rules('is_applicable_discount', $this->lang->line('is_applicable_discount'), 'trim|required');   
        $this->form_validation->set_rules('month', $this->lang->line('month'), 'trim|required');   
        
       
        $status = FALSE;
        
        if($this->input->post('hostel_fee')){
             $status = TRUE;
        }
        if($this->input->post('transport_fee')){
             $status = TRUE;
        }
        if($this->input->post('certificate_fee')){
             $status = TRUE;
        }
        if($this->input->post('exam_fee')){
             $status = TRUE;
        }
        if($this->input->post('monthly_fee')){
             $status = TRUE;
        }
        if($this->input->post('admission_fee')){
             $status = TRUE;
        }
        
        if(!$status){
            $this->form_validation->set_rules('student_fee', '','required', array('required' => $this->lang->line('check_at_least_one')));
        }
        
    }


    
    /*****************Function _get_posted_invoice_data**********************************
     * @type            : Function
     * @function name   : _get_posted_invoice_data
     * @description     : Prepare "Invoice" user input data to save into database                  
     *                       
     * @param           : null
     * @return          : $data array(); value 
     * ********************************************************** */
    private function _get_posted_invoice_data() {

        $items = array();
        $items[] = 'school_id';
        $items[] = 'income_head_id';
        $items[] = 'class_id';
        $items[] = 'student_id';
        $items[] = 'is_applicable_discount';        
        $items[] = 'amount';        
        $items[] = 'month';        
        $items[] = 'note';
        $data = elements($items, $_POST);          
        
        $data['date'] = date('Y-m-d');
    
        if ($this->input->post('id')) {
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['modified_by'] = logged_in_user_id();
        } else {
            $data['custom_invoice_id'] = $this->invoice->get_custom_id('invoices', 'INV');
            $data['paid_status'] = 'unpaid';
            $data['status'] = 1;
            $data['invoice_type'] = 'academic';
            $data['academic_year_id'] = $this->academic_year_id;
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = logged_in_user_id();                       
        }

        return $data;
    }

        /*****************Function _get_create_bulk_invoice**********************************
     * @type            : Function
     * @function name   : _get_create_bulk_invoice
     * @description     : Prepare "Invoice" user input data to save into database                  
     *                       
     * @param           : null
     * @return          : $data array(); value 
     * ********************************************************** */
    private function _get_create_bulk_invoice() {
        
        $data = array();
       
        $data['paid_status'] = 'unpaid';
        $data['status'] = 1;
        $data['invoice_type'] = 'academic';
        $data['school_id'] = $this->input->post('school_id');
        $data['academic_year_id'] = $this->academic_year_id;
        $data['month'] = $this->input->post('payment_month');
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['created_by'] = logged_in_user_id();            
        $data['date'] = date('Y-m-d');
        
        
        // need to get student list by class id 
       $is_applicable_discount = $this->input->post('is_applicable_discount') ? $this->input->post('is_applicable_discount') : 0;       
       $hostel_fee      = $this->input->post('hostel_fee') ? $this->input->post('hostel_fee') : '';       
       $transport_fee   = $this->input->post('transport_fee') ? $this->input->post('transport_fee') : ''; 
       
       $certificate_fee = $this->input->post('certificate_fee') ? $this->input->post('certificate_fee') : ''; 
       $exam_fee        = $this->input->post('exam_fee') ? $this->input->post('exam_fee') : ''; 
       $monthly_fee     = $this->input->post('monthly_fee') ? $this->input->post('monthly_fee') : ''; 
       $admission_fee   = $this->input->post('admission_fee') ? $this->input->post('admission_fee') : ''; 
       
       $class_id = $this->input->post('class_id');       
       $student_id = $this->input->post('student_id');   
       
       $class = $this->invoice->get_single('classes', array('id' => $class_id));
       $students = $this->invoice->get_student_list($class_id, $student_id);
       
       if(!empty($students)){
                    
           foreach($students as $obj ){
               
               $discount = 0.00;
               $total_amount = 0.00;
               
               // save invoice data
               $data['custom_invoice_id'] = $this->invoice->get_custom_id('invoices', 'INV');
               $data['student_id'] = $obj->id;
               $data['class_id'] = $class_id;
               $data['discount'] = $discount;
               $data['gross_amount'] = $total_amount;
               $data['net_amount'] = $total_amount;
               $data['is_applicable_discount'] = $is_applicable_discount;
               $invoice_id = $this->invoice->insert('invoices', $data);
               
               $logs = array();
               $logs['school_id'] = $data['school_id'];
               $logs['invoice_id'] = $invoice_id;
               $logs['invoice_id'] = $invoice_id;
               $logs['created_at'] = $data['created_at'];
               $logs['created_by'] = $data['created_by'];
               $logs['status'] = $data['status'];
               
               if($hostel_fee != '' && $obj->is_hostel_member == 1){ 
                 
                    $hostel_cost = $this->invoice->get_student_hostel_cost($obj->user_id);
                    $total_amount +=  $hostel_cost->cost;  
                    $logs['amount'] = $hostel_cost->cost;
                    $logs['income_head_id'] = $hostel_fee;
                    $this->invoice->insert('invoice_logs', $logs);
               }
               
               if($transport_fee != '' && $obj->is_transport_member == 1){
                   
                    $transport_fare = $this->invoice->get_student_transport_fare($obj->user_id);
                    $total_amount +=  $transport_fare->fare;  
                    $logs['amount'] = $transport_fare->fare;
                    $logs['income_head_id'] = $transport_fee;
                    $this->invoice->insert('invoice_logs', $logs);
               }
               
               if($certificate_fee != '' ){
                   
                    $total_amount +=  $class->certificate_fee;  
                    $logs['amount'] = $class->certificate_fee;
                    $logs['income_head_id'] = $certificate_fee;
                    $this->invoice->insert('invoice_logs', $logs);
               }
               
               if($exam_fee != '' ){
                   
                    $total_amount +=  $class->exam_fee;
                    $logs['amount'] = $class->exam_fee;
                    $logs['income_head_id'] = $exam_fee;
                    $this->invoice->insert('invoice_logs', $logs);
               }
               
               if($monthly_fee != ''){
                   
                    $total_amount +=  $class->monthly_tution_fee;
                    $logs['amount'] = $class->monthly_tution_fee;
                    $logs['income_head_id'] = $monthly_fee;
                    $this->invoice->insert('invoice_logs', $logs);
               }
               
               if($admission_fee != ''){
                   
                    $total_amount +=  $class->admission_fee;
                    $logs['amount'] = $class->admission_fee;
                    $logs['income_head_id'] = $admission_fee;
                    $this->invoice->insert('invoice_logs', $logs);
               }
               
               if($is_applicable_discount == 1){
                  $discount =  $obj->discount/100*$total_amount;
               }
               
               // update invoice amount and discount data after calculate 
               $update = array();
               $update['discount'] = $discount;
               $update['gross_amount']   = $total_amount;
               $update['net_amount']   = $total_amount - $discount;
               $this->invoice->update('invoices', $update, array('id' => $invoice_id));          
               
           }
       }
        return TRUE;
    }

    
    /*****************Function delete**********************************
    * @type            : Function
    * @function name   : delete
    * @description     : delete "Invoice" from database                  
    *                       
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    public function delete($id = null) {
        
        check_permission(DELETE);
        if(!is_numeric($id)){
            error($this->lang->line('unexpected_error'));
             redirect('accounting/invoice/index');
        } 
                
        if ($this->invoice->delete('invoices', array('id' => $id))) {  
            
            $this->invoice->delete('invoice_logs', array('invoice_id' => $id));
            success($this->lang->line('delete_success'));
        } else {
            error($this->lang->line('delete_failed'));
        }
        
        redirect('accounting/invoice/index');
    }
   
}
