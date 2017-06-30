<?php

/**
 * Description of RegType
 *
 * @author davide
 */
class RegType {
    public $id;
    public $conferenceId;
    public $title;
    public $cost;
    public $available;
    public $hasWorkshop;
    public $hasMembership;
    
    public function copy(RegType $t) {
        $this->id =  $t->id;
        $this->conferenceId =  $t->conferenceId;
        $this->title =  $t->title;
        $this->cost =  $t->cost;
        $this->available =  $t->available;
        $this->hasWorkshop =  $t->hasWorkshop;
        $this->hasMembership = $t->hasMembership;
        
    }
}
