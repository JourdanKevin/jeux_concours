<?php

namespace App\Models\SQLTools;
use App\Models\Connection\PDOConn;

class SQLTools{
    
    public string $sql = "";
    public bool $reset = true;
    public string $select = "";
    public string $insert = "";
    public $datas;
    public array $joins;
    public array $listOtherTable;
    public array $schemaSQL;
    
    // private array $tJoins;
    private string $update = "";
    private string $delete = "";
    private string $join = "";
    private string $where = "";
    private string $orderBy = "";
    private string $limit = "";
    private PDOConn $Conn;
    private array $operator = [
        "=",
        "<>",
        "!=",
        ">",
        "<",
        ">=",
        "<=",
        "IN",
        "BETWEEN",
        "LIKE",
        "IS NULL",
        "IS NOT NULL",
    ];

    function __construct($tableName,$joins,$listOtherTable,$connect = true, $connType = "PDO"){
        $this->TableName = $tableName;
        foreach ($joins as $key => $value) {
            $this->joins[$key] = $this->joins($key,$value);
        }
        $this->listOtherTable = $listOtherTable;
        if ($connect){
            switch ($connType) {
                case 'PDO':
                    $this->conn = new PDOConn();
                    break;
            }
        }       
        
    }
    public function buildSelect($cols,$table = ""){
        $result = "";
        if (!is_array($cols)){
            $cols = explode($cols);
        }
        foreach ($cols as $key => $value) {            
            if (!is_int($key)){
                $table = $this->TableName.".";
                unset($cols[$key]);
                $this->join .= $this->joins[$key];
                $result .= ",";
                $result .= $this->listOtherTable[$key]->sqlTools->buildSelect($value,$key.".");
                $this->join .= $this->listOtherTable[$key]->sqlTools->join;
            }
        }
     
        
        return $table.implode($cols, ",".$table).$result;
    }
    public function select($cols = "*"){    
        if (!is_array($cols)){
            $cols = [$cols];
        }  
        $temp = explode(",",$this->buildSelect($cols));
        foreach ($temp as $key => $value){
            $temp[$key] = $value." as ". str_replace(".","$",$value);
        }
        $temp = implode(",",$temp);
        $this->select = "SELECT ". $temp ." FROM {$this->TableName} ";
        $this->sql = $this->select;
    }
    private function where($where){    
        foreach ($where as $arr) {
            if (!is_array($arr)){
                $condition = [$arr];
                $table = $this->TableName;
            }else{
                $table = array_key_first($arr);
                if (is_int($table)){
                    $condition = $arr;
                    $table = $this->TableName;
                }else{
                    $condition = $arr[$table];
                    if (!is_array($condition)){
                        $condition = [$condition];
                    }              
                }
            }
           
            $length = count($condition) - 1;
            switch ($length) {
                case 0:
                    array_push($condition,"=",":".$condition[0]);
                    break;
                case 1:
                    if (in_array($condition[1], $operator)){
                        array_push($condition,":".$condition[0]);
                    }else{
                        array_slice($condition, "=", 1);
                    }
                case 2:
                    $condition[2] = ":".$condition[2];
            }
           $condition = implode(" ",$condition);
           if ($this->where){
            $this->where .= " AND ";
        }
        $this->where .= "{$table}.{$condition} ";
        }
        $this->where = " WHERE ".$this->where;
    }

    private function joins($table,$join){
        return " INNER JOIN ". $table ." ON ". $this->TableName.".".$join[0]." = ".$table.".".$join[1];
    }
    private function join($join){

    }
    private function update($up){
        if (!is_array($up)){
            $up = explode(",",$up);
        }
        foreach ($up as $key => $value) {
            $up[$key] = $value." = :".$value;
        }
        $this->update =  "UPDATE ".$this->tableName." SET ".implode(",",$up);

    }
    private function delete(){

    }
    public function insert(...$insert){
        if (is_array($insert[0])){
            $insert = $insert[0];
        }
        $cols = implode(",",$insert);
        $values = implode(",:",$insert);
        $this->insert = "INSERT INTO {$this->TableName} ({$cols}) VALUES (:{$values})";
        $this->sql = $this->insert;
    }

    private function limit($limit){
        $this->limit = " LIMIT {$limit} ";
    }
    private function orderBy($orderBy){
        $this->orderBy = " ORDER BY {$orderBy} ";
    }

    public function createSQL($arr){
        $this->schemaSQL = $arr;
        foreach ($arr as $key => $value) {
            switch ($key) {
                case 'select':
                    $this->select($value);
                    break;
                case 'update':
                    $this->update($value);
                    break;
                case 'insert':
                    $this->insert($value);
                    break;
                case 'delete':
                    $this->delete($value);
                    break;
                case 'where':                    
                    $this->where($value);
                    break;
                case 'orderBy':                    
                    $this->orderBy($value);
                    break;        
                case 'limit':                    
                    $this->limit($value);
                    break;    
            }
        }
        $this->SQL();       
    }

    public function SQL($sql = null){
        if (!$sql){
            $this->sql = $this->select.$this->update.$this->delete.$this->insert.$this->join.$this->where.$this->orderBy.$this->limit.";";
            if ($this->reset){$this->resetValues();}
        }else{
            $this->sql = $sql;
        }       
    }
    public function resetValues(){
        $this->select = "";
        $this->insert = "";
        $this->update = "";
        $this->delete = "";
        $this->join = "";
        $this->where = "";
    }
    public function set_fetchMethod($method){
        $this->conn->fetchMethod = $method;
    }
    public function query($data = [],$succes = false){
        $this->conn->sql = $this->sql;
        $this->datas = $this->conn->query($data,$succes);
    }
}

?>













