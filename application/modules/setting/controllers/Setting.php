<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* * *****************Setting.php**********************************
 * @product name    : Global Multi School Management System Express
 * @type            : Class
 * @class name      : Setting
 * @description     : Manage application general settings.  
 * @author          : Codetroopers Team 	
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com	
 * @copyright       : Codetroopers Team	 	
 * ********************************************************** */

class Setting extends MY_Controller {

    public $data = array();

    function __construct() {
        parent::__construct();
        $this->load->model('Setting_Model', 'setting', true);        
        //$this->data['fields'] = $this->setting->get_table_fields('languages');
        $this->data['years'] = $this->setting->get_list('academic_years', array('status' => 1), '', '', '', 'id', 'ASC');
    }

        
    /*****************Function index**********************************
    * @type            : Function
    * @function name   : index
    * @description     : Load "General Setting" user interface                 
    *                    
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function index() {

        check_permission(VIEW);
        
        $condition = array();
        $condition['status'] = 1;        
        if($this->session->userdata('role_id') != SUPER_ADMIN){  
            
            $condition['id'] = $this->session->userdata('school_id');     
            $this->data['setting'] = $this->setting->get_single('schools', $condition);
        }        
        
        $this->layout->title($this->lang->line('general') . ' ' . $this->lang->line('setting') . ' | ' . SMS);
        $this->layout->view('index', $this->data);
    }

    
    /*****************Function add**********************************
    * @type            : Function
    * @function name   : add
    * @description     : Load "New General Settings" user interface                 
    *                    and process to store "General Settings" into database
    *                    for the first time settings 
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    public function add() {

        check_permission(ADD);

        if ($_POST) {
            $this->_prepare_setting_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_setting_data();

                $insert_id = $this->setting->insert('schools', $data);
                if ($insert_id) {
                    success($this->lang->line('insert_success'));
                    redirect('setting/index');
                } else {
                    error($this->lang->line('insert_failed'));
                    redirect('setting/add');
                }
            } else {
                $this->data = $_POST;
            }
        }
        $this->data['setting'] = $this->setting->get_single('schools', array('status' => 1));
        $this->layout->title($this->lang->line('general') . ' ' . $this->lang->line('setting') . ' | ' . SMS);
        $this->layout->view('index', $this->data);
    }

    
        
    /*****************Function edit**********************************
    * @type            : Function
    * @function name   : edit
    * @description     : Load Update "General Settings" user interface                 
    *                    with populate "General Settings" value 
    *                    and process to update "General Settings" into database    
    * @param           : $id integer value
    * @return          : null 
    * ********************************************************** */
    public function edit($id = null) {

        check_permission(EDIT);

        if ($_POST) {
            $this->_prepare_setting_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_setting_data();
                $updated = $this->setting->update('schools', $data, array('id' => $this->input->post('id')));

                if ($updated) {
                    // update language file
                    $this->update_lang();

                    success($this->lang->line('update_success'));
                    redirect('setting/index');
                } else {
                    error($this->lang->line('update_failed'));
                    redirect('setting/edit/' . $this->input->post('id'));
                }
            }
        }
        
        $this->data['setting'] = $this->setting->get_single('schools', array('status' => 1));
        $this->layout->title($this->lang->line('general') . ' ' . $this->lang->line('setting') . ' | ' . SMS);
        $this->layout->view('setting/index', $this->data);
    }

        
    /*****************Function _prepare_setting_validation**********************************
    * @type            : Function
    * @function name   : _prepare_setting_validation
    * @description     : Process "General Settings" user input data validation                 
    *                       
    * @param           : null
    * @return          : null 
    * ********************************************************** */
    private function _prepare_setting_validation() {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error-message" style="color: red;">', '</div>');

        $this->form_validation->set_rules('school_name', $this->lang->line('school') . ' ' . $this->lang->line('name'), 'trim|required');
        $this->form_validation->set_rules('address', $this->lang->line('address'), 'trim|required');
        $this->form_validation->set_rules('phone', $this->lang->line('phone'), 'trim|required');
        $this->form_validation->set_rules('email', $this->lang->line('email'), 'trim|required');
        $this->form_validation->set_rules('currency', $this->lang->line('currency'), 'trim|required');
        $this->form_validation->set_rules('currency_symbol', $this->lang->line('currency_symbol'), 'trim|required');
        $this->form_validation->set_rules('language', $this->lang->line('language'), 'trim|required');
        $this->form_validation->set_rules('footer', $this->lang->line('footer'), 'trim|required');
        $this->form_validation->set_rules('running_year', $this->lang->line('running_year'), 'trim|required');
    }

       
    /*****************Function _get_posted_setting_data**********************************
    * @type            : Function
    * @function name   : _get_posted_setting_data
    * @description     : Prepare "General Settings" user input data to save into database                  
    *                       
    * @param           : null
    * @return          : $data array(); value 
    * ********************************************************** */
    private function _get_posted_setting_data() {

        $items = array();
        $items[] = 'school_name';
        $items[] = 'address';
        $items[] = 'phone';
        $items[] = 'email';
        $items[] = 'currency';
        $items[] = 'currency_symbol';
        $items[] = 'language';
        $items[] = 'running_year';
        $items[] = 'school_fax';
        $items[] = 'school_geocode';    
        $items[] = 'footer';
        
        $data = elements($items, $_POST);

        // update current / runing year session
        $this->db->update('academic_years', array('is_running' => 0));
        $this->setting->update('academic_years', array('is_running' => 1), array('session_year' => $data['running_year']));

        if ($this->input->post('id')) {
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['modified_by'] = logged_in_user_id();
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = logged_in_user_id();
        }

        if ($_FILES['logo']['name']) {
            $data['logo'] = $this->_upload_logo();
        }

        return $data;
    }

           
    /*****************Function _upload_logo**********************************
    * @type            : Function
    * @function name   : _upload_logo
    * @description     : Process to upload institute logo in the server                  
    *                     and return logo name   
    * @param           : null
    * @return          : $logo string value 
    * ********************************************************** */
    private function _upload_logo() {

        $prevoius_logo = @$_POST['logo_prev'];
        $logo_name = $_FILES['logo']['name'];
        $logo_type = $_FILES['logo']['type'];
        $logo = '';


        if ($logo_name != "") {
            if ($logo_type == 'image/jpeg' || $logo_type == 'image/pjpeg' ||
                    $logo_type == 'image/jpg' || $logo_type == 'image/png' ||
                    $logo_type == 'image/x-png' || $logo_type == 'image/gif') {

                $destination = 'assets/uploads/logo/';

                $file_type = explode(".", $logo_name);
                $extension = strtolower($file_type[count($file_type) - 1]);
                $logo_path = time().'-school-logo.' . $extension;

                copy($_FILES['logo']['tmp_name'], $destination . $logo_path);

                if ($prevoius_logo != "") {
                    // need to unlink previous image
                    if (file_exists($destination . $prevoius_logo)) {
                        @unlink($destination . $prevoius_logo);
                    }
                }

                $logo = $logo_path;
            }
        } else {
            $logo = $prevoius_logo;
        }

        return $logo;
    }

}
