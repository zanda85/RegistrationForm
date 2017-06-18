<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Workshop
 *
 * @author davide
 */
class Workshop {
    public $id;
    public $conf_id;
    public $title;
    
    public function copy(Workshop $w){
        $this->id = $w->id;
        $this->conf_id = $w->conf_id;
        $this->title = $w->title;
    }
}
