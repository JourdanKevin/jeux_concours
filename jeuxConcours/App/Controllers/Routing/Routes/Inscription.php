<?php

namespace App\Controllers\Routing\Routes;


use App\Controllers\Routing\Routes;
use App\Models\Entity\Table\Operation;
use App\Models\Entity\Table\Inscrit;
use App\Utils\Date;
use App\Mail\Gmail;


class Inscription extends Routes{

  // public $Router; 
  private $view_form = VIEWS . "inscription/form.php";
  private $view_form_confirme = VIEWS . "inscription/confirmationTable.html";
  private $view_result = VIEWS . "enregistrement/inscriptionResult.php";
  private $view_inscriptionError = VIEWS . "enregistrement/inscriptionError.html"; 
  public $Operation;
  public $Inscrit;
  public $personnaliser = false;


  function __construct($Router){

    if($Router->method == "GET" && array_key_first($Router->params) == "formOnly" && $Router->params[array_key_first($Router->params)] == "true"){ // si on reclame uniquemement le formulaire --> pour la partie permettant de créer de nouvelles operation et permettre de visualiser le formulaire en modifiant le logo, le titre et description.
      header("Access-Control-Allow-Origin: http://localhost:8003"); 
      $this->personnaliser = true;
      $this->get_form();
    }    


    if (!$Router->nameConcours){die();}

    
    $this->Operation = New Operation();
    $this->Operation->getConcour($Router->nameConcours);
    
    $Date = new Date();    
    if($Date->between($this->Operation->date_start,$this->Operation->date_end)){ 
      parent::__construct($Router);
      $this->Inscrit = New Inscrit();
      require_once(DATAS."PATTERN.php");
      require_once(DATAS."ERROR.php");
      switch ($this->Router->method) {
        case 'GET' :
          switch (array_key_first($this->Router->params)) {
            case "checkMail" :
              echo json_encode($this->Inscrit->checkMail($this->Router->params["checkMail"],$this->Operation->id)); //check le mail via url avec fetch
              break;              
            default:
              $this->render_form();
              break;
          }
          break; 
        case 'POST':
            $this->post();
          break;
        default:
          $this->Router->homePage();
          break;
      }
      }
  }

  private function get_form(){
    $this->spe_render([
      "header",
      $this->view_form,
    ]);
  }

  private function render_form() {
    $this->scripts = "inscription";
    $this->setContent_view([
      $this->view_form_confirme,
      $this->view_form,
    ]);
    $this->render();
  }

  private function post(){ 
    if (empty($verif = $this->verifBeforePost())){
        $_POST["id_operation"] = $this->Operation->id;
        if ($result = $this->Inscrit->Save()){
            $this->sendMail();
        }
        $this->result($result);
    }
    else{    
        $this->post = $_POST;
        $this->erreur = $verif;
        $this->render_form();
    }  
}

  private function result($result){
    header ("Refresh: 4;URL= /" . $this->Router->nameConcours);
    $this->message = $result ? "Félicitation votre inscription a bien été prise en compte, un mail de confirmation vous a été envoyé a votre adresse mail !" : "Une erreur est survenue votre inscritption n'a pus aboutir veuillez réassayer"; 
    $this->setContent_view([$this->view_result]); 
    $this->render();
  }

  private function sendMail(){
    $mail = new Gmail();
    $mail->send(
        $_POST["email"],
        $_POST["prenom"],
        "Confirmation inscrition jeux concours Atol",
    );
} 

  private function verifBeforePost(){
    $verif = [];
      foreach (PATTERN as $key => $value) {
          if ($_POST[$key]) {
              if (!preg_match("/".$value["pattern"]."/",$_POST[$key])){
                  $verif[$key] = ERROR[$key]["pattern"];
              }        
          }else if ($value["need"]){
              $verif[$key] = ERROR[$key]["vide"]; 
          } 
      }
      if ($this->Inscrit->checkMail($_POST["email"],$this->Operation->id)){            
          $verif["email"] = ERROR["email"]["inscrit"];
      }
      return $verif;
  }
}
