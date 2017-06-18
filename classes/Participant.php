<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Participant
 *
 * @author davide
 */
class Participant {
    public $id;
    public $regtype_id;
    public $email;
    public $prefix;
    public $firstname;
    public $middlename;
    public $lastname;
    public $jobtitle;
    public $badge;
    public $company;
    public $country;
    public $addressline1;
    public $addressline2;
    public $city;
    public $zip;
    public $taxid;
    public $acm;
    public $meatfree = 0;
    public $fishfree = 0;
    public $shellfishfree = 0;
    public $eggfree = 0;
    public $milkfree = 0; 
    public $animalfree = 0; 
    public $glutenfree = 0;
    public $peanutfree = 0;
    public $wheatfree = 0;
    public $soyfree = 0;
    public $additionaldiet;
    
    // state 0 = not paid
    // state 1 = paid
    public $state = 0;
    
    private $regtype;
    
    private $workshops = array();
    private $extras = array();
    
    public function setRegType(RegType $regtype){
        $this->regtype = $regtype;
    }
    
    public function getRegType(){
        return $this->regtype;
    }

    public function hasWorkshop($id){
        foreach ($this->workshops as $w){
            if ($w->id == $id){
                return true;
            }
        }
        return false;
    }
    
    public function hasExtra($id){
        foreach ($this->extras as $e){
            if ($e->id == $id){
                return true;
            }
        }
        return false;
    }
    
    public function setWorkshops($workshops){
        $this->workshops = $workshops;
    }
    
    public function getWorkshops(){
        return $this->workshops;
    }
    
    public function setExtras($extras){
        $this->extras = $extras;
    }
    
    public function getExtras(){
        return $this->extras;
    }
    
   
}
