<?php
include_once '../classes/DbManager.php';
include_once '../classes/Participant.php';
include_once '../classes/Conference.php';
include_once '../classes/RegType.php';

date_default_timezone_set("Europe/Rome");
// punto unico di accesso all'applicazione
Script1::dispatch($_REQUEST);

class Script1 {
    
     public static function dispatch(&$request) {
         if(isset($request['otp']) && isset($request['keyord']) && Script1::iptest()){
             $p = DbManager::instance()->getParticipantById($request['keyord']);
             DbManager::instance()->lazyLoadParticipant($p);
             $conf = DbManager::instance()->getConferenceById($p->getRegType()->conference_id);
             if(DbManager::instance()->setOtp($p->id, $request['otp'])){
                 $code = 0; 
             }else{
                 $code = 1;
             }
             
             
         }else{
             $code = 1;
         }
         header('Content-Type: text/xml');
        include 'xml/script1.php';
     }
     
     public static function iptest(){
         return $_SERVER['REMOTE_ADDR'] == '81.119.165.131' ||
                 $_SERVER['REMOTE_ADDR'] == '81.113.175.233'||
                 $_SERVER['REMOTE_ADDR'] == '127.0.0.1';
     }
     
}
