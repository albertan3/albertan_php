<?php

class user extends controller  {

public function __construct() {
		parent::__construct();
                
                  $this->view->css = array('user/css/user.css');
		   $this->view->js = array('user/js/js.js');
                   
}
                


     
        public function index(){
            
             $this->view->render('user/index');
            
            
        }
  
}

?>
