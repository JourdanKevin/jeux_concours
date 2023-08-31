<?php

namespace App\Controllers;

abstract class Routes {

    protected $Router;

    private $view_header = VIEWS."header.php";
    private $view_footer = "";

    protected $stylesheets = "";
    protected $scripts = "";

    protected $content = "";
    protected $header = "";
    protected $footer = "";

    function __construct($Router){
        $this->Router = $Router;
    }

    protected function set_header($header = ""){
        $header = $header ? $header : $this->view_header;
        if ($header){
            $this->header = $this->ob($header);
        }        
    }
    protected function set_footer($footer = ""){
        $footer = $footer ? $footer : $this->view_footer;
        if ($footer){
            $this->footer = $this->ob($footer);
        }      
    }

    protected function setContent_view($views){
        $this->content = $this->ob($views);
    }

    protected function render(){
        require VIEWS . "base.php";
    }
    protected function spe_render($views){
        foreach ($views as $view) {
            if ($view == "header"){
                require $this->view_header;
            }
            else if ($view == "footer"){
                require $this->view_footer;
            }
            else {
                require $view;
            }            
        }
    }

    private function ob($views){
        ob_start();
            foreach ($views as $view) {
                require $view;
            }
        return ob_get_clean();
    }
}