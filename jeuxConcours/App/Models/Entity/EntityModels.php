<?php
namespace App\Models\Entity;
use App\Models\SQLTools\SQLTools;

abstract class EntityModels{

    public SQLTools $sqlTools;
    private $datas;
    protected $listOtherTable = [] ;
    protected $table;
    protected array $datasSchema;
    private $current = 0;
    private $lastIndexDatas;
    private $return;

    function __construct($connect = true,$from = ""){
        $childclassName = explode("\\",get_class($this));
        $this->table = strtolower(end($childclassName));
        foreach ($this->joins as $key => $value){                   
            if($key != $from){
                $class = "App\\Models\\Entity\\Table\\".ucfirst($key);
                $this->listOtherTable[$key] = new $class(false,$this->table);
            }        
        }
        $this->sqlTools = New sqlTools($this->table,$this->joins,$this->listOtherTable, $connect);            
    }

    public function createSQL_and_query($schemaSQL,$data = [],$return = ""){
        $this->createSQL($schemaSQL);
        return $this->query($data,$return);
    }

    public function createSQL($schemaSQL){
        $this->sqlTools->createSQL($schemaSQL);
    }

    public function query($data = [],$return = ""){
        $this->sqlTools->query($data,$return=="succes");
        $datas = $this->sqlTools->datas;
        $this->datas = $this->sqlTools->datas;
        // var_dump($data);
        // var_dump($datas);
        switch ($return) {
            case 'succes':
                break;
             case 'exist':
                $datas = $this->sqlTools->datas ? true : false;
                break;            
            default:
                $this->lastIndexDatas = count($this->datas) - 1;
                $this->datas["schemaSQL"] = $this->sqlTools->schemaSQL;
                break;
        }        
        return $datas;
        
    }
    public function all(){
        echo $this->table;
        echo "<br>";
        $var_to_pass = ["sqlTools","table","join", "current", "lastIndexDatas","return"];
        foreach (get_object_vars($this) as $var => $val) {
            if (in_array($var,$var_to_pass)){
                continue;
            }
            if ($var == "listOtherTable" ){                    
                foreach ($this->listOtherTable as $name => $object) {
                    echo "<br>";
                    $object->all();
                }
            }else{
                if (!is_array($val)){
                    echo($var);
                    echo " : ";
                    echo($val);
                    echo "<br>";
                }             
            }            
        }
    }

    public function next(){
        if (++$this->current > $this->lastIndexDatas){
            $this->current = 0;
        }
        $this->set_values();
    }
    public function before(){
        if (--$this->current < 0){
            $this->current = $this->lastIndexDatas;
        }
        $this->set_values();
    }

    public function set_values($schemaSQL = "",$datas = ""){         
        if (!$schemaSQL){
            $schemaSQL = $this->datas["schemaSQL"];
            $datas = $this->datas[$this->current] ?? "";
            if (!$datas){
                return;
            }
        }
        $schemaSQL = $schemaSQL["select"] ?? $schemaSQL;
        foreach ($schemaSQL as $key => $value) {
            if (!is_int($key)){
                $this->listOtherTable[$key]->set_values($value,$datas);
            }else{
                $this->$value = $datas[$this->table."$".$value] ?? $datas[$value];
            }
        }   
    }
    private function datas(){
        $this->datas = $this->sqlTools->datas;
        $this->lastIndexDatas = count($this->datas) - 1;
        $this->datas["schemaSQL"] = $this->sqlTools->schemaSQL;
    }

    public function response(){
        $temp = $this->datas;
        if (is_array($temp)){
            unset($temp["schemaSQL"]);
            return count($temp) == 1 ? $temp[0] : $temp;
        }
        return $temp;
        
        
    }
}