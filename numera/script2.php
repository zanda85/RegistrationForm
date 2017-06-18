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
         if(isset($request['keyord'])){
             $p = DbManager::instance()->getParticipantById($request['keyord']);
             if($p == null){
                 $code = 1;
             }else{
                 $code = 0;
             }
             
             
         }else{
             $code = 1;
         }
         header('Content-Type: text/xml');
        include 'xml/script2.php';
     }
     
}
