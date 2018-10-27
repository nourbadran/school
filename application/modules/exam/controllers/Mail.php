<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* * *****************Mail.php**********************************
 * @product name    : Global Multi School Management System Express
 * @type            : Class
 * @class name      : Mail
 * @description     : Manage email which are sent to student and guardian with student exam mark.  
 * @author          : Codetroopers Team 	
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com	
 * @copyright       : Codetroopers Team	 	
 * ********************************************************** */

class Mail extends MY_Controller {

    public $data = array();

    function __construct() {
        parent::__construct();
        $this->load->model('Mark_Model', 'mark', true);        
    }

    
    /*****************Function index**********************************
    * @type            : Function
    * @function name   : index
    * @description     : Load "Email List" user interface                 
    *                      
    * @param           : $id integer value
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
        $this->data['mark_emails'] = $this->mark->get_mark_emails();
        $this->data['roles'] = $this->mark->get_list('roles', array('status' => 1), '', '', '', 'id', 'ASC');
        
        $this->data['list'] = TRUE;
        $this->layout->title($this->lang->line('mark_send_by_email') . ' | ' . SMS);
        $this->layout->view('email/index', $this->data);
    }

    
    /*****************Function view**********************************
    * @type            : Function
    * @function name   : view
    * @description     : Load user interface with specific email data                 
    *                       
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    public function view($id = null) {

        check_permission(VIEW);
        
        $condition = array();
        $condition['status'] = 1;        
        if($this->session->userdata('role_id') != SUPER_ADMIN){ 
            $condition['school_id'] = $this->session->userdata('school_id');
            $this->data['classes'] = $this->mark->get_list('classes', $condition, '','', '', 'id', 'ASC');
            $condition['academic_year_id'] = $this->academic_year_id;
            $this->data['exams'] = $this->mark->get_list('exams', $condition, '', '', '', 'id', 'ASC');
        } 
        $this->data['mark_emails'] = $this->mark->get_mark_emails();
        $this->data['roles'] = $this->mark->get_list('roles', array('status' => 1), '', '', '', 'id', 'ASC');

        $this->data['mail'] = $this->mark->get_single_mark($id);
        $this->data['detail'] = TRUE;
        $this->layout->title($this->lang->line('mark_send_by_email') . ' | ' . SMS);
        $this->layout->view('email/index', $this->data);
    }

    
    /*****************Function send**********************************
    * @type            : Function
    * @function name   : send
    * @description     : Process to sent email with student exam marks 
    *                    to the student/guardian                  
    *                       
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function send() {

        check_permission(ADD);

        if ($_POST) {
            $this->_prepare_email_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_email_data();

                $insert_id = $this->mark->insert('mark_emails', $data);
                if ($insert_id) {
                    $this->_send_email($data);
                    success($this->lang->line('email_send_success'));
                    redirect('exam/mail');
                } else {
                    error($this->lang->line('email_send_failed'));
                    redirect('exam/mail');
                }
            } else {
                error($this->lang->line('fill_out_all_data'));
                redirect('exam/mail');
            }
        } else {
            error($this->lang->line('unexpected_error'));
            redirect('exam/mail');
        }
    }

    
    /*****************Function _prepare_email_validation**********************************
    * @type            : Function
    * @function name   : _prepare_email_validation
    * @description     : Process "email" user input data validation                 
    *                       
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    private function _prepare_email_validation() {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error-message" style="color: red;">', '</div>');

        $this->form_validation->set_rules('school_id', $this->lang->line('school'), 'trim|required');
        $this->form_validation->set_rules('exam_id', $this->lang->line('exam'), 'trim|required');
        $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required');
        $this->form_validation->set_rules('receiver_role_id', $this->lang->line('receiver_type'), 'trim|required');
        $this->form_validation->set_rules('subject', $this->lang->line('subject'), 'trim|required');
        $this->form_validation->set_rules('note', $this->lang->line('note'), 'trim');
    }

    
    /*****************Function _get_posted_email_data**********************************
    * @type            : Function
    * @function name   : _get_posted_email_data
    * @description     : Prepare "email" user input data to save into database                  
    *                       
    * @param           : null
    * @return          : $data array(); value 
    * ********************************************************** */
    private function _get_posted_email_data() {

        $items = array();
        $items[] = 'school_id';
        $items[] = 'exam_id';
        $items[] = 'class_id';
        $items[] = 'receiver_role_id';
        $items[] = 'subject';
        $items[] = 'note';
        $data = elements($items, $_POST);

        $data['academic_year_id'] = $this->academic_year_id;
        $data['sender_role_id'] = $this->session->userdata('role_id');
        $data['status'] = 1;
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['created_by'] = logged_in_user_id();

        return $data;
    }

    
    /*****************Function _send_email**********************************
    * @type            : Function
    * @function name   : _send_email
    * @description     : process to sent email with exam mark to the student/guardian                  
    * @param           : $data array() value
    * @return          : null 
    * ********************************************************** */
    private function _send_email($data) {

        $students = $this->mark->get_student_list_by_class($data['school_id'], $data['exam_id'], $data['class_id']);
        $school = $this->mark->get_single('schools', array('status' => 1));


        $this->load->library('email');
        $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';
        $this->email->initialize($config);

        $from_email = $this->session->userdata('email');
        $from_name = $this->session->userdata('name');
        $this->email->from($from_email, $from_name);
        $this->email->reply_to($from_email, $from_name);

        if (!empty($students)) {

            foreach ($students AS $obj) {

                $message = '';
                $receiver_email = '';
                // initial message part as per receiver
                if ($data['receiver_role_id'] == STUDENT) {

                    $message = 'Hi <strong>' . $obj->student_name . '</strong><br/><br/>';
                    $message .= 'You have obtain following marks at your <strong>' . $obj->exam_name . ' </strong> Exam <br/><br/>';
                }
                if ($data['receiver_role_id'] == GUARDIAN) {
                    $message = 'Hi, Your child <strong>' . $obj->student_name . '</strong><br/><br/>';
                    $message .= 'has been obtain following marks at his <strong>' . $obj->exam_name . ' </strong> Exam <br/><br/>';
                }

                // its either student or guardian email
                $receiver_email = $this->mark->get_receiver_email($data['school_id'], $data['receiver_role_id'], $obj->student_id);

                // message marks parts
                $marks = $this->mark->get_marks_list_by_student($data['school_id'], $data['exam_id'], $data['class_id'], $obj->student_id);
                foreach ($marks as $mark) {
                    $message .= '<strong>' . $mark->subject . ':</strong> <strong>' . $mark->obtain_mark . '</strong> out of <strong>' . $mark->exam_mark . '</strong><br/><br/>';
                }

                $message .= $data['note'] . '<br/><br/>';
                $message .= 'Thank you<br/>';
                $message .= $setting->school_name;

                $this->email->to($receiver_email);
                $this->email->subject($data['subject']);
                $this->email->message($message);
                $this->email->send();
            }
           
        }
    }

    
    /*****************Function delete**********************************
    * @type            : Function
    * @function name   : delete
    * @description     : delete "Email" content from database                  
    *                       
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    public function delete($id = null) {

        check_permission(DELETE);

        if ($this->mark->delete('mark_emails', array('id' => $id))) {
            success($this->lang->line('delete_success'));
        } else {
            error($this->lang->line('delete_failed'));
        }
        redirect('exam/mail');
    }

}
