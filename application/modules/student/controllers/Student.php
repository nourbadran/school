<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* * *****************Student.php**********************************
 * @product name    : Global Multi School Management System Express
 * @type            : Class
 * @class name      : Student
 * @description     : Manage students imformation of the school.  
 * @author          : Codetroopers Team 	
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com	
 * @copyright       : Codetroopers Team	 	
 * ********************************************************** */

class Student extends MY_Controller {

    public $data = array();

    function __construct() {
        parent::__construct();      
        
        $this->load->model('Student_Model', 'student', true);
        // check running session
        if(!$this->academic_year_id){
            error($this->lang->line('academic_year_setting'));
            redirect('setting');
        }         
    }

    
    
    /*****************Function index**********************************
    * @type            : Function
    * @function name   : index
    * @description     : Load "Student List" user interface                 
    *                    with class wise listing    
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    public function index($class_id = null, $school_id = null) {

        check_permission(VIEW);
        
        if(isset($class_id) && !is_numeric($class_id)){
            error($this->lang->line('unexpected_error'));
            redirect('academic/classes/index');
        }
        
        $this->data['class_id'] = $class_id;
        $this->data['filter_school_id'] = $school_id;
        $this->data['students'] = $this->student->get_student_list($class_id, $school_id);
        $this->data['roles'] = $this->student->get_list('roles', array('status' => 1), '', '', '', 'id', 'ASC');
        
        
        $condition = array();
        $condition['status'] = 1;        
        if($this->session->userdata('role_id') != SUPER_ADMIN){            
            $condition['school_id'] = $this->session->userdata('school_id');
            $this->data['classes'] = $this->student->get_list('classes', $condition, '','', '', 'id', 'ASC');
            $this->data['guardians'] = $this->student->get_list('guardians', $condition, '','', '', 'id', 'ASC');
        }
        $this->data['class_list'] = $this->student->get_list('classes', $condition, '','', '', 'id', 'ASC');
        
        $this->data['schools'] = $this->schools;
        $this->data['list'] = TRUE;
        $this->layout->title($this->lang->line('manage_student') . ' | ' . SMS);
        $this->layout->view('student/index', $this->data);
    }

    
    /*****************Function add**********************************
    * @type            : Function
    * @function name   : add
    * @description     : Load "Add new Student" user interface                 
    *                    and process to store "Student" into database 
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function add() {

        check_permission(ADD);

        if ($_POST) {
            $this->_prepare_student_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_student_data();

                $insert_id = $this->student->insert('students', $data);

                if ($insert_id) {
                    $this->__insert_enrollment($insert_id);
                    success($this->lang->line('insert_success'));
                    redirect('student/index/'.$this->input->post('class_id'));
                } else {
                    error($this->lang->line('insert_failed'));
                    redirect('student/add/'.$this->input->post('class_id'));
                }
            } else {

                $this->data['post'] = $_POST;
            }
        }
        
        $class_id = $this->uri->segment(4);
        if(!$class_id){
          $class_id = $this->input->post('class_id');
        }

        $this->data['class_id'] = $class_id;
        $this->data['students'] = $this->student->get_student_list($class_id);
        $this->data['roles'] = $this->student->get_list('roles', array('status' => 1), '', '', '', 'id', 'ASC');
        
         
        $condition = array();
        $condition['status'] = 1;        
        if($this->session->userdata('role_id') != SUPER_ADMIN){            
            $condition['school_id'] = $this->session->userdata('school_id');
            $this->data['classes'] = $this->student->get_list('classes', $condition, '','', '', 'id', 'ASC');
            $this->data['guardians'] = $this->student->get_list('guardians', $condition, '','', '', 'id', 'ASC');
        }
        $this->data['class_list'] = $this->student->get_list('classes', $condition, '','', '', 'id', 'ASC');
        
        $this->data['schools'] = $this->schools;
        $this->data['add'] = TRUE;
        $this->layout->title($this->lang->line('add') . ' ' . $this->lang->line('student') . ' | ' . SMS);
        $this->layout->view('student/index', $this->data);
    }

        
    /*****************Function edit**********************************
    * @type            : Function
    * @function name   : edit
    * @description     : Load Update "Student" user interface                 
    *                    with populate "Student" value 
    *                    and process to update "Student" into database    
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    public function edit($id = null) {

        check_permission(EDIT);

        if(!is_numeric($id)){
            error($this->lang->line('unexpected_error'));
            redirect('student/index');     
        }
        
        if ($_POST) {
            $this->_prepare_student_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_student_data();
                $updated = $this->student->update('students', $data, array('id' => $this->input->post('id')));

                if ($updated) {
                    $this->__update_enrollment();
                    success($this->lang->line('update_success'));
                    redirect('student/index/'.$this->input->post('class_id'));
                } else {
                    error($this->lang->line('update_failed'));
                    redirect('student/edit/' . $this->input->post('id'));
                }
            } else {
                $this->data['student'] = $this->student->get_single_student($this->input->post('id'));
            }
        }

        if ($id) {
            $this->data['student'] = $this->student->get_single_student($id);

            if (!$this->data['student']) {
                redirect('student/index');
            }
        }
        
        $class_id = $this->data['student']->class_id;
        if(!$class_id){
          $class_id = $this->input->post('class_id');
        } 

        $this->data['class_id'] = $class_id;
        $this->data['students'] = $this->student->get_student_list($class_id);
        $this->data['roles'] = $this->student->get_list('roles', array('status' => 1), '', '', '', 'id', 'ASC');
        
          
        $condition = array();
        $condition['status'] = 1;        
        if($this->session->userdata('role_id') != SUPER_ADMIN){            
            $condition['school_id'] = $this->session->userdata('school_id');
            $this->data['classes'] = $this->student->get_list('classes', $condition, '','', '', 'id', 'ASC');
            $this->data['guardians'] = $this->student->get_list('guardians', $condition, '','', '', 'id', 'ASC');
        }
        $this->data['class_list'] = $this->student->get_list('classes', $condition, '','', '', 'id', 'ASC');
        $this->data['school_id'] = $this->data['student']->school_id;
        
        $this->data['schools'] = $this->schools;
        $this->data['edit'] = TRUE;
        $this->layout->title($this->lang->line('edit') . ' ' . $this->lang->line('student') . ' | ' . SMS);
        $this->layout->view('student/index', $this->data);
    }

        
    
    /*****************Function view**********************************
    * @type            : Function
    * @function name   : view
    * @description     : Load user interface with specific Student data                 
    *                       
    * @param           : $student_id integer value
    * @return          : null 
    * ********************************************************** */
    public function view($student_id = null) {

        check_permission(VIEW);

        if(!is_numeric($student_id)){
             error($this->lang->line('unexpected_error'));
              redirect('student/index');
        }
        
        $this->data['student'] = $this->student->get_single_student($student_id);        
        $class_id = $this->data['student']->class_id;
        
        $this->data['students'] = $this->student->get_student_list($class_id);
        $this->data['roles'] = $this->student->get_list('roles', array('status' => 1), '', '', '', 'id', 'ASC');
        
        $condition = array();
        $condition['status'] = 1;        
        if($this->session->userdata('role_id') != SUPER_ADMIN){            
            $condition['school_id'] = $this->session->userdata('school_id');
            $this->data['classes'] = $this->student->get_list('classes', $condition, '','', '', 'id', 'ASC');
            $this->data['guardians'] = $this->student->get_list('guardians', $condition, '','', '', 'id', 'ASC');
        }
        $this->data['class_list'] = $this->student->get_list('classes', $condition, '','', '', 'id', 'ASC');
        
        $this->data['class_id'] = $class_id;  
        
        $this->data['schools'] = $this->schools;
        $this->data['detail'] = TRUE;
        $this->layout->title($this->lang->line('view') . ' ' . $this->lang->line('student') . ' | ' . SMS);
        $this->layout->view('student/index', $this->data);
    }
    
        
    /*****************Function _prepare_student_validation**********************************
    * @type            : Function
    * @function name   : _prepare_student_validation
    * @description     : Process "Student" user input data validation                 
    *                       
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    private function _prepare_student_validation() {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error-message" style="color: red;">', '</div>');

        if (!$this->input->post('id')) {
            $this->form_validation->set_rules('email', $this->lang->line('email'), 'trim|required|valid_email|callback_email');
            $this->form_validation->set_rules('password', $this->lang->line('password'), 'trim|required');
            $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required');
            $this->form_validation->set_rules('roll_no', $this->lang->line('roll_no'), 'trim|required');          
        }

        $this->form_validation->set_rules('school_id', $this->lang->line('school'), 'trim|required');
        $this->form_validation->set_rules('section_id', $this->lang->line('section'), 'trim|required');

        $this->form_validation->set_rules('guardian_id', $this->lang->line('guardian'), 'trim|required');
        $this->form_validation->set_rules('relation_with', $this->lang->line('relation'), 'trim|required');
        $this->form_validation->set_rules('registration_no', $this->lang->line('registration_no'), 'trim');
        $this->form_validation->set_rules('group', $this->lang->line('group'), 'trim');
        $this->form_validation->set_rules('name', $this->lang->line('name'), 'trim|required');
        $this->form_validation->set_rules('phone', $this->lang->line('phone'), 'trim|required');
        $this->form_validation->set_rules('dob', $this->lang->line('birth_date'), 'trim|required');
        $this->form_validation->set_rules('gender', $this->lang->line('gender'), 'trim|required');
        $this->form_validation->set_rules('blood_group', $this->lang->line('blood_group'), 'trim');
        $this->form_validation->set_rules('present_address', $this->lang->line('present') . ' ' . $this->lang->line('address'), 'trim');
        $this->form_validation->set_rules('permanent_address', $this->lang->line('permanent') . ' ' . $this->lang->line('address'), 'trim');
        $this->form_validation->set_rules('religion', $this->lang->line('religion'), 'trim');
        $this->form_validation->set_rules('other_info', $this->lang->line('other_info'), 'trim');
        $this->form_validation->set_rules('photo', $this->lang->line('photo'), 'trim|callback_photo');
    }
                        
    /*****************Function email**********************************
    * @type            : Function
    * @function name   : email
    * @description     : Unique check for "Student Email" data/value                  
    *                       
    * @param           : null
    * @return          : boolean true/false 
    * ********************************************************** */ 
    public function email() {
        if ($this->input->post('id') == '') {
            $email = $this->student->duplicate_check($this->input->post('email'));
            if ($email) {
                $this->form_validation->set_message('email', $this->lang->line('already_exist'));
                return FALSE;
            } else {
                return TRUE;
            }
        } else if ($this->input->post('id') != '') {
            $email = $this->student->duplicate_check($this->input->post('email'), $this->input->post('id'));
            if ($email) {
                $this->form_validation->set_message('email', $this->lang->line('already_exist'));
                return FALSE;
            } else {
                return TRUE;
            }
        } else {
            return TRUE;
        }
    }
                
