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
include_once 'classes/RegType.php';
include_once 'classes/Participant.php';

class DbManager {
    public static $db_host = 'localhost';
    public static $db_user = 'regapp';
    public static $db_password = 'caic89900e';
    public static $db_name = 'registrations';
    
    private static $singleton;
    
    private function __constructor(){
    }
    
    public static function instance(){
        if(!isset(self::$singleton)){
            self::$singleton = new DbManager();
        }
        
        return self::$singleton;
    }
    
    public function getRegTypes($code, $available){
        $mysqli = $this->getConnection();
        $regs = array();
        
        $query= "select regtype.id, 
                        regtype.conference_id, 
                        regtype.title,
                        regtype.cost,
                        regtype.has_workshop, 
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
                 'si',
                 $code,
                 $available);
        if(!$ok) {goto error;}
        
        $ok = $stmt->execute();
        if(!$ok) {goto error;}
        
        $regtype = new RegType();
        
        $stmt->bind_result(
                $regtype->id, 
                $regtype->conference_id,
                $regtype->title,
                $regtype->cost,
                $regtype->has_workshop,
                $regtype->available);
        
        while($stmt->fetch()){
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
    
    public function getOrCreateParticipant($email, $regtype){
         
         
         $participant = $this->getParticipantByEmailRegType($email, $regtype);
         if($participant == null){
             $this->createEmptyParticipant($email, $regtype);
             $participant = $this->getParticipantByEmailRegType($email, $regtype);
         }
         
         return $participant;
         
    }
    
    public function getParticipantById($id){
        $mysqli = $this->getConnection();
        
        $query = "select p.id,
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
                        p.taxid,
                        p.acm,
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
                        r.id, 
                        r.conference_id, 
                        r.title,
                        r.cost,
                        r.has_workshop, 
                        r.available
                        from participant as p 
                        join regtype as r on p.regtype_id = r.id
                        where p.id = ?";
        
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
            
        if (!$stmt) {
            goto error;
        }
        
        $id = filter_var($id, FILTER_VALIDATE_INT) ? $id : -1;
        
        $ok = $stmt->bind_param(
                 'i',
                 $id);
        if(!$ok) {goto error;}
        
        $ok = $stmt->execute();
        if(!$ok) {goto error;}
        
        $p = new Participant();
        $regtype = new RegType();
        
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
                $p->taxid,
                $p->acm,
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
                $regtype->id, 
                $regtype->conference_id,
                $regtype->title,
                $regtype->cost,
                $regtype->has_workshop,
                $regtype->available);
        
        if($stmt->fetch()){
            $mysqli->close();
            $p->setRegType($regtype);
            return $p;
        }else{
            $mysqli->close();
            return null;
        }

        error: {
            error_log("[DbManager] error on database access ");
            $mysqli->close();
            return null;
        }
        
    }
    
    public function getParticipantByEmailRegType($email, $regtype){
        $mysqli = $this->getConnection();
        
        $query = "select p.id,
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
                        p.taxid,
                        p.acm,
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
                        r.id, 
                        r.conference_id, 
                        r.title,
                        r.cost,
                        r.has_workshop, 
                        r.available
                        from participant as p 
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
                 'si',
                 $email,
                 $regtype);
        if(!$ok) {goto error;}
        
        $ok = $stmt->execute();
        if(!$ok) {goto error;}
        
        $p = new Participant();
        $regtype = new RegType();
        
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
                $p->taxid,
                $p->acm,
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
                $regtype->id, 
                $regtype->conference_id,
                $regtype->title,
                $regtype->cost,
                $regtype->has_workshop,
                $regtype->available);
        
        if($stmt->fetch()){
            $mysqli->close();
            $p->setRegType($regtype);
            return $p;
        }else{
            $mysqli->close();
            return null;
        }

        error: {
            error_log("[DbManager] error on database access ");
            $mysqli->close();
            return null;
        }
        
    }
    
    private function createEmptyParticipant($email, $regtype){
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
                 'si',
                 $email,
                 $regtype);
        if(!$ok) {goto error;}
        
        $ok = $stmt->execute();
        if(!$ok) {goto error;}
        
        $id = $mysqli->insert_id;
        $mysqli->close();
        return $id;
        
        
        error: {
            error_log("[DbManager] error on database access ");
            $mysqli->close();
            return -1;
        }
    }
    
    public function updateParticipant(Participant $p){
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
                        taxid = ?,
                        acm = ?,
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
                        state = ?
                        where id = ?";
        
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
            
        if (!$stmt) {
            goto error;
        }
        
        $ok = $stmt->bind_param(
                'sssssssssssssssiiiiiiiiiisii',
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
                $p->taxid,
                $p->acm,
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
                $p->id);
        if(!$ok) {goto error;}
        
        $ok = $stmt->execute();
        if(!$ok) {goto error;}
        
        $ok = ($mysqli->affected_rows == 1);
        $mysqli->close();
        
        return $ok;
        
        error: {
            error_log("[DbManager] error on database access ");
            $mysqli->close();
            return false;
        }
    }
    
    private function getConnection(){
        $mysqli = new mysqli();
        $mysqli->connect(DbManager::$db_host, DbManager::$db_user,
        DbManager::$db_password, DbManager::$db_name);
        if($mysqli->errno != 0){
            return null;
        }else{
            return $mysqli;
        }
    }
}
