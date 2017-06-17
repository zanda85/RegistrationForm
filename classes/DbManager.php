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
