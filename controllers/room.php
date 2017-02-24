<?php

class room extends controller  {

function __construct() {
		parent::__construct();
                
		
		}
                
function index() {
    
                   //$this->model->show_all_rooms_list();
                      echo '{"room1":"roomid1"}';
		
		}
                
function show_all_rooms_list(){
    
    $this->model->show_all_rooms_list();
}                
                
                
function get_game_stats($room_num){
    
    $this->model->get_game_stats($room_num);
    
    
}  

function create_room($user_index){
    
                   $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                    
                    $data = array();
                    $data['members_index'] = mysqli_real_escape_string($dbc, trim($user_index));
                    
                 
    $this->model->create_room($data);
    
    
}//end create room

function endgame_set_stats(){
    
      $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                    
                    $data = array();
                    $data['rooms_index'] = mysqli_real_escape_string($dbc, trim($_POST['rooms_index']));
                    
                    $data['rooms_index'] = stripcslashes($data['rooms_index']);
                    
                    $data['members_index'] = mysqli_real_escape_string($dbc, trim($_POST['members_index']));
                    $data['level'] = mysqli_real_escape_string($dbc, trim($_POST['level']));
                     $data['items'] = mysqli_real_escape_string($dbc, trim($_POST['items']));
                    $data['kills'] = mysqli_real_escape_string($dbc, trim($_POST['kills']));
                    $data['deaths'] = mysqli_real_escape_string($dbc, trim($_POST['deaths']));
                    $data['cs_kills'] =  mysqli_real_escape_string($dbc, trim($_POST['cs_kills']));
                    $data['gold'] =  mysqli_real_escape_string($dbc, trim($_POST['gold']));
                    $data['team'] = mysqli_real_escape_string($dbc, trim($_POST['team']));
                    $data['points'] = mysqli_real_escape_string($dbc, trim($_POST['points']));
                   
    $this->model->endgame_set_stats($data);
    
} //end game


function get_available_rooms(){
    
    $this->model->get_available_rooms();
    
}
                

}

