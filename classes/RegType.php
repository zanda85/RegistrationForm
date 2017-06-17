<?php

/**
 * Description of RegType
 *
 * @author davide
 */
class RegType {
    public $id;
    public $conference_id;
    public $title;
    public $cost;
    public $available;
    public $has_workshop;
    
    public function copy(RegType $t) {
        $this->id =  $t->id;
        $this->conference_id =  $t->conference_id;
        $this->title =  $t->title;
        $this->cost =  $t->cost;
        $this->available =  $t->available;
        $this->has_workshop =  $t->has_workshop;
        
    }
}
