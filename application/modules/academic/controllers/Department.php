<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* * *****************Stage.php**********************************
 * @product name    : Global Multi School Management System Express
 * @type            : Class
 * @class name      : Department
 * @description     : Manage academic class Departments/ division.  
 * @author          : Codetroopers Team 	
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com	
 * @copyright       : Codetroopers Team	 	
 * ********************************************************** */

class Department extends MY_Controller {

    public $data = array();
    
    
    function __construct() {
        parent::__construct();
                 
         $this->load->model('Department_Model', 'dept', true);
    }

    
    /*****************Function index**********************************
     * @type            : Function
     * @function name   : index
     * @description     : Load "Class Department list" user interface                 
     *                    with class wise department list   
     * @param           : $id integer value
     * @return          : null 
     * ********************************************************** */
    public function index() {
        
        check_permission(VIEW); 
        $condition = array();
       
        
        $this->data['departments'] = $this->dept->get_department_list(); 
       
        
        $this->data['list'] = TRUE;
        
        $this->layout->title($this->lang->line('manage_department'). ' | ' . SMS);
        $this->layout->view('department/index', $this->data);            
       
    }

    /*****************Function add**********************************
     * @type            : Function
     * @function name   : add
     * @description     : Load "Add new Class Stage" user interface                 
     *                    and store "Class Section" into database 
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    public function add() {
        
        check_permission(ADD);
        
        if ($_POST) {
            
            $this->_prepare_stage_validation();
         
            if ($this->form_validation->run() === TRUE) {

                $data = $this->_get_posted_section_data();

                $insert_id = $this->dept->insert('departments', $data);
                if ($insert_id) {
                    success($this->lang->line('insert_success'));
                    redirect('academic/department/index/');
                } else {
                    error($this->lang->line('insert_failed'));
                    redirect('academic/department/add/');
                }
            } else {

                $this->data['post'] = $_POST;
            }
        }

        $class_id = $this->uri->segment(4);
        if(!$class_id){
          $class_id = $this->input->post('class_id');
        }
        $condition = array();
        $condition['status'] = 1;        
        if($this->session->userdata('role_id') != SUPER_ADMIN){            
            $condition['school_id'] = $this->session->userdata('school_id');
        }
        
        $this->data['departments'] = $this->dept->get_department_list(); 
        
    
        
        
        $this->data['schools'] = $this->schools;
        $this->data['add'] = TRUE;
        $this->layout->title($this->lang->line('add'). ' ' . $this->lang->line('_department'). ' | ' . SMS);
        $this->layout->view('department/index', $this->data);
    }

    /*****************Function _get_posted_section_data**********************************
     * @type            : Function
     * @function name   : _get_posted_section_data
     * @description     : Prepare "Class Section" user input data to save into database                  
     *                       
     * @param           : null
     * @return          : $data array(); value 
     * ********************************************************** */ 
    private function _get_posted_section_data() {

        $items = array();
        $items[] = 'name';
        $data = elements($items, $_POST);        
        $data['note'] = $this->input->post('note');
        $data['school_id'] = $this->session->userdata('school_id');
        
        if ($this->input->post('id')) {
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['modified_by'] = logged_in_user_id();
        } else {
            
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = logged_in_user_id();                       
        }

        return $data;
    }

    /*****************Function _prepare_stage_validation**********************************
     * @type            : Function
     * @function name   : _prepare_stage_validation
     * @description     : Process "Class Stage" user input data validation                 
     *                       
     * @param           : null
     * @return          : null 
     * ********************************************************** */
    private function _prepare_stage_validation() {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error-message" style="color: red;">', '</div>');
        
        $this->form_validation->set_rules('name', $this->lang->line('name'), 'required|trim');
    }


    /*****************Function edit**********************************
     * @type            : Function
     * @function name   : edit
     * @description     : Load Update "Class Section" user interface                 
     *                    with populated "class section" value 
     *                    and update "Class section" database    
     * @param           : $id integer value
     * @return          : null 
     * ********************************************************** */
    public function edit($id = null) {       
       
        check_permission(EDIT);
        
        if(!is_numeric($id)){
            error($this->lang->line('unexpected_error'));
            redirect('academic/department/index/');
        }
        
        if ($_POST) {
            $this->_prepare_stage_validation();
            if ($this->form_validation->run() === TRUE) {
                $data = $this->_get_posted_section_data();
                $updated = $this->dept->update('departments', $data, array('id' => $this->input->post('id')));

                if ($updated) {
                    success($this->lang->line('update_success'));
                    redirect('academic/department/index/'.$data['class_id']);                   
                } else {
                    error($this->lang->line('update_failed'));
                    redirect('academic/department/edit/' . $this->input->post('id'));
                }
            } else {
                 $this->data['post'] = $_POST;
                 $this->data['department'] = $this->dept->get_single('departments', array('id' => $this->input->post('id')));
            }
        }
        
        if ($id) {
            $this->data['department'] = $this->dept->get_single('departments', array('id' => $id));

            if (!$this->data['department']) {
                redirect('academic/department/index/');
            }
        }
        $condition = array();
        $condition['status'] = 1;        
        if($this->session->userdata('role_id') != SUPER_ADMIN){            
            $condition['school_id'] = $this->session->userdata('school_id');
        }
        
        $this->data['departments'] = $this->dept->get_department_list(); 
       
        $this->data['edit'] = TRUE;   
    
        
        $this->layout->title($this->lang->line('edit'). ' ' . $this->lang->line('_department'). ' | ' . SMS);
        $this->layout->view('department/index', $this->data);
    }
    /*****************Function delete**********************************
     * @type            : Function
     * @function name   : delete
     * @description     : delete "Class Department" from database                  
     *                       
     * @param           : $id integer value
     * @return          : null 
     * ********************************************************** */
    public function delete($id = null) {
        
        check_permission(DELETE);
        
        if(!is_numeric($id)){
            error($this->lang->line('unexpected_error'));
            redirect('academic/department/index/');
        }
        
        $section = $this->dept->get_single('departments', array('id' => $id));
        if ($this->dept->delete('departments', array('id' => $id))) {            
            success($this->lang->line('delete_success'));
        } else {
            error($this->lang->line('delete_failed'));
        }
        redirect('academic/department/index/');
    }

    

}
