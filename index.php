<?php

include_once 'classes/DbManager.php';
include_once 'classes/NationList.php';

date_default_timezone_set("Europe/Rome");
// punto unico di accesso all'applicazione
FrontController::dispatch($_REQUEST);

class FrontController {

    public static function dispatch(&$request) {

        //TODO inserire un blocco per connessioni non https

        session_start();
        
        
        if (isset($request['keyord'])) {
            $partId = $request['keyord'];
            $p = new Participant();
            $p->id = filter_var($partId, FILTER_VALIDATE_INT) ? $partId : -1;
            FrontController::loadSummary($request, $p, true);
            return;
        }

        
        

        $step = $request['step'];
        $keys = FrontController::populateKeys( $request);
        if($keys == null){
            FrontController::write404();
            return;
        }

        switch ($step) {
            case 's1':

                $email1 = $request['email1'];
                $email2 = $request['email2'];
                $regId = str_replace("reg", "", $request['regtype']);

                if ($email1 == $email2 &&
                        filter_var($email1, FILTER_VALIDATE_EMAIL) &&
                        filter_var($regId, FILTER_VALIDATE_INT)) {
                    $keys->email = $email1;
                    $keys->regId = $regId;
                    $p = DbManager::instance()->getOrCreateParticipant($keys->email, $keys->regId);
                    
                    if($p->state == 1){
                        // registration completed
                        FrontController::loadSummary($request, $p, false);
                    }else{
                        // registration in progress
                        $keys->participantId = $p->id;
                        FrontController::loadPersonalStep($keys, $p);
                    }
                    
                    
                } else {
                    FrontController::loadInitialStep($keys);
                }
                break;

            case 's2':
                $partId = $request['partId'];
                $p = new Participant();
                $p->id = filter_var($partId, FILTER_VALIDATE_INT) ? $partId : -1;
                $p = DbManager::instance()->getParticipantById($partId);
                if (FrontController::populateParticipant($p, $request)) {
                    DbManager::instance()->updateParticipant($p);
                    DbManager::instance()->lazyLoadParticipant($p);
                    $workshops = DbManager::instance()->getWorkshopsByConfId($p->getRegType()->conference_id);
                    $extras = DbManager::instance()->getExtraByConfId($p->getRegType()->conference_id);
                    FrontController::loadWorkshopExtraStep($keys, $p, $workshops, $extras);
                } else {
                    // something wrong, go to step 1
                    $keys->email = $p->email;
                    $keys->regId = $p->regtype_id;
                    $keys->participantId = $p->id;
                    FrontController::loadPersonalStep($keys, $p);
                }
                break;

            case 's3':
                $partId = $request['partId'];
                $p = new Participant();
                $p->id = filter_var($partId, FILTER_VALIDATE_INT) ? $partId : -1;
                FrontController::loadSummary($request, $p, false);
                break;


            default:
                FrontController::loadInitialStep($keys);
                break;
        }
    }

    public static function populateKeys( &$request){
        $keys = new Keys();
        switch ($request['conf']) {
            case 'chitaly2017':
                $keys->logo = "chitaly2017/logo.png";
                $keys->conf = 'chitaly2017';
                return $keys;

            default:
                
                return null;
        }
    }
    
    public static function loadInitialStep($keys) {

        $regs = DbManager::instance()->getRegTypes($keys->conf, 1);
        include 'views/login.php';
    }

    public static function loadPersonalStep($keys, $p) {
        $logo = $keys->logo;
        $nations = NationList::getMap();
        include 'views/personal.php';
    }

    public static function loadWorkshopExtraStep($keys, $p, $workshops, $extras) {

        include 'views/workshops.php';
    }

    public static function loadSummary(&$request, $p, $numera) {
        $p = DbManager::instance()->getParticipantById($p->id);
        FrontController::addWorkshopExtra($p, $request);
        DbManager::instance()->lazyLoadParticipant($p);
        $workshops = DbManager::instance()->getWorkshopsByConfId($p->getRegType()->conference_id);
        $extras = DbManager::instance()->getExtraByConfId($p->getRegType()->conference_id);
        $conf = DbManager::instance()->getConferenceById($p->getRegType()->conference_id);
        $request['conf'] = $conf->code;
        $keys = FrontController::populateKeys($request);
        DbManager::instance()->lazyLoadParticipant($p);
        if($p->state == 1){
            $state = "ok";
        }
        if($numera && $p->state == 0){
            $state = "nok";
        }
        if(!$numera && $p->state == 0){
            $state = "pay";
        }
        
        include 'views/summary.php';
    }

