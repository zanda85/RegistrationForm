<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Extra
 *
 * @author davide
 */
class Extra {
    public $id;
    public $conf_id;
    public $title;
    public $cost;
    public $count;
    
    public function copy(Extra $e){
        $this->id = $e->id;
        $this->conf_id = $e->conf_id;
        $this->title = $e->title;
        $this->cost =$e->cost;
        $this->count = $e->count;
    }
}
