<?php
namespace App\Utils;

class Date{

    public $date;

    function __construct($date = null){
        $this->date = $date ? date($date) : $this->today();
    }
   
    public function today(){
        return date('Y-m-d');     
    }
    public function between($date_start,$date_end,$specificDate = false){
        $dateToCompare = $specificDate ? $specificDate : $this->date;
        return ($dateToCompare >= $date_start) && ($dateToCompare <= $date_end);
    }
    public function formatDDMMYYYY($date = false){
        $date = $date ? date_create($date) : $this->date;
        return date_format($date,"d/m/Y");
    }
}