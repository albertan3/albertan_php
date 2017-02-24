<?php

class tickets extends controller  {

function __construct() {
		parent::__construct();
                
               // $this->view->js = array('dashboard/js/default.js');
		
		}
function merchant_list() {
                    
		       
		      echo'['
                     . '{"name":"Peets Coffee"},'
                       .'{"name": "ihouse cafe"},'
                       .'{"name": "Cafe Milano"},'
                         .'{"name": "Abe\'s Cafe"}'
                              
                        .']';
		}
                
 
                
               
        

}

