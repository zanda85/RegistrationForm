<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DbManager
 *
 * @author davide
 */
include_once 'RegType.php';
include_once 'Participant.php';
include_once 'Workshop.php';
include_once 'Extra.php';
include_once 'Conference.php';

class DbManager {

    public static $db_host = 'localhost';
    public static $db_user = 'regapp';
    public static $db_password = 'caic89900e';
    public static $db_name = 'registrations';
    private static $singleton;

    private function __constructor() {
        
    }

    public static function instance() {
        if (!isset(self::$singleton)) {
            self::$singleton = new DbManager();
        }

        return self::$singleton;
    }

    public function getRegTypes($code, $available) {
        $mysqli = $this->getConnection();
        $regs = array();

        $query = "select regtype.id, 
                        regtype.conference_id, 
                        regtype.title,
                        regtype.cost,
                        regtype.has_workshop, 
                        regtype.has_membership,
                        regtype.available
                        from regtype join conference on 
                        regtype.conference_id = conference.id 
                        where conference.code = ? and regtype.available = ?";
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);

        if (!$stmt) {
            goto error;
        }

        $available = filter_var($available, FILTER_VALIDATE_INT) ? $available : 1;
        $ok = $stmt->bind_param(
                'si', $code, $available);
        if (!$ok) {
            goto error;
        }

        $ok = $stmt->execute();
        if (!$ok) {
            goto error;
        }

        $regtype = new RegType();

        $stmt->bind_result(
                $regtype->id, $regtype->conferenceId, $regtype->title, $regtype->cost, $regtype->hasWorkshop, $regtype->hasMembership, $regtype->available);

        while ($stmt->fetch()) {
            $item = new RegType();
            $item->copy($regtype);
            array_push($regs, $item);
        }

        $mysqli->close();
        return $regs;