    /*****************Function photo**********************************
    * @type            : Function
    * @function name   : photo
    * @description     : validate student profile photo                 
    *                       
    * @param           : null
    * @return          : boolean true/false 
    * ********************************************************** */
    public function photo() {
        if ($_FILES['photo']['name']) {
            $name = $_FILES['photo']['name'];
            $arr = explode('.', $name);
            $ext = end($arr);
            if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'gif') {
                return TRUE;
            } else {
                $this->form_validation->set_message('photo', $this->lang->line('select_valid_file_format'));
                return FALSE;
            }
        }
    }

       
    /*****************Function _get_posted_student_data**********************************
    * @type            : Function
    * @function name   : _get_posted_student_data
    * @description     : Prepare "Student" user input data to save into database                  
    *                       
    * @param           : null
    * @return          : $data array(); value 
    * ********************************************************** */
    private function _get_posted_student_data() {

        $items = array();

        $items[] = 'school_id';
        $items[] = 'guardian_id';
        $items[] = 'relation_with';
        $items[] = 'registration_no';
        $items[] = 'group';
        $items[] = 'name';
        $items[] = 'phone';
        $items[] = 'gender';
        $items[] = 'blood_group';
        $items[] = 'present_address';
        $items[] = 'permanent_address';
        $items[] = 'religion';
        $items[] = 'discount';
        $items[] = 'other_info';

        $data = elements($items, $_POST);

        $data['dob'] = date('Y-m-d', strtotime($this->input->post('dob')));

        if ($this->input->post('id')) {
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['modified_by'] = logged_in_user_id();
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = logged_in_user_id();
            $data['status'] = 1;
            // create user 
            $data['user_id'] = $this->student->create_user();
        }

        if ($_FILES['photo']['name']) {
            $data['photo'] = $this->_upload_photo();
        }

        return $data;
    }

           
    /*****************Function _upload_photo**********************************
    * @type            : Function
    * @function name   : _upload_photo
    * @description     : process to upload student profile photo in the server                  
    *                     and return photo file name  
    * @param           : null
    * @return          : $return_photo string value 
    * ********************************************************** */
    private function _upload_photo() {

        $prev_photo = $this->input->post('prev_photo');
        $photo = $_FILES['photo']['name'];
        $photo_type = $_FILES['photo']['type'];
        $return_photo = '';
        if ($photo != "") {
            if ($photo_type == 'image/jpeg' || $photo_type == 'image/pjpeg' ||
                    $photo_type == 'image/jpg' || $photo_type == 'image/png' ||
                    $photo_type == 'image/x-png' || $photo_type == 'image/gif') {

                $destination = 'assets/uploads/student-photo/';

                $file_type = explode(".", $photo);
                $extension = strtolower($file_type[count($file_type) - 1]);
                $photo_path = 'photo-' . time() . '-sms.' . $extension;

                move_uploaded_file($_FILES['photo']['tmp_name'], $destination . $photo_path);

                // need to unlink previous photo
                if ($prev_photo != "") {
                    if (file_exists($destination . $prev_photo)) {
                        @unlink($destination . $prev_photo);
                    }
                }

                $return_photo = $photo_path;
            }
        } else {
            $return_photo = $prev_photo;
        }

        return $return_photo;
    }

        
    
    /*****************Function delete**********************************
    * @type            : Function
    * @function name   : delete
    * @description     : delete "Student" data from database                  
    *                     also delete all relational data
    *                     and unlink student photo from server   
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    public function delete($id = null) {

        check_permission(DELETE);
        
        if(!is_numeric($id)){
             error($this->lang->line('unexpected_error'));
              redirect('student/index');
        }
        
        $student = $this->student->get_single('students', array('id' => $id));
        if (!empty($student)) {

            // delete student data
            $this->student->delete('students', array('id' => $id));

            // delete student login data
            $this->student->delete('users', array('id' => $student->user_id));

            // delete student enrollments
            $this->student->delete('enrollments', array('student_id' => $student->id));

            // delete student hostel_members
            $this->student->delete('hostel_members', array('user_id' => $student->user_id));

            // delete student transport_members
            $this->student->delete('transport_members', array('user_id' => $student->user_id));

            // delete student library_members
            $this->student->delete('library_members', array('user_id' => $student->user_id));

            // delete student resume and photo
            $destination = 'assets/uploads/';
            if (file_exists($destination . '/student-photo/' . $student->photo)) {
                @unlink($destination . '/student-photo/' . $student->photo);
            }

            success($this->lang->line('delete_success'));
        } else {
            error($this->lang->line('delete_failed'));
        }
        
        redirect('student/index/');
    }

        
    /*****************Function __insert_enrollment**********************************
    * @type            : Function
    * @function name   : __insert_enrollment
    * @description     : save student info to enrollment while create a new student                  
    * @param           : $insert_id integer value
    * @return          : null 
    * ********************************************************** */
    private function __insert_enrollment($insert_id) {
        $data = array();
        $data['student_id'] = $insert_id;
        $data['school_id'] = $this->input->post('school_id');
        $data['class_id'] = $this->input->post('class_id');
        $data['section_id'] = $this->input->post('section_id');
        $data['academic_year_id'] = $this->academic_year_id;
        $data['roll_no'] = $this->input->post('roll_no');
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['created_by'] = logged_in_user_id();
        $data['status'] = 1;
        $this->db->insert('enrollments', $data);
    }

    /*****************Function __update_enrollment**********************************
    * @type            : Function
    * @function name   : __update_enrollment
    * @description     : update student info to enrollment while update a student                  
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    private function __update_enrollment() {

        $academic_year_id = $this->academic_year_id;

        $data = array();
        $data['school_id'] = $this->input->post('school_id');
        $data['section_id'] = $this->input->post('section_id');
        $data['roll_no'] = $this->input->post('roll_no');
        $data['modified_at'] = date('Y-m-d H:i:s');
        $data['modified_by'] = logged_in_user_id();

        $this->db->where('student_id', $this->input->post('id'));
        $this->db->where('academic_year_id', $academic_year_id);
        $this->db->update('enrollments', $data, array());
    }

}
