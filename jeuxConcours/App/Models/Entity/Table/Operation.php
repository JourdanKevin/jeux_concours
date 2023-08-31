<?php

namespace App\Models\Entity\Table;
use App\Models\Entity\EntityModels;


class Operation extends EntityModels {

    //fields :
    public $id;
    public $nom;    
    public $date_start;    
    public $date_end;
    public $id_gagnant;
    public $date_tirage;
    public $titre;
    public $logo;
    public $description;
    public $id_folder;
    //entity relations :
    protected $joins = [
        "inscrit" => ["id_gagant","id"],
    ];       

    function __construct($connect = true, $from = ""){
        parent::__construct($connect,$from);        
    }

    public function getConcour($var){
        $param = is_int($var) ? "id" : "nom";
        $this->createSQL_and_query([
            "select" => [
                "id",
                "date_start",
                "date_end",
                "titre",
                "logo",
                "description",
            ],
            "where" => [$param],
        ],[$param => $var]);
        $this->set_values();
    }

    public function up_gagant($id_gagnant,$id_concours){
        $this->createSQL_and_query([
            "update" => "id_gagnant",
            "where" => ["id"],
        ],["id_gagnant" => $id_gagnant,"id" => $id_concours],"succes");
    }

    public function up_operation(){
        $this->createSQL_and_query([
            "update" => [
               
            ],
            "where" => ["id"],
        ],$_POST,"succes");
    }

}