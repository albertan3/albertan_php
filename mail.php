<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

 /*$sth = $this->db->prepare('SELECT * FROM `members` WHERE `index` = :id');
                $sth->execute(array(':id'=> $member_id));
                $member_info= $sth->fetch();
                       */
        $to      = "contendera@gmail.com";
        $subject = 'confirmation email from meetingmeeting.com';
        $message = 'Welcome';
        $headers = 'From: services@albertahn.com' . "\r\n" .
        'Reply-To: services@albertahn.com' . "\r\n" .
         'X-Mailer: PHP/' . phpversion();
          mail($to, $subject, $message, $headers);
          
          echo"hi";
          echo "mail send to"+$to;
          
          ?>
