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
    public $vat;
    public $membershipId;
    public $membershipName;
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
    public $ipaddress;
    public $otp;
    public $cf;
    public $idNumber;
    public $invoiceType;
    public $birthDate;
    public $birthPlace;
    
    // state 0 = not paid
    // state 1 = paid with credit card
    // state 2 = paid with bank transfer
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
    
    public function getTotalCost(){
        $cost = 0;
        foreach ($this->extras as $e){
            $cost += $e->cost * $e->count;
        }
        
        $cost += $this->getRegType()->cost;
        
        return $cost;
    }
    
    public function getDietaryString(){
        $s = '';
        $s .= $this->meatfree == 1 ? 'Meat free diet, ' : '';
        $s .= $this->fishfree == 1 ? 'Fish free diet, ' : '';
        $s .= $this->shellfishfree == 1 ? 'Shellfish free diet, ' : '';
        $s .= $this->eggfree == 1 ? 'Egg free diet, ' : '';
        $s .= $this->milkfree == 1 ? 'Milt/Lactose free diet, ' : '';
        $s .= $this->animalfree == 1 ? 'Diet free of animal derived products, ' : '';
        $s .= $this->glutenfree == 1 ? 'Gluten free diet, ' : '';
        $s .= $this->peanutfree == 1 ? 'Peanut free diet, ' : '';
        $s .= $this->wheatfree == 1 ? 'Wheat free diet, ' : '';
        $s .= $this->soyfree == 1 ? 'Soy free diet, ' : '';
        $s .= $this->additionaldiet;
        
        if(strlen($s) > 0 && strlen($this->additionaldiet) == 0){
            $s = substr($s, 0, -2);
        }
        
        if(strlen($s) == 0){
            $s = 'None';
        }
        
        return $s;
        
    }
    
    public function getExtraCount($id){
        foreach($this->extras as $e){
            if($e->id == $id){
                return $e->count;
            }
        }
        return 0;
    }
    
    public function getStateString(){
       return Participant::getStateStringFromCode($this->state);
    }
    
    public static function getStateStringFromCode($code){
         switch($code){
            case 0: return 'None';
            case 1: return 'Card';
            case 2: return 'Bank';
        }
    }
}
