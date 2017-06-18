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
    
    public function setRegType(RegType $regtype){
        $this->regtype = $regtype;
    }
    
    public function getRegType(){
        return $this->regtype;
    }

    
   
}
