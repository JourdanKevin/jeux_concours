<?php

    namespace App\Models\Connection;
    use PDO;

    class PDOConn {
        public string $sql = '';
        private PDO $db;
        public $fetchMethod = PDO::FETCH_ASSOC;

        function __construct(){
            $this->connectDataBase();
        }
        private function connectDataBase(){
            try{
                $this->db = new PDO(DB_DSN, DB_USER, DB_PASS);
                $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            }catch(Exception $e){
                die("Erreur : " . $e->getMessage());
            }  
        }
        private function request($data){
            $req = $this->db->prepare($this->sql);
            $suc = $req->execute($data);
            return ["req" => $req, "succes" => $suc];
        }
        public function query($data = [], $succes = false){
            $response = $this->request($data);
            if ($succes){
                return $response["succes"];                
            }
            // var_dump($response["req"]->fetchAll($this->fetchMethod));
            return $response["req"]->fetchAll($this->fetchMethod);            
        }
    }
?>