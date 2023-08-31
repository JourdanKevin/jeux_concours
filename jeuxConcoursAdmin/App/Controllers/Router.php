<?php

namespace App\Controllers;

use App\Controllers\Routes as Routes;
use App\Models\Request;
use App\Utils\Date;

class Router
{
  protected string $req;
  public string $method;
  public string $nameConcours;
  public int $idConcours;
  public array $treq;

  public $params = [];
  


  function __construct(){
    $this->tReq = explode('/',$_GET["req"] ?? "concours");
    foreach ($_GET as $key => $value) {
      if ($key != "req")
        $this->params[$key] = $value;
    }
    $this->req = $this->tReq[0] ?? false;
    $this->method = $_SERVER["REQUEST_METHOD"];
    $this->route();
  }

  public function homePage(){
    header ("Location: /");
  }

  public function route(){
    switch ($this->req) {
      case "concours":
        new Routes\Concours($this);
        break;
      default:
        die();
    }  
  }
}
