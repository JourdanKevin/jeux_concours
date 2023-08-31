<?php

namespace App\Models\Entity\Table;
use App\Models\Entity\EntityModels;

class Table extends EntityModels { //name class as name of the table

    //fields :
    public $id;
    //entity relations :  
    protected $joins = [ //put the relation table in key, and give in array the secondary key and the primary key of relation table
        "RelationTable" => ["id_fromThisTable","primayKeyToRelationTable"]
    ];   
    
    
    function __construct($connect = true){
        parent::__construct($connect);        
    }
    //request
    public function get_all(){
        $this->createSQL_and_query([
            "select" => "*"
        ]);
        var_dump($this->get_datas());
    }

}