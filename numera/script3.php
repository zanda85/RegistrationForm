<?php
include_once '../classes/DbManager.php';
include_once '../classes/Participant.php';
include_once '../classes/Conference.php';
include_once '../classes/RegType.php';

date_default_timezone_set("Europe/Rome");
// punto unico di accesso all'applicazione
Script3::dispatch($_REQUEST);

class Script3 {
    
     public static function dispatch(&$request) {
         //error_log("[script 3] received request from  ".$_SERVER['REMOTE_ADDR']);
         if(isset($request['otp']) && isset($request['keyord']) && Script3::iptest()){
             $p = DbManager::instance()->getParticipantById($request['keyord']);
             if($p != null && $p->otp == $request['otp']){
                 $code = 0; 
                 DbManager::instance()->finalisePayment($p->id);
                 //error_log("[script 3] request ok");
             }else{
                 $code = 1;
                 //error_log("[script 3] request not ok");
             }
             
             
         }else{
             $code = 1;
         }
         header('Content-Type: text/xml');
        include 'xml/script3.php';
     }
     
     public static function iptest(){
         return $_SERVER['REMOTE_ADDR'] == '81.119.165.131' ||
                 $_SERVER['REMOTE_ADDR'] == '81.113.175.233'||
                 $_SERVER['REMOTE_ADDR'] == '127.0.0.1';
    }
     
}
