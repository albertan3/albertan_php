<?php

class room_model extends model {

function __construct() {
    parent::__construct();
}

function show_all_rooms_list(){
    
    $sthk= $this->db-> prepare("SELECT * FROM `rooms` ");
        $sthk-> execute(array(
          
        ));
        
        $room_array = array();
        $data2 = $sthk->fetchAll();
        
        foreach($data2 as $key => $value){
            
        $room_array[$value['index']]=  $value['index'];    
        
        }
        
        //print_r($room_array);
        $jsonman = json_encode($room_array);
        
        echo $jsonman;
    
}// show_all_rooms_list(){

function get_game_stats($room_num){
    
    
    
     $sth1 = $this->db->prepare('SELECT * FROM  `end_game_view`
                WHERE `rooms_index` =:rooms_index');
         
        $sth1->execute(array(
            
            ':rooms_index'=>$room_num
                
                ));
        
        $has_message_index = $sth1->fetchAll();
        
        echo json_encode($has_message_index);
    
} //getgame stats

function create_room($data){
    
     $sth1 = $this->db->prepare('INSERT INTO `rooms` (`room_name`, `type`, `room_state`, `active`)
                                             VALUES (:room_name, :type, :room_state, :active)');
         
        $sth1->execute(array(
            
                ":room_name"=>$data['members_index'],
                ":type"=> "room",            //$data['type'], 
                ":room_state"=>"on",
                ":active"=>"yes"
                
                ));
        
         $index = $this->db->lastInsertId();
         
 //now insert to hasroom
         
        $sthk= $this->db-> prepare("SELECT * FROM `rooms` WHERE `index` = :index");
        $sthk-> execute(array(
           ':index'=>$index
        ));
        
        
        $data2 = $sthk->fetch();
        
       //echo data to save and login person
     //   echo json_encode($data2);
     
//insert me to hasroom        
        $sthr = $this->db->prepare('INSERT INTO `has_room` (`rooms_index`, `members_index`, `status`)
                                             VALUES (:rooms_index, :members_index, :status)');
         
        
        $sthr->execute(array(
            
            ":rooms_index"=>$index,
            ":type"=>$data['members_index'], 
            ":status"=>"admin",
            ":active"=>"yes"
                
                ));
        
        echo json_encode($data2);
        
     }//end function 
     
     
     function endgame_set_stats($data){
         
          $sthk= $this->db-> prepare("SELECT * FROM `has_room` WHERE `members_index` = :members_index AND `rooms_index` = :rooms_index");
        $sthk-> execute(array(
           ':members_index'=>$data['members_index'],
            ':rooms_index'=>$data['rooms_index']
        ));
        
        
        $data2 = $sthk->fetch();
        
        $count = $sthk->rowCount();
        if($count>0){
              
            $sthr = $this->db->prepare('UPDATE `has_room`
                                                    SET `kills` =:kills,
                                                        `gold` =:gold,
                                                        `level`=:level,
                                                        `items`=:items, 
                                                        `points`=:points, 
                                                        `deaths`=:deaths,
                                                        `team`=:team,
                                                        `cs_kills`=:cs_kills
                                       WHERE `rooms_index`= :rooms_index 
                                       AND `members_index`= :members_index');
            $sthr -> execute(array(
           ':rooms_index'=>$data['rooms_index'],
              ':members_index'=>$data['members_index'],
           
              ':kills'=>$data['kills'],
              ':gold'=>$data['gold'], 
              ':level'=>$data['level'],
              
              ':items'=>$data['items'],
              ':points' =>$data['points'] , 
              ':deaths'=> $data['deaths'],
              ':team'=>$data['team'],
              ':cs_kills'=> $data['cs_kills']
        ));
            
        }else{
            
            $sthr = $this->db->prepare('INSERT INTO `has_room`
                                                    (`rooms_index`, `members_index`, `kills`, `gold`, `level`, `items`, `points`, `deaths`, `team`, `cs_kills`)
                                             VALUES (:rooms_index, :members_index, :kills, :gold, :level, :items, :points, :deaths, :team, :cs_kills)');
            $sthr -> execute(array(
           ':rooms_index'=>$data['rooms_index'],
              ':members_index'=>$data['members_index'],
           
              ':kills'=>$data['kills'],
              ':gold'=>$data['gold'], 
              ':level'=>$data['level'],
              
              ':items'=>$data['items'],
              ':points' =>$data['points'] , 
              ':deaths'=> $data['deaths'],
              ':team'=>$data['team'],
              ':cs_kills'=> $data['cs_kills']
        ));
            
        }//else
            
         
         echo json_encode($data);
         
     }//endgame
     
     function get_available_rooms(){
         
         $sthr = $this->db->prepare('SELECT `rooms_index`, COUNT(*) FROM `has_room` GROUP BY `rooms_index`');
         
         $sthr->execute();
         
          $data2 = $sthr->fetchAll();
          
          //foreach($data AS )
          $avail_room =array();
          
          
          foreach($data2 as $key => $value){
              
            if( $value['COUNT(*)']<6){

          /*echo'<pre>'; 
          print_r($value);
           echo'</pre>'; */
                
                $sth2 = $this->db->prepare('SELECT * FROM `rooms` WHERE `index`=:index');
         
            $sth2->execute(array(
                    ":index" =>$value['rooms_index']
                    ));
         
             $datar = $sth2->fetch();
             
            if($datar['room_state'] =="on"){
                
                $avail_room[$datar['index']] = $datar['index'];
                
            }//end if
             
            // print_r($datar);
           
            }//ifend    
          }//foreach
          
          
          echo json_encode($avail_room);
        
           
       //  echo json_encode($data2);
     }//get available rooms


}
