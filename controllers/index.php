<?php

class index extends controller {
           
	function __construct() {
		parent::__construct();
                 session::init();
                 
                 $this->view->css = array('index/css/index.css');
                
                $this->view->js = array('index/js/index.js');
	
	}
			function index() {
                            
			
                               
                               $this->view->render('index/index');
			      //header('location:'.URL.'stream/');
                             
                         
		       
		}
}

?>