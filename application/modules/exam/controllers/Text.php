<?php

error_reporting(E_ALL);
defined('BASEPATH') OR exit('No direct script access allowed');

/* * *****************Text.php**********************************
 * @product name    : Global Multi School Management System Express
 * @type            : Class
 * @class name      : Text
 * @description     : Manage sms which are send to students and guardian with student exam mark.  
 * @author          : Codetroopers Team 	
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com	
 * @copyright       : Codetroopers Team	 	
 * ***********************************************************/

ini_set('max_execution_time', 9000);
ini_set('memory_limit', '960M');

class Text extends MY_Controller {

    public $data = array();

    function __construct() {
        parent::__construct();
        $this->load->model('Mark_Model', 'mark', true);        
        
        //$this->load->library('twilio');
        //$this->load->library('clickatell');
        //$this->load->library('bulk');
        //$this->load->library('msg91');
        //$this->load->library('plivo');
    }

    
    /*****************Function index**********************************
    * @type            : Function
    * @function name   : index
    * @description     : Load "SMS List" user interface                 
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
            $this->data['classes'] = $this->mark->get_list('classes', $condition, '','', '', 'id', 'ASC');
            $condition['academic_year_id'] = $this->academic_year_id;
            $this->data['exams'] = $this->mark->get_list('exams', $condition, '', '', '', 'id', 'ASC');
        } 
        
        $this->data['roles'] = $this->mark->get_list('roles', array('status' => 1), '', '', '', 'id', 'ASC');
        $this->data['mark_smses'] = $this->mark->get_mark_sms_list();
        
        $this->data['list'] = TRUE;
        $this->layout->title($this->lang->line('mark_send_by_sms') . ' | ' . SMS);
        $this->layout->view('sms/index', $this->data);
    }

    
    /*****************Function send**********************************
    * @type            : Function
    * @function name   : send
    * @description     : Process to sent SMS with student exam marks 
    *                    to the student/guardian                  
    *                       
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function send() {

        check_permission(ADD);

        if ($_POST) {
            
            $this->load->library('twilio');
            $this->load->library('clickatell');
            $this->load->library('bulk');
            $this->load->library('msg91');
            $this->load->library('plivo');
            
            $this->_prepare_sms_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_sms_data();

                $insert_id = $this->mark->insert('mark_smses', $data);
                if ($insert_id) {
                    $this->_send_sms($data);
                    success($this->lang->line('sms_send_success'));
                    redirect('exam/text');
                } else {
                    error($this->lang->line('sms_send_failed'));
                    redirect('exam/text');
                }
            } else {
                error($this->lang->line('fill_out_all_data'));
                redirect('exam/text');
            }
        } else {
            error($this->lang->line('unexpected_error'));
            redirect('exam/text');
        }
    }

    
    /*****************Function _prepare_sms_validation**********************************
    * @type            : Function
    * @function name   : _prepare_sms_validation
    * @description     : Process "SMS" user input data validation                 
    *                       
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    private function _prepare_sms_validation() {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error-message" style="color: red;">', '</div>');

        $this->form_validation->set_rules('school_id', $this->lang->line('school'), 'trim|required');
        $this->form_validation->set_rules('exam_id', $this->lang->line('exam'), 'trim|required');
        $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required');
        $this->form_validation->set_rules('receiver_role_id', $this->lang->line('receiver_type'), 'trim|required');
        $this->form_validation->set_rules('sms_gateway', $this->lang->line('gateway'), 'trim|required|callback_sms_gateway');
    }

    
    /*****************Function index**********************************
    * @type            : Function
    * @function name   : index
    * @description     : Process to validate SMS gateway                 
    *                    
    * @param           : null
    * @return          : boolean true/flase 
    * ********************************************************** */
   public function sms_gateway() {

        $getway = $this->input->post('sms_gateway');

        if ($getway == "clicktell") {
            if ($this->clickatell->ping() == TRUE) {
                return TRUE;
            } else {
                $this->form_validation->set_message("sms_gateway", $this->lang->line('setup_your_sms_gateway'));
                return FALSE;
            }
        } elseif ($getway == 'twilio') {
            $get = $this->twilio->get_twilio();
            $ApiVersion = $get['version'];
            $AccountSid = $get['accountSID'];
            $check = $this->twilio->request("/$ApiVersion/Accounts/$AccountSid/Calls");

            if ($check->IsError) {
                $this->form_validation->set_message("sms_gateway", $this->lang->line('setup_your_sms_gateway'));
                return FALSE;
            }
            return TRUE;
        } elseif ($getway == 'bulk') {
            if ($this->bulk->ping() == TRUE) {
                return TRUE;
            } else {
                $this->form_validation->set_message("sms_gateway", $this->lang->line('setup_your_sms_gateway'));
                return FALSE;
            }
        } elseif ($getway == 'msg91') {
            return true;
        } elseif ($getway == 'plivo') {
            return true;
        }
    }

    
    /*****************Function _get_posted_sms_data**********************************
    * @type            : Function
    * @function name   : _get_posted_sms_data
    * @description     : Prepare "SMS" user input data to save into database                  
    *                       
    * @param           : null
    * @return          : $data array(); value 
    * ********************************************************** */
    private function _get_posted_sms_data() {

        $items = array();
        $items[] = 'school_id';
        $items[] = 'exam_id';
        $items[] = 'class_id';
        $items[] = 'receiver_role_id';
        $items[] = 'sms_gateway';
        $data = elements($items, $_POST);

        $data['academic_year_id'] = $this->academic_year_id;
        $data['sender_role_id'] = $this->session->userdata('role_id');
        $data['status'] = 1;
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['created_by'] = logged_in_user_id();

        return $data;
    }

    
    /*****************Function _send_sms**********************************
    * @type            : Function
    * @function name   : _send_sms
    * @description     : process to sent SMS with exam mark to the student/guardian                  
    *                       
    * @param           : $data array() value
    * @return          : null 
    * ********************************************************** */
    private function _send_sms($data) {

        $students = $this->mark->get_student_list_by_class($data['school_id'], $data['exam_id'], $data['class_id']);
        $school = $this->mark->get_single('schools', array('status' => 1, 'school_id'=>$data['school_id']));

        if (!empty($students)) {

            foreach ($students AS $obj) {

                $message = '';
                $receiver_sms = '';
                // initial message part as per receiver
                if ($data['receiver_role_id'] == STUDENT) {

                    $message = 'Hi ' . $obj->student_name . ',';
                    $message .= 'your marks at ' . $obj->exam_name . ':';
                    $receiver_mobile = $obj->phone;
                }
                if ($data['receiver_role_id'] == GUARDIAN) {
                    $message = 'Hi, your child ' . $obj->student_name . ' ';
                    $message .= 'obtain marks at ' . $obj->exam_name . ':';
                    $receiver_mobile = $this->db->get_where('guardians', array('id' => $obj->guardian_id))->row()->phone;
                }

                // message marks parts
                $marks = $this->mark->get_marks_list_by_student($data['school_id'], $data['exam_id'], $data['class_id'], $obj->student_id);
                foreach ($marks as $mark) {
                    $message .= strtoupper(substr($mark->subject, 0,2)) . ':' . $mark->obtain_mark . ' of ' . $mark->exam_mark . ',';
                }

                //$message .= 'Thank you,';
                //$message .= $setting->school_name;

                if ($receiver_mobile) {
                    $phone = '+' . $receiver_mobile;
                    $this->_send($data['sms_gateway'], $phone, $message);
                }
            }
        }
    }

    
    /*****************Function _send**********************************
    * @type            : Function
    * @function name   : _send
    * @description     : Sent SMS using conigured Gateway                  
    *                       
    * @param           : $data array() value
    * @return          : null 
    * ********************************************************** */
    public function _send($sms_gateway, $phone, $message) {

        if ($sms_gateway == "clicktell") {

            $this->load->library('clickatell');
            $this->clickatell->send_message($phone, $message);
            
        } elseif ($sms_gateway == 'twilio') {

            $this->load->library('twilio');
            $get = $this->twilio->get_twilio();
            $from = $get['number'];
            $response = $this->twilio->sms($from, $phone, $message);
            
        } elseif ($sms_gateway == 'bulk') {

            //https://github.com/anlutro/php-bulk-sms     
            $this->load->library('bulk');
            $this->bulk->send($phone, $message);
            
        } elseif ($sms_gateway == 'msg91') {

            $this->load->library('msg91');
            $response = $this->msg91->send($phone, $message);
            
        } elseif ($sms_gateway == 'plivo') {

            $this->load->library('plivo');
            $response = $this->twilio->send($phone, $message);
        }
    }

    
    /*****************Function delete**********************************
    * @type            : Function
    * @function name   : delete
    * @description     : delete "SMS" content from database                  
    *                       
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    public function delete($id = null) {

        check_permission(DELETE);

        if ($this->mark->delete('mark_smses', array('id' => $id))) {
            success($this->lang->line('delete_success'));
        } else {
            error($this->lang->line('delete_failed'));
        }
        redirect('exam/text');
    }

}