        error: {
            error_log("[DbManager] error on database access ");
            $mysqli->close();
            return $regs;
        }
    }

    public function getOrCreateParticipant($email, $regtype) {


        $participant = $this->getParticipantByEmailRegType($email, $regtype);
        if ($participant == null) {
            $this->createEmptyParticipant($email, $regtype);
            $participant = $this->getParticipantByEmailRegType($email, $regtype);
        }

        return $participant;
    }

    public function getParticipants($confId, $state) {
        $mysqli = $this->getConnection();

        if ($state == -1) {
            $query = "select " .
                    $this->getParticipantFields()
                    . "from participant as p 
                        join regtype as r on p.regtype_id = r.id
                        where conference_id = ? 
                        order by p.id";
        } else {
            $s = intval($state);
            $query = "select " .
                    $this->getParticipantFields()
                    . "from participant as p 
                        join regtype as r on p.regtype_id = r.id
                        where conference_id = ? and p.state = $s "
                    . "order by p.id";
        }


        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);

        if (!$stmt) {
            goto error;
        }

        $id = filter_var($id, FILTER_VALIDATE_INT) ? $id : -1;

        $ok = $stmt->bind_param(
                'i', $confId);
        if (!$ok) {
            goto error;
        }

        $participants = array();
        $stop = false;
        $ok = $stmt->execute();
        if (!$ok) {
            goto error;
        }

        $p = new Participant();
        $regtype = new RegType();
        $p->setRegType($regtype);
        $this->bindParticipant($stmt, $p, $regtype);

        while ($stmt->fetch()) {
            $participants [] = $p;
            $p = new Participant();
            $regtype = new RegType();
            
            $this->bindParticipant($stmt, $p, $regtype);
            $p->setRegType($regtype);
        }
        
        $stmt->close();
        $mysqli->close();

        return $participants;

        error: {
            error_log("[DbManager] error on database access ");
            $mysqli->close();
            return null;
        }
    }

    public function getParticipantById($id) {
        $mysqli = $this->getConnection();

        $query = "select " .
                $this->getParticipantFields()
                . "from participant as p 
                        join regtype as r on p.regtype_id = r.id
                        where p.id = ?";

        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);

        if (!$stmt) {
            goto error;
        }

        $id = filter_var($id, FILTER_VALIDATE_INT) ? $id : -1;

        $ok = $stmt->bind_param(
                'i', $id);
        if (!$ok) {
            goto error;
        }

        return $this->retrieveParticipant($mysqli, $stmt);

        error: {
            error_log("[DbManager] error on database access ");
            $mysqli->close();
            return null;
        }
    }

    public function getParticipantByEmailRegType($email, $regtype) {
        $mysqli = $this->getConnection();

        $query = "select " .
                $this->getParticipantFields()
                . "from participant as p 
                        join regtype as r on p.regtype_id = r.id
                        where p.email = ? and 
                        p.regtype_id = ?";

        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);

        if (!$stmt) {
            goto error;
        }

        $regtype = filter_var($regtype, FILTER_VALIDATE_INT) ? $regtype : -1;

        $ok = $stmt->bind_param(
                'si', $email, $regtype);
        if (!$ok) {
            goto error;
        }

        return $this->retrieveParticipant($mysqli, $stmt);

        error: {
            error_log("[DbManager] error on database access ");
            $mysqli->close();
            return null;
        }
    }

    private function getParticipantFields() {
        return "p.id,
                p.regtype_id, 
                p.email,
                p.prefix,
                p.firstname,
                p.middlename,
                p.lastname,
                p.jobtitle,
                p.badge,
                p.company,
                p.country,
                p.addressline1,
                p.addressline2,
                p.city,
                p.zip,
                p.vat,
                p.membership_id,
                p.membership_name,
                p.meatfree,
                p.fishfree,
                p.shellfishfree,
                p.eggfree, 
                p.milkfree, 
                p.animalfree, 
                p.glutenfree,
                p.peanutfree,
                p.wheatfree, 
                p.soyfree,
                p.additionaldiet,
                p.state,
                p.ipaddress,
                p.otp,
                p.cf,
                p.id_number,
                p.invoice_type,
                p.birth_place,
                DATE_FORMAT(p.birth_date, '%m/%d/%Y'),
                r.id, 
                r.conference_id, 
                r.title,
                r.cost,
                r.has_workshop, 
                r.has_membership,
                r.available 
                ";
    }

    private function bindParticipant($stmt, $p, $regtype) {
        $stmt->bind_result(
                $p->id, 
                $p->regtype_id, 
                $p->email, 
                $p->prefix, 
                $p->firstname, 
                $p->middlename, 
                $p->lastname, 
                $p->jobtitle, 
                $p->badge, 
                $p->company, 
                $p->country, 
                $p->addressline1, 
                $p->addressline2, 
                $p->city, 
                $p->zip, 
                $p->vat, 
                $p->membershipId, 
                $p->membershipName, 
                $p->meatfree, 
                $p->fishfree, 
                $p->shellfishfree, 
                $p->eggfree, 
                $p->milkfree, 
                $p->animalfree, 
                $p->glutenfree, 
                $p->peanutfree, 
                $p->wheatfree, 
                $p->soyfree, 
                $p->additionaldiet, 
                $p->state, 
                $p->ipaddress, 
                $p->otp, 
                $p->cf, 
                $p->idNumber, 
                $p->invoiceType, 
                $p->birthPlace, 
                $p->birthDate, 
                $regtype->id, 
                $regtype->conferenceId, 
                $regtype->title, 
                $regtype->cost, 
                $regtype->hasWorkshop, 
                $regtype->hasMembership, 
                $regtype->available);
    }

    private function retrieveParticipant($mysqli, $stmt) {
        $ok = $stmt->execute();
        if (!$ok) {
            goto error;
        }

        $p = new Participant();
        $regtype = new RegType();

        $this->bindParticipant($stmt, $p, $regtype);

        if ($stmt->fetch()) {
            $mysqli->close();
            $p->setRegType($regtype);
            return $p;
        } else {
            $mysqli->close();
            return null;
        }

        error: {
            error_log("[DbManager] error on database access ");
            $mysqli->close();
            return null;
        }
    }

    private function createEmptyParticipant($email, $regtype) {
        $mysqli = $this->getConnection();

        $query = "insert into participant (id, email, regtype_id, state) 
                  values (default, ?, ?, 0 )";
        $regtype = filter_var($regtype, FILTER_VALIDATE_INT) ? $regtype : -1;

        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);

        if (!$stmt) {
            goto error;
        }

        $ok = $stmt->bind_param(
                'si', $email, $regtype);
        if (!$ok) {
            goto error;
        }

        $ok = $stmt->execute();
        if (!$ok) {
            goto error;
        }

        $id = $mysqli->insert_id;
        $mysqli->close();
        return $id;


        error: {
            error_log("[DbManager] error on database access ");
            $mysqli->close();
            return -1;
        }
    }

    public function updateParticipant(Participant $p) {
        $mysqli = $this->getConnection();

        $query = "update participant set
                        email = ?,
                        prefix = ?,
                        firstname = ?,
                        middlename = ?,
                        lastname = ?,
                        jobtitle = ?,
                        badge = ?,
                        company = ?,
                        country = ?,
                        addressline1 = ?,
                        addressline2 = ?,
                        city = ?,
                        zip = ?,
                        vat = ?,
                        membership_name = ?,
                        membership_id = ?,
                        meatfree = ?,
                        fishfree = ?,
                        shellfishfree = ?,
                        eggfree = ?, 
                        milkfree = ?, 
                        animalfree = ?, 
                        glutenfree = ?,
                        peanutfree = ?,
                        wheatfree = ?, 
                        soyfree = ?,
                        additionaldiet = ?,
                        state = ?,
                        ipaddress = ?,
                        cf = ?,
                        id_number = ?,
                        invoice_type = ?,
                        birth_place = ?,
                        birth_date = STR_TO_DATE(?, '%m/%d/%Y')
                        where id = ?";

        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);

        if (!$stmt) {
            goto error;
        }

        $ok = $stmt->bind_param(
                'ssssssssssssssssiiiiiiiiiisisssissi', $p->email, $p->prefix, $p->firstname, $p->middlename, $p->lastname, $p->jobtitle, $p->badge, $p->company, $p->country, $p->addressline1, $p->addressline2, $p->city, $p->zip, $p->vat, $p->membershipName, $p->membershipId, $p->meatfree, $p->fishfree, $p->shellfishfree, $p->eggfree, $p->milkfree, $p->animalfree, $p->glutenfree, $p->peanutfree, $p->wheatfree, $p->soyfree, $p->additionaldiet, $p->state, $p->ipaddress, $p->cf, $p->idNumber, $p->invoiceType, $p->birthPlace, $p->birthDate, $p->id);
        if (!$ok) {
            goto error;
        }

        $ok = $stmt->execute();
        if (!$ok) {
            goto error;
        }

        $ok = ($mysqli->affected_rows == 1);
        $mysqli->close();

        return $ok;

        error: {
            error_log("[DbManager] error on database access ");
            $mysqli->close();
            return false;
        }
    }

    public function getWorkshopsByConfId($conf_id) {
        $mysqli = $this->getConnection();
        $workshops = array();

        $query = "select workshop.id, 
                        workshop.conference_id, 
                        workshop.title
                        from workshop
                        where workshop.conference_id = ?";
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);

        if (!$stmt) {
            goto error;
        }

        $conf_id = filter_var($conf_id, FILTER_VALIDATE_INT) ? $conf_id : 1;
        $ok = $stmt->bind_param(
                'i', $conf_id);
        if (!$ok) {
            goto error;
        }

        $ok = $stmt->execute();
        if (!$ok) {
            goto error;
        }

        $w = new Workshop();

        $stmt->bind_result(
                $w->id, $w->conference_id, $w->title);

        while ($stmt->fetch()) {
            $item = new Workshop();
            $item->copy($w);
            array_push($workshops, $item);
        }

        $mysqli->close();
        return $workshops;

        error: {
            error_log("[DbManager] error on database access ");
            $mysqli->close();
            return $workshops;
        }
    }

    public function getExtraByConfId($conf_id) {
        $mysqli = $this->getConnection();
        $extras = array();

        $query = "select extra.id, 
                        extra.conference_id, 
                        extra.title,
                        extra.cost
                        from extra
                        where extra.conference_id = ?";
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);

        if (!$stmt) {
            goto error;
        }

        $conf_id = filter_var($conf_id, FILTER_VALIDATE_INT) ? $conf_id : 1;
        $ok = $stmt->bind_param(
                'i', $conf_id);
        if (!$ok) {
            goto error;
        }

        $ok = $stmt->execute();
        if (!$ok) {
            goto error;
        }

        $e = new Extra();

        $stmt->bind_result(
                $e->id, $e->conference_id, $e->title, $e->cost);

        while ($stmt->fetch()) {
            $item = new Extra();
            $item->copy($e);
            array_push($extras, $item);
        }

        $mysqli->close();
        return $extras;

        error: {
            error_log("[DbManager] error on database access ");
            $mysqli->close();
            return $extras;
        }
    }

    public function insertWorkshop($p_id, $w_id) {
        $mysqli = $this->getConnection();

        $query = "insert into workshop_participant (workshop_id, participant_id) 
                  values (?,?)";
        $p_id = filter_var($p_id, FILTER_VALIDATE_INT) ? $p_id : -1;
        $w_id = filter_var($w_id, FILTER_VALIDATE_INT) ? $w_id : -1;

        if ($p_id == -1 || $w_id == -1) {
            goto error;
        }

        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);

        if (!$stmt) {
            goto error;
        }

        $ok = $stmt->bind_param(
                'ii', $w_id, $p_id);
        if (!$ok) {
            goto error;
        }

        $ok = $stmt->execute();
        if (!$ok) {
            goto error;
        }

        $mysqli->close();
        return true;


        error: {
            error_log("[DbManager] error on database access ");
            $mysqli->close();
            return false;
        }
    }

    public function insertExtra($p_id, $e_id, $val) {
        $mysqli = $this->getConnection();

        $query = "insert into extra_participant (extra_id, participant_id, count) 
                  values (?,?,?)";
        $p_id = filter_var($p_id, FILTER_VALIDATE_INT) ? $p_id : -1;
        $e_id = filter_var($e_id, FILTER_VALIDATE_INT) ? $e_id : -1;
        $val = filter_var($val, FILTER_VALIDATE_INT) ? $val : -1;

        if ($p_id == -1 || $e_id == -1 || $val == -1) {
            goto error;
        }

        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);

        if (!$stmt) {
            goto error;
        }

        $ok = $stmt->bind_param(
                'iii', $e_id, $p_id, $val);
        if (!$ok) {
            goto error;
        }

        $ok = $stmt->execute();
        if (!$ok) {
            goto error;
        }

        $mysqli->close();
        return true;


        error: {
            error_log("[DbManager] error on database access ");
            $mysqli->close();
            return false;
        }
    }

    public function deleteWorkshops($p_id) {
        $mysqli = $this->getConnection();

        $query = "delete from workshop_participant where participant_id = ?";
        $p_id = filter_var($p_id, FILTER_VALIDATE_INT) ? $p_id : -1;

        if ($p_id == -1) {
            goto error;
        }

        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);

        if (!$stmt) {
            goto error;
        }

        $ok = $stmt->bind_param(
                'i', $p_id);
        if (!$ok) {
            goto error;
        }

        $ok = $stmt->execute();
        if (!$ok) {
            goto error;
        }

        $mysqli->close();
        return true;


        error: {
            error_log("[DbManager] error on database access ");
            $mysqli->close();
            return false;
        }
    }

    public function deleteExtras($p_id) {
        $mysqli = $this->getConnection();

        $query = "delete from extra_participant where participant_id = ?";
        $p_id = filter_var($p_id, FILTER_VALIDATE_INT) ? $p_id : -1;

        if ($p_id == -1) {
            goto error;
        }

        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);

        if (!$stmt) {
            goto error;
        }

        $ok = $stmt->bind_param(
                'i', $p_id);
        if (!$ok) {
            goto error;
        }

        $ok = $stmt->execute();
        if (!$ok) {
            goto error;
        }

        $mysqli->close();
        return true;


        error: {
            error_log("[DbManager] error on database access ");
            $mysqli->close();
            return false;
        }
    }

    public function lazyLoadParticipant(Participant $p) {
        $mysqli = $this->getConnection();
        $workshops = array();

        $query = "select workshop.id, 
                        workshop.conference_id, 
                        workshop.title
                        from workshop_participant
                        join workshop on workshop_participant.workshop_id = workshop.id
                        where workshop_participant.participant_id = ?";
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);

        if (!$stmt) {
            goto error;
        }

        $ok = $stmt->bind_param(
                'i', $p->id);
        if (!$ok) {
            goto error;
        }

        $ok = $stmt->execute();
        if (!$ok) {
            goto error;
        }

        $w = new Workshop();

        $stmt->bind_result(
                $w->id, $w->conference_id, $w->title);

        while ($stmt->fetch()) {
            $item = new Workshop();
            $item->copy($w);
            array_push($workshops, $item);
        }

        $p->setWorkshops($workshops);

        $extras = array();
        $query = "select extra.id, 
                        extra.conference_id, 
                        extra.title,
                        extra.cost,
                        extra_participant.count
                        from extra_participant
                        join extra on extra_participant.extra_id = extra.id
                        where extra_participant.participant_id = ?";
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);

        if (!$stmt) {
            goto error;
        }

        $ok = $stmt->bind_param(
                'i', $p->id);
        if (!$ok) {
            goto error;
        }

        $ok = $stmt->execute();
        if (!$ok) {
            goto error;
        }

        $e = new Extra();

        $stmt->bind_result(
                $e->id, $e->conference_id, $e->title, $e->cost, $e->count);

        while ($stmt->fetch()) {
            $item = new Extra();
            $item->copy($e);
            array_push($extras, $item);
        }

        $mysqli->close();

        $p->setExtras($extras);

        return;

        error: {
            error_log("[DbManager] error on database access ");
            $mysqli->close();
            return $workshops;
        }
    }

    public function getAllConferences() {
        $mysqli = $this->getConnection();

        $query = "select conference.id, 
                        conference.title, 
                        conference.code,
                        conference.vendor,
                        conference.open,
                        conference.terminal,
                        conference.numeraurl
                        from conference
                        order by id desc";
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);

        if (!$stmt) {
            goto error;
        }




        $ok = $stmt->execute();
        if (!$ok) {
            goto error;
        }

        $conferences = array();
        do {
            $c = new Conference();
            $conferences[] = $c;
            $stmt->bind_result(
                    $c->id, $c->title, $c->code, $c->vendor, $c->open, $c->terminal, $c->numeraurl);
        } while ($stmt->fetch());

        array_pop($conferences);

        $mysqli->close();
        return $conferences;

        error: {
            error_log("[DbManager] error on database access ");
            $mysqli->close();
            return null;
        }
    }

    public function getConferenceByCode($code) {
        $mysqli = $this->getConnection();

        $query = "select conference.id, 
                        conference.title, 
                        conference.code,
                        conference.vendor,
                        conference.open,
                        conference.terminal,
                        conference.numeraurl
                        from conference
                        where conference.code = ?";
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);

        if (!$stmt) {
            goto error;
        }


        $ok = $stmt->bind_param(
                's', $code);
        if (!$ok) {
            goto error;
        }

        $ok = $stmt->execute();
        if (!$ok) {
            goto error;
        }

        $c = new Conference();

        $stmt->bind_result(
                $c->id, $c->title, $c->code, $c->vendor, $c->open, $c->terminal, $c->numeraurl);

        if (!$stmt->fetch()) {
            goto error;
        }

        $mysqli->close();
        return $c;

        error: {
            error_log("[DbManager] error on database access ");
            $mysqli->close();
            return null;
        }
    }

    public function getConferenceById($conf_id) {
        $mysqli = $this->getConnection();

        $query = "select conference.id, 
                        conference.title, 
                        conference.code,
                        conference.vendor,
                        conference.open,
                        conference.terminal,
                        conference.numeraurl
                        from conference
                        where conference.id = ?";
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);

        if (!$stmt) {
            goto error;
        }

        $conf_id = filter_var($conf_id, FILTER_VALIDATE_INT) ? $conf_id : -1;
        $ok = $stmt->bind_param(
                'i', $conf_id);
        if (!$ok) {
            goto error;
        }

        $ok = $stmt->execute();
        if (!$ok) {
            goto error;
        }

        $c = new Conference();

        $stmt->bind_result(
                $c->id, $c->title, $c->code, $c->vendor, $c->open, $c->terminal, $c->numeraurl);

        if (!$stmt->fetch()) {
            goto error;
        }

        $mysqli->close();
        return $c;

        error: {
            error_log("[DbManager] error on database access ");
            $mysqli->close();
            return null;
        }
    }

    public function setOtp($id, $otp) {
        $mysqli = $this->getConnection();

        $query = "update participant set
                        otp = ?
                        where id = ?";

        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);

        if (!$stmt) {
            goto error;
        }

        $ok = $stmt->bind_param(
                'si', $otp, $id);
        if (!$ok) {
            goto error;
        }

        $ok = $stmt->execute();
        if (!$ok) {
            goto error;
        }


        $mysqli->close();

        return true;

        error: {
            error_log("[DbManager] error on database access ");
            $mysqli->close();
            return false;
        }
    }

    public function finalisePayment($id, $state = 1) {
        $mysqli = $this->getConnection();

        $query = "update participant set
                        state = ?,
                        closed = curdate()
                        where id = ?";

        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);

        if (!$stmt) {
            goto error;
        }

        $ok = $stmt->bind_param(
                'ii', $state, $id);
        if (!$ok) {
            goto error;
        }

        $ok = $stmt->execute();
        if (!$ok) {
            goto error;
        }

        $ok = ($mysqli->affected_rows == 1);
        $mysqli->close();

        return $ok;

        error: {
            error_log("[DbManager] error on database access ");
            $mysqli->close();
            return false;
        }
    }

    private function getConnection() {
        $mysqli = new mysqli();
        $mysqli->connect(DbManager::$db_host, DbManager::$db_user, DbManager::$db_password, DbManager::$db_name);
        if ($mysqli->errno != 0) {
            return null;
        } else {
            return $mysqli;
        }
    }

}
