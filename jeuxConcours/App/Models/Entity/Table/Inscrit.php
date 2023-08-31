<?php

namespace App\Models\Entity\Table;
use App\Models\Entity\EntityModels;

class Inscrit extends EntityModels {

    //fields :
    public $id;
    public $nom;
    public $prenom;
    public $code_postal;
    public $email;
    public $date_naissance;
    public $adresse;
    public $ville;
    public $telephone;
    public $id_operation;
    //entity relations :  
    protected $joins = [
        "operation" => ["id_operation","id"]
    ];       
    
    function __construct($connect = true, $from = ""){ //replace from by a list of all come
        parent::__construct($connect,$from);        
    }
    public function Save(){
       return $this->createSQL_and_query([
                "insert" =>[
                        "nom",
                        "prenom",
                        "code_postal",
                        "email",
                        "date_naissance",
                        "adresse",
                        "ville",
                        "telephone",
                        "id_operation"]],$_POST,"succes");
    }
    public function checkMail($mail, $id_operation){//$mail, $id_operation
        return $this->createSQL_and_query([
            "select" => "id",
            "where" => ["email","id_operation"],
        ],["email" => $mail, "id_operation" => $id_operation],"exist");
    }
    public function tirage(){
        $this->createSQL_and_query([
            "select" => [
                "id",
                "nom",
                "prenom",
                "date_naissance",
                "adresse",
                "ville",
                "code_postal",
                "email",
                "telephone",
        ],
            "orderBy" => "RAND()",
            "limit" => 1
        ]);
        var_dump($this->response());       

    }

}