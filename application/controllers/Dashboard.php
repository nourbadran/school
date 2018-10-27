<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* * ***************Dashboard.php**********************************
 * @product name    : Global Multi School Management System Express
 * @type            : Class
 * @class name      : Dashboard
 * @description     : This class used to showing basic statistics of whole application 
 *                    for logged in user.  
 * @author          : Codetroopers Team 	
 * @url             : https://themeforest.net/user/codetroopers    
 * @support         : yousuf361@gmail.com	
 * @copyright       : Codetroopers Team	 	
 * ********************************************************** */

class Dashboard extends MY_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('Dashboard_Model', 'dashboard', true);
    }

    public $data = array();

    /*     * ***************Function index**********************************
     * @type            : Function
     * @function name   : index
     * @description     : Default function, Load logged in user dashboard stattistics  
     * @param           : null 
     * @return          : null 
     * ********************************************************** */

    public function index() {
        
        $school_id = $this->session->userdata('school_id');
        
        $this->data['year_session'] = $this->dashboard->get_single('academic_years', array('is_running' => 1));
        $this->data['theme'] = $this->dashboard->get_single('themes', array('status' => 1, 'is_active' => 1));

        $this->data['news'] = $this->dashboard->get_list('news', array('status' => 1, 'school_id'=>$school_id), '', '5', '', 'id', 'ASC');
        $this->data['notices'] = $this->dashboard->get_list('notices', array('status' => 1, 'school_id'=>$school_id), '', '5', '', 'id', 'ASC');
        $this->data['events'] = $this->dashboard->get_list('events', array('status' => 1, 'school_id'=>$school_id), '', '', '', 'id', 'ASC');
        $this->data['holidays'] = $this->dashboard->get_list('holidays', array('status' => 1, 'school_id'=>$school_id), '', '', '', 'id', 'ASC');
       
        
        $this->data['users'] = $this->dashboard->get_user_by_role($school_id);
        $this->data['students'] = $this->dashboard->get_student_by_class($school_id);

        $this->data['total_student'] = $this->dashboard->get_total_student($school_id);
        $this->data['total_guardian'] = $this->dashboard->get_total_guardian($school_id);
        $this->data['total_teacher'] = $this->dashboard->get_total_teacher($school_id);
        $this->data['total_employee'] = $this->dashboard->get_total_employee($school_id);
        $this->data['total_expenditure'] = $this->dashboard->get_total_expenditure($school_id);
        $this->data['total_income'] = $this->dashboard->get_total_income($school_id);

        
        $this->data['sents'] = $this->dashboard->get_message_list($type = 'sent');
        $this->data['drafts'] = $this->dashboard->get_message_list($type = 'draft');
        $this->data['trashs'] = $this->dashboard->get_message_list($type = 'trash');
        $this->data['inboxs'] = $this->dashboard->get_message_list($type = 'inbox');
        $this->data['new'] = $this->dashboard->get_message_list($type = 'new');

        $this->layout->title($this->lang->line('dashboard') . ' | ' . SMS);
        $this->layout->view('dashboard', $this->data);
        
    }

}
