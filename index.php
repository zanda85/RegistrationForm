<?php
include_once 'classes/DbManager.php';

date_default_timezone_set("Europe/Rome");
// punto unico di accesso all'applicazione
FrontController::dispatch($_REQUEST);

class FrontController {
    
     public static function dispatch(&$request) {
         
        //TODO inserire un blocco per connessioni non https
        
        session_start();
        
        $keys = new Keys();
        switch ($request['conf']) {
            case 'chitaly2017':
                $keys->logo = "chitaly2017/logo.png";
                $keys->conf = 'chitaly2017';
                break;

            default:
                FrontController::write404();
                return;
        }
        
        $step = $request['step'];
        
        switch ($step){
            case 's1':
                
                $email1 = $request['email1'];
                $email2 = $request['email2'];
                $regId = str_replace("reg", "", $request['regtype']);
                
                if($email1 == $email2 && 
                        filter_var($email1, FILTER_VALIDATE_EMAIL) &&
                        filter_var($regId, FILTER_VALIDATE_INT)){
                    $keys->email = $email1;
                    $keys->regId = $regId;
                    FrontController::loadPersonalStep($keys);
                }else{
                    FrontController::loadInitialStep($keys);
                }
                break;
            
            default:
                FrontController::loadInitialStep($keys);
                break;
        }
        
        
        
     }
     
     
     public static function loadInitialStep($keys){
        
         $regs = DbManager::instance()->getRegTypes($keys->conf, 1);
         include 'views/login.php';
     }
     
     
     public static function loadPersonalStep($keys){
         $logo = $keys->logo;
         include 'views/personal.php';
     }
     
     public static function write404() {
        // impostiamo il codice della risposta http a 404 (file not found)
        header('HTTP/1.0 404 Not Found');
        echo '<h1>404 Not Found </h1>';
        echo "Sorry, the page you requested is not available :(";
        exit();
    }
}

class Keys{
    public $logo;
    public $conf;
    public $email;
    public $regId;
}

?>