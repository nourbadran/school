<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* * *****************Stage.php**********************************
 * @product name    : Global Multi School Management System Express
 * @type            : Class
 * @class name      : Stage
 * @description     : Manage academic class section/ division.  
 * @author          : Codetroopers Team 	
 * @url             : https://themeforest.net/user/codetroopers      
 * @support         : yousuf361@gmail.com	
 * @copyright       : Codetroopers Team	 	
 * ********************************************************** */

class Stage extends MY_Controller {

    public $data = array();
    
    
    function __construct() {
        parent::__construct();
                 
         $this->load->model('Stage_Model', 'stage', true);
    }

    
    /*****************Function index**********************************
     * @type            : Function
     * @function name   : index
     * @description     : Load "Class stage list" user interface                 
     *                    with class wise section list   
     * @param           : $id integer value
     * @return          : null 
     * ********************************************************** */
    public function index() {
        
        check_permission(VIEW); 
        
        
        $this->data['stages'] = $this->stage->get_stage_list(); 
        
        
        $this->data['list'] = TRUE;
        
        $this->layout->title($this->lang->line('manage_stage'). ' | ' . SMS);
        $this->layout->view('stage/index', $this->data);            
       
    }

    
    

}
