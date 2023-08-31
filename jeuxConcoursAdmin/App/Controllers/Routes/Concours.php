<?php

namespace App\Controllers\Routes;


use App\Controllers\Routes;
use App\Models\Entity\Table\Operation;
use App\Models\Request;


class Concours extends Routes{

  private $view_tableConcours = VIEWS . "concours/tableConcours.php";
  public $all_operations;
  public $Operation;

  function __construct($Router){
    
    parent::__construct($Router);
    switch ($this->Router->method) {
      case 'GET':
        $this->render_tableOperation();
        break;
      case 'POST':
        $this->post_operation();
        break;
      default:
        $this->Router->homePage();
        break;
    
    }

  }

  public function render_tableOperation()  {    
    $this->Operation = new Operation();
    $this->all_operations = $this->Operation->get_operations();
    $this->scripts = "concours";
    $this->setContent_view([
      $this->view_tableConcours
    ]);
    $this->render();
  }

  public function post_operation(){
    
    var_dump($_POST);
    if (isset($_FILES)){
      $_POST["logo"] = $_FILES["file"]["name"];
    }else{
      // unset($_POST["logo"]);
    }
    var_dump($_POST);
  //   if ($_POST["id"] ? Request::setOperations() : Request::addOperations()){
  //     if (isset($_FILES)){
  //       $file = $_FILES["file"];
  //       $location = IMG_SERVE_DIR . $file["name"];
  //       move_uploaded_file($_FILES['file']['tmp_name'],$location);
  //       $_POST["file"] = $file["name"];
  //     }
  //   }
  }
}
