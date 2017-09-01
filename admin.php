<?php

include_once 'classes/DbManager.php';
include_once 'classes/NationList.php';

date_default_timezone_set("Europe/Rome");
// punto unico di accesso all'applicazione
AdminController::dispatch($_REQUEST);

class AdminController {

    public static function dispatch(&$request) {

        //TODO inserire un blocco per connessioni non https

        header('Content-type: text/html; charset=ISO-8859-1');

        //var_dump($request);

        if (isset($request['cmd'])) {
            $cmd = $request['cmd'];

            switch ($cmd) {

                case 'login':
                    if (AdminController::checkLogin($request)) {
                        AdminController::conferenceList();
                    } else {
                        $error = true;
                        AdminController::loginForm();
                    }
                    break;
                case 'list':
                    if (AdminController::checkLogin($request)) {
                        AdminController::conferenceList();
                    } else {
                        $error = true;
                        AdminController::loginForm();
                    }
                    break;
                case 'logout':
                    $_SESSION = array();

                    if (ini_get("session.use_cookies")) {
                        $params = session_get_cookie_params();
                        setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]
                        );
                    }
                    session_destroy();
                    AdminController::loginForm();
                    break;
                case 'conf':
                    if (AdminController::checkLogin($request)) {
                        $confId = $request['id'];
                        $state = isset($request['state']) ? intval($request['state']) : -1;
                        if (isset($request['paid'])) {
                            DbManager::instance()->finalisePayment($request['pid'], 2);
                        }

                        if (isset($request['download'])) {
                            AdminController::csvDownload($confId, $state);
                        } else {
                            AdminController::participantsList($confId, $state);
                        }
                    } else {
                        $error = true;
                        AdminController::loginForm();
                    }
                    break;
                default:
                    AdminController::loginForm();
                    break;
            }
        } else {
            AdminController::loginForm();
        }
    }

    public static function participantsList($confId, $state) {
        $conference = DbManager::instance()->getConferenceById($confId);
        $participants = DbManager::instance()->getParticipants($confId, $state);
        $sum = 0;
        foreach ($participants as $p) {
            DbManager::instance()->lazyLoadParticipant($p);
            $sum += $p->state > 0 ? $p->getTotalCost() : 0;
        }
        include 'views/admin/list.php';
    }

    public static function conferenceList() {
        $conferences = DbManager::instance()->getAllConferences();
        include 'views/admin/conferences.php';
    }

    public static function loginForm() {

        //$regs = DbManager::instance()->getRegTypes($keys->conf, 1);
        include 'views/admin/login.php';
    }

    public static function checkLogin(&$request) {
        session_start();

        if ($request['user'] == 'admin' && $request['password'] == 'dipmatinf01') {
            $_SESSION['admin'] = true;
        }

        return isset($_SESSION['admin']) && $_SESSION['admin'];
    }

    public static function write404() {
        // impostiamo il codice della risposta http a 404 (file not found)
        header('HTTP/1.0 404 Not Found');
        echo '<h1>404 Not Found </h1>';
        echo "Sorry, the page you requested is not available :(";
        exit();
    }

    public static function csvDownload($confId, $state, $delimiter = ";") {
        $conference = DbManager::instance()->getConferenceById($confId);
        $stateSuffix = $state == -1 ? "" : Participant::getStateStringFromCode($state);
        $filename = $conference->code . $stateSuffix . date('Ymd') . ".csv";
        $participants = DbManager::instance()->getParticipants($confId, $state);
        $sum = 0;
        foreach ($participants as $p) {
            DbManager::instance()->lazyLoadParticipant($p);
            $sum += $p->state > 0 ? $p->getTotalCost() : 0;
        }
        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '";');

        // open the "output" stream
        // see http://www.php.net/manual/en/wrappers.php.php#refsect2-wrappers.php-unknown-unknown-unknown-descriptioq
        $f = fopen('php://output', 'w');

        $line = array(
            '#ID',
            'Last Name',
            'First Name',
            'email',
            'Cost',
            'State',
            'Company',
            'Birth Date',
            'Birth Place',
            'CF',
            'VAT',
            'Address',
            'ZIP',
            'City',
            'Co.'
        );
        fputcsv($f, $line, $delimiter);

        foreach ($participants as $p) {
            $i = 0;
            $line[$i++] = $p->id;
            $line[$i++] = $p->lastname;
            $line[$i++] = strlen(trim($p->middlename)) > 0 ?
                    $p->middlename . " " . $p->firstname :
                    $p->firstname;
            $line[$i++] = $p->email;
            $line[$i++] = $p->getTotalCost();
            $line[$i++] = $p->getStateString();
            $line[$i++] = $p->company;
            $line[$i++] = $p->birthDate;
            $line[$i++] = $p->birthPlace;
            $line[$i++] = $p->cf;
            $line[$i++] = $p->vat;
            $line[$i++] = $p->addressline1 . "\n\r" . $p->addressline2;
            $line[$i++] = $p->zip;
            $line[$i++] = $p->city;
            $line[$i++] = $p->country;
            fputcsv($f, $line, $delimiter);
        }
    }

}

?>