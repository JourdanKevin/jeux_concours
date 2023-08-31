<?php

namespace App\Controllers\Routing;

use App\Controllers\Routing\Routes as Routes;

class Router
{
  public array $treq;
  public string $req = "";
  public string $method;
  public string $nameConcours;
  public $params = [];
  

  function __construct(){
    $this->tReq = explode('/',$_GET["req"] ?? "");
    foreach ($_GET as $key => $value) {
      if ($key != "req")
        $this->params[$key] = $value;
    }
    $this->nameConcours = $this->tReq[0];
    $this->method = $_SERVER["REQUEST_METHOD"];
    $this->route();
  }

  public function homePage(){
    header ("Location: /" . $this->nameConcours);
  }

  private function route(){
    switch ($this->req) {
      case "":
        new Routes\Inscription($this);
        break;
      default:
        die();
    }
  }
}