    public static function populateParticipant($p, &$request) {
        $ok = true;
        if (isset($request["prefix"])) {
            $p->prefix = $request["prefix"];
        }
        if (isset($request["name"])) {
            $p->firstname = $request["name"];
        } else {
            $ok = false;
        }
        if (isset($request["middleName"])) {
            $p->middlename = $request["middleName"];
        }
        if (isset($request["lastName"])) {
            $p->lastname = $request["lastName"];
        }
        if (isset($request["jobTitle"])) {
            $p->jobtitle = $request["jobTitle"];
        }
        if (isset($request["badgeName"])) {
            $p->badge = $request["badgeName"];
        } else {
            $ok = false;
        }
        if (isset($request["company"])) {
            $p->company = $request["company"];
        } else {
            $ok = false;
        }
        if (isset($request["contry"])) {
            $p->country = $request["contry"];
        } else {
            $ok = false;
        }
        if (isset($request["address1"])) {
            $p->addressline1 = $request["address1"];
        } else {
            $ok = false;
        }
        if (isset($request["address1"])) {
            $p->addressline2 = $request["address2"];
        }
        if (isset($request["city"])) {
            $p->city = $request["city"];
        } else {
            $ok = false;
        }
        if (isset($request["zip"])) {
            $p->zip = $request["zip"];
        } else {
            $ok = false;
        }
        if (isset($request["taxNumber"])) {
            $p->taxid = $request["taxNumber"];
        }
        if (isset($request["acm"])) {
            $p->acm = $request["acm"];
        }

        if (isset($request["diet"])) {
            foreach ($request["diet"] as $diet) {
                switch ($diet) {
                    case 'meatFree':
                        $p->meatfree = 1;
                        break;
                    case 'fishFree':
                        $p->fishfree = 1;
                        break;
                    case 'shellFishFree':
                        $p->shellfishfree = 1;
                        break;
                    case 'eggFree':
                        $p->eggfree = 1;
                        break;
                    case 'milkFree';
                        $p->milkfree = 1;
                        break;
                    case 'animalFree':
                        $p->animalfree = 1;
                        break;
                    case 'glutenFree':
                        $p->glutenfree = 1;
                        break;
                    case 'peanutFree':
                        $p->peanutfree = 1;
                        break;
                    case 'wheatFree':
                        $p->wheatfree = 1;
                        break;
                    case 'soyFree':
                        $p->soyfree = 1;
                        break;
                }
            }
        }
        if (isset($request["otherDiet"])) {
            $p->additionaldiet = $request["otherDiet"];
        }
        $p->ipaddress = $_SERVER['REMOTE_ADDR'];
        return $ok;
    }

    public static function addWorkshopExtra($p, &$request) {
        if (isset($request["w"])) {
            DbManager::instance()->deleteWorkshops($p->id);
            foreach ($request["w"] as $w) {
                $wid = str_replace("w", "", $w);
                DbManager::instance()->insertWorkshop($p->id, $wid);
            }
        }

        if (isset($request["e"])) {
            DbManager::instance()->deleteExtras($p->id);
            foreach ($request["e"] as $e) {
                $eid = str_replace("e", "", $e);
                DbManager::instance()->insertExtra($p->id, $eid);
            }
        }
    }

    public static function write404() {
        // impostiamo il codice della risposta http a 404 (file not found)
        header('HTTP/1.0 404 Not Found');
        echo '<h1>404 Not Found </h1>';
        echo "Sorry, the page you requested is not available :(";
        exit();
    }

}

class Keys {

    public $logo;
    public $conf;
    public $email;
    public $regId;
    public $participantId;
    // test
    public $numeraUrl = 'https://testnpgw.numera.it/npgw3/www/numgwp1.asp';
    // produzione
    // public $numeraUrl = 'https://npgw.numera.it/npgw3/www/numgwp1.asp';
}

?>