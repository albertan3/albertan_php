<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class thermo extends controller  {

public function __construct() {
		parent::__construct();
                
                 // $this->view->css = array('user/css/user.css');
		  // $this->view->js = array('user/js/js.js');
                   
}
                


     
        public function index(){
            
            $this->model->index();
           //  $this->view->render('user/index');
            
            
        }
  
}
