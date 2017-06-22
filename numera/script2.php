<?php
include_once '../classes/DbManager.php';
include_once '../classes/Participant.php';
include_once '../classes/Conference.php';
include_once '../classes/RegType.php';

date_default_timezone_set("Europe/Rome");
// punto unico di accesso all'applicazione
Script2::dispatch($_REQUEST);

class Script2 {
    
     public static function dispatch(&$request) {
         error_log("[script 2] received request from  ".$_SERVER['REMOTE_ADDR']);
         if(isset($request['keyord']) && Script2::iptest()){
             $p = DbManager::instance()->getParticipantById($request['keyord']);
             if($p == null){
                 $code = 1;
                 error_log("[script 2] request ok");
             }else{
                 $code = 0;
                 error_log("[script 1] request not ok");
             }
             
             
         }else{
             $code = 1;
         }
         header('Content-Type: text/xml');
        include 'xml/script2.php';
     }
     
    public static function iptest(){
        return $_SERVER['REMOTE_ADDR'] == '81.119.165.131' ||
                 $_SERVER['REMOTE_ADDR'] == '81.113.175.233'||
                 $_SERVER['REMOTE_ADDR'] == '127.0.0.1';
    }
     
}
